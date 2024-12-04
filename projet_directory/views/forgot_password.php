<?php
require_once '../controller/UserController.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userController = new UserController();

    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        $message = $userController->sendResetCode($email);
    } elseif (isset($_POST['code'], $_POST['new_password'], $_POST['email_hidden'])) {
        $email = $_POST['email_hidden'];
        $code = $_POST['code'];
        $newPassword = $_POST['new_password'];
        $message = $userController->resetPassword($email, $code, $newPassword);
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

        <?php if (!isset($_POST['code'])): ?>
        <!-- Étape 1 : Entrer l'email -->
        <form action="forgot_password.php" method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <button type="submit">Envoyer le code</button>
        </form>
        <?php else: ?>
        <!-- Étape 2 : Saisir le code et le nouveau mot de passe -->
        <form action="forgot_password.php" method="POST">
            <input type="hidden" name="email_hidden" value="<?php echo htmlspecialchars($_POST['email']); ?>">
            <input type="text" name="code" placeholder="Code de réinitialisation" required>
            <input type="password" name="new_password" placeholder="Nouveau mot de passe" required>
            <button type="submit">Réinitialiser le mot de passe</button>
        </form>
        <?php endif; ?>

        <p><?php echo $message; ?></p>
        <p>Vous vous souvenez de votre mot de passe ? <a href="login.php">Se connecter</a></p>
    </div>
</body>
</html>
