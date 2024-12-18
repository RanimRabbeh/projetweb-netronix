<?php
// Activer l'affichage des erreurs pour faciliter le débogage
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../../config.php';  // Charger le fichier de connexion à la base de données
require_once '../../Controller/UserController.php';  // Charger le UserController

// Initialiser la variable message pour le retour d'information
$message = "";

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Valider et assainir les entrées de l'utilisateur
    $name = trim(htmlspecialchars($_POST['name'] ?? ''));
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'] ?? '';

    // Vérifier si les champs sont remplis
    if (empty($name) || empty($email) || empty($password)) {
        $message = "Tous les champs sont requis. Veuillez les remplir.";
    } elseif (!$email) {
        $message = "Veuillez entrer un email valide.";
    } else {
        // Créer une instance de la connexion à la base de données
        $Config = new Config();
        $db = $Config->getConnexion();  // Obtenez la connexion

        // Vérifiez si la connexion a échoué
        if ($db === null) {
            $message = "Erreur de connexion à la base de données.";
        } else {
            // Créer une instance de UserController avec la connexion à la base de données
            $userController = new UserController($db);

            // Appeler la méthode register de UserController
            $result = $userController->register($name, $email, $password);

            // Définir le message de retour en fonction du résultat
            if ($result) {
                $message = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
            } else {
                $message = "Une erreur s'est produite. Cet email est peut-être déjà utilisé.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un compte</title>
    <link rel="stylesheet" href="stylelog.css">
    <script src="js/form_validation.js"></script>  <!-- Lien vers le script de validation -->
</head>
<body>
    <div class="container">
        <h1>Créer un compte</h1>

        <!-- Afficher le message de retour -->
        <?php if (!empty($message)): ?>
            <p class="message"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>

        <!-- Formulaire d'inscription -->
        <form action="register.php" method="POST">
            <input type="text" name="name" placeholder="Nom" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" >
            <input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" >
            <input type="password" name="password" placeholder="Mot de passe" >
            <button type="submit">S'inscrire</button>
        </form>

        <p>Vous avez déjà un compte ? <a href="login.php">Se connecter</a></p>

        <!-- Liens de connexion via les réseaux sociaux -->
        <div class="social-icons">
            <a href="https://www.facebook.com" target="_blank" class="facebook" title="Se connecter avec Facebook">f</a>
            <a href="https://plus.google.com" target="_blank" class="google" title="Se connecter avec Google+">g+</a>
            <a href="https://www.linkedin.com" target="_blank" class="linkedin" title="Se connecter avec LinkedIn">in</a>
        </div>
    </div>
</body>
</html>
