<?php 
require_once '../../config.php'; // Include the Database connection
require_once '../../Controller/UserController.php';
require_once '../../Model/UserModel.php';

// Create a Database instance
$Config = new Config();
$db = $Config->getConnexion(); // Get the database connection

$message = ""; // Feedback message for the user

// Helper function to log directly to the browser console
function console_log($data) {
    echo "<script>console.log(" . json_encode($data) . ");</script>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Debug: Log input values to the browser console
    console_log("Email entered: " . $email);
    console_log("Password entered: " . $password);

    try {
        // Initialize UserController with the correct database connection
        $userController = new UserController($db);

        // Log the initialization
        console_log("UserController initialized");

        // Handle login process
        $message = $userController->login($email, $password);

        // Log the login result
        console_log("Login result: " . $message);

        // Redirect if login is successful
        if ($message === "Connexion réussie") {
            console_log("Redirecting to the home page");
            header('Location: http://localhost/projet_directory/front/front/slides/index.html');
            exit();
        } else {
            // If login fails, show an error message
            $message = "Email ou mot de passe incorrect. Veuillez réessayer.";
            console_log("Login failed: " . $message);
        }
    } catch (Exception $e) {
        // Log error
        console_log("Error: " . $e->getMessage());
        $message = "Une erreur est survenue. Veuillez réessayer.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="stylelog.css">
    <script src="js/form_validation.js"></script>
</head>
<body>
    <div class="container">
        <h1>Connexion</h1>

        <!-- Display feedback message -->
        <?php if (!empty($message)): ?>
            <p class="message"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>
        
        <!-- Login form -->
        <form action="login.php" method="POST" onsubmit="return validateLoginForm()">
            <input type="email" id="email" name="email" placeholder="Email" >
            <input type="password" id="password" name="password" placeholder="Mot de passe" >
            <button type="submit">Se connecter</button>
        </form>

        <!-- Links to other pages -->
        <p><a href="reset_password.php">Mot de passe oublié ?</a></p>
        <p><a href="register.php">Créer un compte</a></p>

        <!-- Social login buttons -->
        <div class="social-login">
            <a href="https://github.com/login/oauth/authorize?client_id=Ov23liEdQ7qkXTArJ4Qy&redirect_uri=http://localhost/projet_directory/github-callback.php&scope=user">
                <button>Login with GitHub</button>
            </a>
        </div>
    </div>

    <script>
        // Validate the login form
        function validateLoginForm() {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            if (!email || !password) {
                alert('Veuillez remplir tous les champs.');
                return false;
            }

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
