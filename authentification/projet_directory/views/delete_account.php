<?php
session_start();

// Inclure le contrôleur et le modèle
require_once '../controller/UserController.php';

// Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Appel à la méthode de suppression
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userController = new UserController();
    $message = $userController->deleteAccount($_SESSION['user_id']);  // Supprimer le compte
    session_destroy();
    echo $message;  // Afficher un message après suppression
    header("Location: login.php");  // Rediriger vers la page de connexion
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer mon compte</title>
    <link rel="stylesheet" href="../css/style.css">

</head>
<body>
    <div class="delete-account-container">
        <h2>Supprimer mon compte</h2>
        <p>Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.</p>
        <form action="delete_account.php" method="POST">
            <button type="submit">Supprimer mon compte</button>
        </form>
    </div>
</body>
</html>
