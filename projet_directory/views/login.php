<?php
require_once '../includes/database.php';
require_once '../controller/UserController.php';

$message = ""; // Pour stocker le message de feedback

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Créer une instance du contrôleur avec la connexion à la base de données
    $userController = new UserController($db);

    // Appeler la méthode login pour traiter les identifiants
    $message = $userController->login($email, $password);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="../css/style.css">

    <!-- Facebook SDK -->
    <script async defer crossorigin="anonymous" 
            src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v16.0&appId=YOUR_APP_ID&autoLogAppEvents=1"></script>
</head>
<body>
    <div class="container">
        <h1>Connexion</h1>
        
        <?php if ($message): ?>
            <p class="message"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>
        
        <!-- Formulaire de connexion classique -->
        <form action="login.php" method="POST" onsubmit="return validateLoginForm()">
            <input type="email" id="email" name="email" placeholder="Email" required>
            <input type="password" id="password" name="password" placeholder="Mot de passe" required>
            <button type="submit">Se connecter</button>
        </form>

        <!-- Liens vers les autres pages -->
        <p><a href="reset_password.php">Mot de passe oublié ?</a></p>
        <p><a href="register.php">Créer un compte</a></p>

        <!-- Bouton de connexion avec Facebook -->
        <div class="social-login">
    <a href="https://www.facebook.com/login.php" target="_blank">
        <button id="fb-login-btn">Se connecter avec Facebook</button>
    </a>
</div>

    </div>

    <script>
        // Initialisation du SDK Facebook
        window.fbAsyncInit = function() {
            FB.init({
                appId      : 'YOUR_APP_ID',  // Remplacez par votre propre ID d'application
                cookie     : true,
                xfbml      : true,
                version    : 'v16.0'
            });
        };

        // Fonction de connexion Facebook
        function facebookLogin() {
            FB.login(function(response) {
                if (response.authResponse) {
                    // L'utilisateur est connecté avec succès
                    console.log('Bienvenue !');

                    // Vous pouvez récupérer l'ID utilisateur et d'autres informations ici
                    FB.api('/me', function(response) {
                        console.log('Données de l’utilisateur : ', response);
                        // Vous pouvez envoyer ces informations à votre serveur pour créer un compte
                        // ou connecter l'utilisateur
                    });

                } else {
                    console.log('L\'utilisateur a annulé la connexion ou il y a eu une erreur');
                }
            }, {scope: 'public_profile,email'});  // Demander l'accès au profil et à l'email
        }

        // Fonction pour valider le formulaire de connexion
        function validateLoginForm() {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            // Validation basique
            if (!email || !password) {
                alert('Veuillez remplir tous les champs.');
                return false;
            }

            // Exemple de validation de format d'email
            const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (!emailPattern.test(email)) {
                alert('Veuillez entrer un email valide.');
                return false;
            }

            return true;
        }
    </script>
</body>
</html> 