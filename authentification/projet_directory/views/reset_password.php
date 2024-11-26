<?php
require_once '../controller/UserController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userController = new UserController();

    // Process reset password
    if (isset($_POST['reset_password'])) {
        $code = $_POST['code'];
        $new_password = $_POST['new-password'];

        $message = $userController->resetPassword($code, $new_password);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialiser le mot de passe</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Réinitialiser le mot de passe</h1>
        <p>Entrez le code de vérification et votre nouveau mot de passe.</p>
        <form action="reset_password.php" method="POST">
            <input type="text" name="code" placeholder="Code de vérification" required>
            <input type="password" name="new-password" placeholder="Nouveau mot de passe" required>
            <button type="submit" name="reset_password">Réinitialiser</button>
        </form>
        <p>Retour à la <a href="login.php">connexion</a></p>

        <div class="social-icons">
            <a href="https://www.facebook.com" target="_blank" class="facebook" title="Se connecter avec Facebook">f</a>
            <a href="https://plus.google.com" target="_blank" class="google" title="Se connecter avec Google+">g+</a>
            <a href="https://www.linkedin.com" target="_blank" class="linkedin" title="Se connecter avec LinkedIn">in</a>
        </div>
    </div>
</body>
</html>
