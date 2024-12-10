<?php
// Inclure les fichiers nécessaires
require_once __DIR__ . '/../includes/database.php'; // Inclure la classe Database
require_once __DIR__ . '/../controller/UserController.php'; // Inclure le contrôleur utilisateur

// Initialiser la connexion à la base de données via la classe Database
try {
    $database = new Database(); // Créer une instance de la classe Database
    $db = $database->getConnection(); // Obtenir la connexion PDO
} catch (Exception $e) {
    echo "<script>console.error('Erreur d\\'instanciation : " . addslashes($e->getMessage()) . "');</script>";
    error_log("Erreur d'instanciation : " . $e->getMessage());
    die("Erreur : Impossible d'établir une connexion à la base de données.");
}

// Initialisation de la classe UserController avec la connexion à la base de données
try {
    $userController = new UserController($db); // Passer l'objet PDO ($db) à UserController
} catch (Exception $e) {
    echo "<script>console.error('Erreur d\\'instanciation : " . addslashes($e->getMessage()) . "');</script>";
    error_log("Erreur d'instanciation : " . $e->getMessage());
    die("Erreur : Impossible d'instancier la classe UserController.");
}

// Variables pour feedback
$message = "";
$messageType = ""; // success ou error

// Traitement des formulaires
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérification du formulaire d'envoi du code
    if (isset($_POST['send_code'])) {
        $email = trim($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message = "Adresse e-mail invalide.";
            $messageType = "error";
        } else {
            $result = $userController->sendResetCode($email);
            $message = $result;
            $messageType = strpos($result, 'envoyé') !== false ? "success" : "error";
        }
    } 
    // Vérification du formulaire de réinitialisation du mot de passe
    elseif (isset($_POST['reset_password'])) {
        $email = trim($_POST['email']);
        $verificationCode = trim($_POST['verification_code']);
        $newPassword = trim($_POST['new_password']);

        // Validation des champs
        if (empty($email) || empty($verificationCode) || empty($newPassword)) {
            $message = "Veuillez remplir tous les champs.";
            $messageType = "error";
        } elseif (strlen($newPassword) < 6) {
            $message = "Le mot de passe doit contenir au moins 6 caractères.";
            $messageType = "error";
        } else {
            // Appel à la méthode de réinitialisation du mot de passe
            $result = $userController->resetPassword($email, $verificationCode, $newPassword);
            $message = $result;
            $messageType = strpos($result, 'succès') !== false ? "success" : "error";
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
    <style>
        .message {
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
        }
        .success { background-color: #d4edda; color: #155724; }
        .error { background-color: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Réinitialiser le mot de passe</h1>

        <!-- Message de feedback -->
        <?php if (!empty($message)) : ?>
            <p class="message <?php echo $messageType; ?>" id="feedback">
                <?php echo htmlspecialchars($message); ?>
            </p>
        <?php endif; ?>

        <!-- Formulaire pour envoyer le code -->
        <form action="" method="POST">
            <label for="email">Adresse e-mail</label>
            <input type="email" id="email" name="email" placeholder="Email" required>

            <button type="submit" name="send_code">Envoyer un code</button>
        </form>

        <hr>

        <!-- Formulaire pour réinitialiser le mot de passe -->
        <form action="" method="POST">
            <label for="email">Adresse e-mail</label>
            <input type="email" id="email" name="email" placeholder="Email" required>

            <label for="verification_code">Code de vérification</label>
            <input type="text" id="verification_code" name="verification_code" placeholder="Code de vérification" required>

            <label for="new_password">Nouveau mot de passe</label>
            <input type="password" id="new_password" name="new_password" placeholder="Nouveau mot de passe" required>

            <button type="submit" name="reset_password">Réinitialiser le mot de passe</button>
        </form>

        <p><a href="login.php">Retour à la connexion</a></p>
    </div>

    <script>
        // Console log pour le débogage
        const feedback = document.getElementById('feedback');
        if (feedback) {
            console.log("Message serveur :", feedback.innerText);
            if (feedback.classList.contains("success")) {
                console.log("Statut : Succès ✅");
            } else if (feedback.classList.contains("error")) {
                console.error("Statut : Erreur ❌");
            }
        }
    </script>
</body>
</html>
