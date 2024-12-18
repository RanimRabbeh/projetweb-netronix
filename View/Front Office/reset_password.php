
<?php
// Inclure les fichiers nécessaires
require_once  '../../config.php'; // Inclure la classe Database
require_once  '../../Controller/UserController.php'; // Inclure le contrôleur utilisateur

// Initialiser la connexion à la base de données
try {
    $Config = new Config();
    $db = $Config->getConnexion();
} catch (Exception $e) {
    die("Erreur : Impossible d'établir une connexion à la base de données.");
}

$userController = new UserController($db);

// Variables pour feedback
$message = "";
$messageType = ""; // success ou error

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_code'])) {
    $email = trim($_POST['email']);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Adresse e-mail invalide.";
        $messageType = "error";
    } else {
        $result = $userController->sendResetCode($email);
        if (strpos($result, 'envoyé') !== false) {
            header("Location: send_code.php?email=" . urlencode($email));
            exit;
        } else {
            $message = $result;
            $messageType = "error";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Envoyer un code</title>
    <link rel="stylesheet" href="stylelog.css">
</head>
<body>
    <div class="container">
        <h1>Envoyer un code de réinitialisation</h1>

        <?php if (!empty($message)) : ?>
            <p class="message <?php echo $messageType; ?>">
                <?php echo htmlspecialchars($message); ?>
            </p>
        <?php endif; ?>

        <form action="" method="POST">
            <label for="email">Adresse e-mail</label>
            <input type="email" id="email" name="email" placeholder="Email" required>
            <button type="submit" name="send_code">Envoyer un code</button>
        </form>

        <p><a href="login.php">Retour à la connexion</a></p>
    </div>
</body>
</html>
