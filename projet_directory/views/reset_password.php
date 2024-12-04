<?php
require_once '../controller/UserController.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userController = new UserController();

    // Gestion de l'envoi du code de réinitialisation
    if (isset($_POST['send_code'])) {
        $email = $_POST['email'];
        $message = $userController->sendResetCode($email);
    }

    // Gestion de la réinitialisation du mot de passe
    elseif (isset($_POST['reset_password'])) {
        $email = $_POST['email'];
        $verificationCode = $_POST['verification_code'];
        $newPassword = $_POST['new_password'];
        $message = $userController->resetPassword($email, $verificationCode, $newPassword);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialiser le mot de passe</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Réinitialiser le mot de passe</h1>

        <!-- Affichage des messages -->
        <?php if (!empty($message)) : ?>
            <p class="message"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <!-- Formulaire pour la réinitialisation -->
        <form action="" method="POST">
            <!-- Email pour recevoir le code -->
            <label for="email">Adresse e-mail</label>
            <input type="email" id="email" name="email" placeholder="Email" >
            
            <!-- Bouton pour envoyer un code -->
            <button type="submit" name="send_code">Envoyer un code</button>
            
            <!-- Champ pour entrer le code reçu -->
            <label for="verification_code">Code de vérification</label>
            <input type="text" id="verification_code" name="verification_code" placeholder="Code de vérification" >

            <!-- Nouveau mot de passe -->
            <label for="new_password">Nouveau mot de passe</label>
            <input type="password" id="new_password" name="new_password" placeholder="Nouveau mot de passe" >
            
            <!-- Bouton pour réinitialiser -->
            <button type="submit" name="reset_password">Réinitialiser le mot de passe</button>
        </form>

        <p><a href="login.php">Retour à la connexion</a></p>
    </div>
    <script src="../js/form_validation.js"></script>
</body>
</html>
