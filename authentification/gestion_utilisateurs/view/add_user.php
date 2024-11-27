<?php
require_once '../controller/UserController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new UserController();
    $controller->createUser($_POST['name'], $_POST['email'], $_POST['password']);
    header('Location: list_users.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Utilisateur</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/formValidation.js"></script> 
</head>
<body>
    <div class="admin-container">
        <h2>Ajouter un Utilisateur</h2>
        <form action="" method="POST">
            <label for="name">Nom :</label>
            <input type="text" name="name" id="name" required>
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" required>
            <label for="password">Mot de passe :</label>
            <input type="password" name="password" id="password" required>
            <button type="submit">Ajouter</button>
        </form>
    </div>
</body>
</html>
