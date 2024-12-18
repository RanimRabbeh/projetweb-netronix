<?php
require_once('../../Controller/ReclamationController.php'); 
require_once('../../Model/Reclamation.php'); 
session_start();

// Vérifiez si l'utilisateur est connecté (si l'ID utilisateur est dans la session)
if (isset($_SESSION['user_id'])) {
    // Récupérer l'ID utilisateur depuis la session
    $idUtilisateur = $_SESSION['user_id'];
} else {
    // Si l'utilisateur n'est pas connecté, rediriger vers une page de connexion
    header("Location: login.php");
    exit();
}
// Vérifiez si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $idUtilisateur = $_POST['idUtilisateur'];
    $typeDeReclamation = $_POST['TypeDeReclamation'];
    $description = $_POST['description'];
    $piecesJointes = $_FILES['pieces'];
    $contact = $_POST['contact'];

    // Gérer le fichier (s'il y en a un)
$nomFichier = null;
if ($piecesJointes['error'] === UPLOAD_ERR_OK) {
    $nomFichier = basename($piecesJointes['name']);
    $cheminFichier = '../../uploads/' . $nomFichier;  

    // Déplacez le fichier vers le répertoire 
    move_uploaded_file($piecesJointes['tmp_name'], $cheminFichier);
}
$dateActuelle = date('Y-m-d H:i:s');

// Créer une nouvelle instance de la réclamation
$reclamation = new Reclamations(
    null, 
    $idUtilisateur, 
    $dateActuelle,
    $typeDeReclamation, 
    $description, 
    $nomFichier, 
    $contact, 
    'non traité' // Par défaut, l'état de la réclamation est "non traité"
);
    // Récupérer la date actuelle
    $dateActuelle = date('Y-m-d H:i:s');

    // Créer une instance du contrôleur
    $controller = new ReclamationController();

    // Appeler la méthode pour ajouter la réclamation
    $result = $controller->addReclamation($reclamation);

    // Si l'ajout est réussi
if ($result['success']) {
  echo "<script>
          alert('Réclamation ajoutée avec succès !');
          window.location.href = 'index.php'; 
        </script>";
} else {
 
  echo "<script>
          alert('Erreur: " . $result['message'] . "');
        </script>";
}

}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Réclamation</title>
    <link rel="stylesheet" href="formcss.css"> 
    <link href="css/slides.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" as="font" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,600,700|Material+Icons"/>
    <script src="js/slides.min.js" type="text/javascript"></script>
    <script src="js/jquery.min.js"></script>
</head>
<style>
    body {
        background-image: url('assets/img/background/samba.jpeg');
    }
    .menu li a {
        font-family: Arial, sans-serif; 
        font-size: 16px;
        color: #f0f0f0;
        text-decoration: none;
        padding: 10px 15px;
        display: block;
        transition: all 0.3s ease;
    }
    .menu li {
        margin-right: 10px;
        display: inline-block;
    }
    .menu {
        display: flex;
        justify-content: center;
        list-style: none;
        padding: 0;
        margin: 0;
    }
</style>
<body>
<nav class="panel top">
    <div class="sections desktop">
        <div class="left">
            <a href="#" title="Slides Framework">
                <svg style="width:82px;height:24px">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#logo"></use>
                </svg>
            </a>
            <img src="assets/images/log.png" alt="logo" style="width: 100px; height: auto;">
        </div>
        <div class="center">
            <ul class="menu">
                <li><a href="index.php"><strong>Accueil</strong></a></li>
                <li><a href="index.php#videos"><strong>Evénements</strong></a></li>
                <li><a href="index.php#features"><strong>Boutique</strong></a></li>
                <li><a href="index.php#case"><strong>Forum</strong></a></li>
                <li><a href="index.php#pricing"><strong>Réclamations</strong></a></li>
            </ul>
        </div>
        <div class="right"><a class="" href="#pp"><Label> </Label></a></div>
    </div>
</nav>

<div class="form-container">
    <form method="POST" action="" enctype="multipart/form-data" onsubmit="return validerFormulaire()">
    <div class="form-group">
    <label for="idUtilisateur">ID Utilisateur :</label>
    <!-- Auto-fill the user ID from session -->
    <input type="number" name="idUtilisateur" id="idUtilisateur" value="<?php echo $_SESSION['user_id']; ?>" readonly required>
</div>


        <div class="form-group">
            <label for="TypeDeReclamation">Type de Réclamation :</label>
            <select name="TypeDeReclamation" id="TypeDeReclamation" >
                <option value="Problème de billetterie">Problème de billetterie</option>
                <option value="Problème lié à l'événement">Problème lié à l'événement</option>
                <option value="Problème avec l'accès ou l'entrée">Problème avec l'accès ou l'entrée</option>
                <option value="Problème de qualité du service">Problème de qualité du service</option>
                <option value="Problème avec la communication">Problème avec la communication</option>
                <option value="Problème de remboursement">Problème de remboursement</option>
                <option value="Problème technique avec le site">Problème technique avec le site</option>
                <option value="Autre réclamation">Autre réclamation</option>
            </select>
        </div>

        <div class="form-group">
            <label for="description">Description :</label>
            <textarea name="description" id="description" ></textarea>
        </div>

        <div class="form-group">
            <label for="pieces">Pièces Jointes :</label>
            <input type="file" name="pieces" id="pieces" accept="image/*, .pdf">
        </div>

        <div class="form-group">
            <label for="contact">Contact (Email/Numero de telephone) :</label>
            <input type="text" name="contact" id="contact" >
        </div>

        <button type="submit">Ajouter</button>
    </form>
</div>
<script>
    function validerFormulaire() {
        const utilisateurId = document.getElementById("idUtilisateur").value.trim();
        const type = document.getElementById("TypeDeReclamation").value;
        const description = document.getElementById("description").value.trim();
        const contact = document.getElementById("contact").value.trim();

        // Validation de l'identifiant
        if (utilisateurId === "") {
            alert("Veuillez entrer votre identifiant.");
            return false;
        }

        // Validation du type de réclamation
        if (type === "") {
            alert("Veuillez sélectionner un type de réclamation.");
            return false;
        }

        // Validation de la description
        if (description === "") {
            alert("Veuillez fournir une description pour votre réclamation.");
            return false;
        }

        // Validation du contact
        // Validation du contact
if (contact === "") {
    alert("Veuillez entrer votre contact (email ou téléphone).");
    return false;
} else if (!/^[\w.-]+@[a-zA-Z\d.-]+\.[a-zA-Z]{2,}$/i.test(contact) && !/^\+?[0-9]{10,15}$/.test(contact)) {
    alert("Veuillez entrer un email ou numéro de téléphone valide.");
    return false;
}


        return true; // Si tout est valide
    }
</script>
</body>
</html>
