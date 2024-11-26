<?php
// Inclure le contrôleur
require_once '../../Controller/ReclamationController.php';

// Vérifier si l'ID utilisateur est soumis via POST
if (isset($_POST['idUtilisateur'])) {
    $idUtilisateur = $_POST['idUtilisateur'];
    $controller = new ReclamationController(); // Pas besoin de passer $db ici
    $reclamations = $controller->searchReclamationsWithSolution($idUtilisateur);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechercher Réclamations</title>
    <link rel="stylesheet" href="recherche.css"> <!-- Ton fichier CSS -->
</head>
<body>
<nav>
    <a href="../../index.html">Accueil</a>
</nav>
    <div class="container">
        <h1>Rechercher vos Réclamations</h1>
        
        <!-- Formulaire de recherche -->
        <form method="POST">
            <label for="idUtilisateur">Entrez votre ID :</label>
            <input type="text" id="idUtilisateur" name="idUtilisateur" required>
            <button type="submit">Rechercher</button>
        </form>

        <?php if (isset($reclamations)): ?>
            <h2>Réclamations trouvées :</h2>
            <?php if (count($reclamations) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID Réclamation</th>
                            <th>Description De La Reclamation</th>
                            <th>Solution</th>
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
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Aucune réclamation trouvée pour cet ID.</p>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html>
