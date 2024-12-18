<?php
// Démarrer la session
session_start();

// Inclure la connexion à la base de données et le modèle Utilisateur
require_once '../config/Database.php';
require_once '../model/User.php';

// Vérifier si 'id' est passé dans l'URL
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Créer une instance de la classe User pour récupérer les informations de l'utilisateur
    $user = new User();
    $userInfo = $user->getUserById($userId);

    if (!$userInfo) {
        echo "Utilisateur non trouvé.";
        exit;
    }
} else {
    echo "Aucun ID d'utilisateur fourni.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacter le vendeur</title>
    <style>
        /* Ajouter votre style ici */
    </style>
</head>
<body>
    <div class="container">
        <?php if ($userInfo) : ?>
            <h2>Contacter le vendeur</h2>
            <p>Nom du vendeur : <?= $userInfo['Nom']; ?></p>
            <p>Email : <?= $userInfo['Email']; ?></p>
        <?php else : ?>
            <p>Vendeur non trouvé.</p>
        <?php endif; ?>
    </div>
</body>
</html>
