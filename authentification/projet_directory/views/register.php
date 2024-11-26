<?php
require_once '../controller/UserController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $userController = new UserController();
    $message = $userController->register($name, $email, $password);
    echo $message;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un compte</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Créer un compte</h1>
        <form action="register.php" method="POST">
            <input type="text" name="name" placeholder="Nom" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit">S'inscrire</button>
        </form>
        <p>Vous avez déjà un compte ? <a href="login.php">Se connecter</a></p>

        <div class="social-icons">
            <a href="https://www.facebook.com" target="_blank" class="facebook" title="Se connecter avec Facebook">f</a>
            <a href="https://plus.google.com" target="_blank" class="google" title="Se connecter avec Google+">g+</a>
            <a href="https://www.linkedin.com" target="_blank" class="linkedin" title="Se connecter avec LinkedIn">in</a>
        </div>
    </div>
</body>
</html>
