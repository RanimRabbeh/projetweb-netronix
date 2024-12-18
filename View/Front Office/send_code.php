<?php
// Inclure les fichiers nécessaires
require_once __DIR__ . '/../includes/database.php';
require_once __DIR__ . '/../controller/UserController.php';

try {
    $database = new Database();
    $db = $database->getConnection();
} catch (Exception $e) {
    die("Erreur : Impossible d'établir une connexion à la base de données.");
}

$userController = new UserController($db);

$message = "";
$messageType = "";

$email = isset($_GET['email']) ? trim($_GET['email']) : "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reset_password'])) {
    $email = trim($_POST['email']);
    $verificationCode = trim($_POST['verification_code']);
    $newPassword = trim($_POST['new_password']);

    if (empty($email) || empty($verificationCode) || empty($newPassword)) {
        $message = "Veuillez remplir tous les champs.";
        $messageType = "error";
    } elseif (strlen($newPassword) < 6) {
        $message = "Le mot de passe doit contenir au moins 6 caractères.";
        $messageType = "error";
    } else {
        $result = $userController->resetPassword($email, $verificationCode, $newPassword);
        if (strpos($result, 'succès') !== false) {
            // Redirection vers login.php après une réinitialisation réussie
            header("Location: login.php");
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
    <title>Réinitialiser le mot de passe</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Réinitialiser le mot de passe</h1>

        <?php if (!empty($message)) : ?>
            <p class="message <?php echo $messageType; ?>">
                <?php echo htmlspecialchars($message); ?>
            </p>
        <?php endif; ?>

        <form action="" method="POST">
            <label for="email">Adresse e-mail</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" placeholder="Email" required readonly>

            <label for="verification_code">Code de vérification</label>
            <input type="text" id="verification_code" name="verification_code" placeholder="Code de vérification" required>

            <label for="new_password">Nouveau mot de passe</label>
            <input type="password" id="new_password" name="new_password" placeholder="Nouveau mot de passe" required>

            <button type="submit" name="reset_password">Réinitialiser le mot de passe</button>
        </form>

    </div>
</body>
</html>
