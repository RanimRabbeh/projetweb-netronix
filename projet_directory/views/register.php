<?php 
require_once '../controller/UserController.php';  // Charger le contrôleur

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Créer une instance de UserController sans passer d'argument
    $userController = new UserController();
    $message = $userController->register($name, $email, $password);
    echo $message;  // Afficher le message de succès ou d'erreur
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un compte</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Créer un compte</h1>
        <form action="register.php" method="POST">
            <input type="text" name="name" placeholder="Nom" >
            <input type="email" name="email" placeholder="Email" >
            <input type="password" name="password" placeholder="Mot de passe" >
            <button type="submit">S'inscrire</button>
        </form>
        <p>Vous avez déjà un compte ? <a href="login.php">Se connecter</a></p>

        <div class="social-icons">
            <a href="https://www.facebook.com" target="_blank" class="facebook" title="Se connecter avec Facebook">f</a>
            <a href="https://plus.google.com" target="_blank" class="google" title="Se connecter avec Google+">g+</a>
            <a href="https://www.linkedin.com" target="_blank" class="linkedin" title="Se connecter avec LinkedIn">in</a>
        </div>
    </div>
    <script src="../js/form_validation.js"></script>
</body>
</html>
