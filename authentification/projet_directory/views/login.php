<?php 
require_once '../controller/UserController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $userController = new UserController();
    $message = $userController->login($email, $password);
    echo $message;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Se connecter</h1>
        <form action="login.php" method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit">Se connecter</button>
        </form>
        <p>Mot de passe oublié ? <a href="forgot-password-step1.php">Réinitialiser</a></p>

        <p>Pas encore inscrit ? <a href="register.php">Créer un compte</a></p>

        <div class="social-icons">
            <a href="https://www.facebook.com" target="_blank" class="facebook" title="Se connecter avec Facebook">f</a>
            <a href="https://plus.google.com" target="_blank" class="google" title="Se connecter avec Google+">g+</a>
            <a href="https://www.linkedin.com" target="_blank" class="linkedin" title="Se connecter avec LinkedIn">in</a>
        </div>
    </div>
</body>
</html>
