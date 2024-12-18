<?php
// Inclure les contrôleurs nécessaires
require_once '../../Controller/ReclamationController.php';
require_once '../../Controller/SatisfactionController.php';  // Inclure SatisfactionController
session_start();

// Vérifier si l'utilisateur est connecté (si l'ID utilisateur est dans la session)
if (isset($_SESSION['user_id'])) {
    // Récupérer l'ID utilisateur depuis la session
    $idUtilisateur = $_SESSION['user_id'];
    $controller = new ReclamationController();
    $reclamations = $controller->getReclamationsWithSolutionByUserId($idUtilisateur);
} else {
    // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header("Location: login.php");
    exit();
}

// Vérifier si la note a été envoyée (via AJAX)
if (isset($_POST['rating'])) {
    // Récupérer la note envoyée
    $rating = $_POST['rating'];

    // Instancier SatisfactionController et enregistrer la satisfaction
    $satisfactionController = new SatisfactionController();
    $result = $satisfactionController->ajouterSatisfaction($rating); // Pas d'ID de réclamation ici

    // Retourner la réponse du processus d'insertion
    if ($result) {
        echo "Satisfaction enregistrée avec succès.";
    } else {
        echo "Une erreur s'est produite.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechercher Réclamations</title>
    <link rel="stylesheet" href="recherche.css"> <!-- Ton fichier CSS -->
    <style>
      .star {
        font-size: 20px; /* Réduction de la taille des étoiles */
        color: lightgray; /* Couleur du contour de l'étoile */
        cursor: pointer; /* Curseur pour indiquer que c'est cliquable */
        transition: color 0.2s ease, background-color 0.2s ease; /* Transition pour un effet doux */
        display: inline-block; /* Affichage en ligne des étoiles */
        width: 20px; /* Largeur de l'étoile */
        height: 20px; /* Hauteur de l'étoile */
        text-align: center; /* Centrer le texte (l'étoile) */
        line-height: 20px; /* Alignement vertical de l'étoile */
        background-color: transparent; /* Fond transparent pour garder l'aspect étoile */
      }

      .star.selected {
        color: yellow; /* Contour de l'étoile en jaune */
      }

      .star:hover {
        color: #FFD700; /* Couleur dorée lors du survol */
      }
    </style>
</head>
<body>
    <style>
        body { background-image: url('assets/img/background/samba.jpeg'); }
    </style>
    <nav>
        <a href="index.php">Accueil</a>
    </nav>
    <div class="container">
        <h1>Rechercher vos Réclamations</h1>

        <!-- Formulaire de recherche -->
        <form method="POST">
            <!-- Hidden field for user ID -->
            <input type="hidden" id="idUtilisateur" name="idUtilisateur" value="<?php echo $_SESSION['user_id']; ?>">

            
        </form>

        <?php if (isset($reclamations)): ?>
            <h2>Réclamations trouvées :</h2>
            <?php if (count($reclamations) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID Réclamation</th>
                            <th>Description De La Réclamation</th>
                            <th>Solution</th>
                            <th>Avis</th> <!-- Nouvelle colonne -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reclamations as $reclamation): ?>
                            <tr>
                                <td><?= htmlspecialchars($reclamation['IdReclamation']) ?></td>
                                <td><?= htmlspecialchars($reclamation['DescriptionDeLaReclamation']) ?></td>
                                <td>
                                    <?php if ($reclamation['Solution']): ?>
                                        <?= htmlspecialchars($reclamation['Solution']) ?>
                                    <?php else: ?>
                                        Pas encore de solution
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($reclamation['Solution']): ?>
                                        <span class="stars-rating">
                                            <span class="star" data-value="1">☆</span>
                                            <span class="star" data-value="2">☆</span>
                                            <span class="star" data-value="3">☆</span>
                                            <span class="star" data-value="4">☆</span>
                                            <span class="star" data-value="5">☆</span>
                                        </span>
                                    <?php else: ?>
                                        Pas de solution disponible
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Aucune réclamation trouvée pour cet ID.</p>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <!-- JavaScript pour gérer le clic sur les étoiles et envoyer la note -->
    <script>
        document.querySelectorAll('.star').forEach(function(star) {
            star.addEventListener('click', function() {
                // Récupérer la valeur de l'étoile cliquée
                const rating = this.getAttribute('data-value');

                // Changer la couleur des étoiles en fonction de la note
                const stars = this.parentNode.querySelectorAll('.star');
                stars.forEach(star => {
                    if (star.getAttribute('data-value') <= rating) {
                        star.classList.add('selected'); // Ajouter la classe "selected" pour colorer l'étoile en jaune
                    } else {
                        star.classList.remove('selected'); // Retirer la classe "selected" si l'étoile n'est pas cliquée
                    }
                });

                // Envoyer la note au serveur via AJAX
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'recherche.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        console.log('Note enregistrée avec succès');
                    }
                };
                xhr.send('rating=' + rating); // Pas besoin d'envoyer un ID de réclamation
            });
        });
    </script>

</body>
</html>
