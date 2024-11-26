<?php 
require_once '../controller/UserController.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userController = new UserController();

    // Traitement de l'envoi du code
    if (isset($_POST['send_code'])) {
        $email = $_POST['email'];
        $message = $userController->sendResetCode($email);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Mot de passe oublié</h1>
        <p>Entrez votre email pour recevoir un code de réinitialisation.</p>
        <form action="forgot_password.php" method="POST">
            <input type="email" name="email" placeholder="Votre email" required>
            <button type="submit" name="send_code">Envoyer le code</button>
        </form>
        <p><?php echo $message; ?></p> <!-- Message après soumission -->
        <p>Retour à la <a href="login.php">connexion</a></p>
    </div>
</body>
</html>
