<?php
session_start();

// Activer l'affichage des erreurs pour déboguer
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Inclure la classe Database (chemin correct)
require_once '../../config.php';  // Vérifiez que ce chemin est correct
require_once '../../Controller/UserController.php';  // Vérifiez aussi ce chemin

// Vérification de l'authentification
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Initialiser la connexion à la base de données et le contrôleur
$Config = new Config();  // Crée une instance de la classe Database
$db = $Config->getConnexion();  // Appelle la méthode pour obtenir la connexion

// Vérifiez si la connexion a échoué
if ($db === null) {
    die("Impossible de se connecter à la base de données.");
}

$userController = new UserController($db);

// Récupérer les données de l'utilisateur
$user = $userController->getUserById($_SESSION['user_id']);
if (!$user) {
    $message = "Erreur : Impossible de récupérer vos informations. Veuillez réessayer.";
    $user = ['Nom' => '', 'Email' => '']; // Valeurs par défaut
}

// Gestion de la soumission du formulaire
$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim(htmlspecialchars($_POST['nom'] ?? ''));
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);

    if (empty($nom) || !$email) {
        $message = "Email invalide ou champ manquant. Veuillez réessayer.";
    } else {
        if ($userController->updateProfile($_SESSION['user_id'], $nom, $email)) {
            $message = "Profil mis à jour avec succès.";
            $user = $userController->getUserById($_SESSION['user_id']); // Rafraîchir les données de l'utilisateur
        } else {
            $message = "Erreur lors de la mise à jour du profil. Veuillez réessayer plus tard.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil - Cultivio</title>
    <link href="css/slides.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: url('assets/img/background/5.jpeg') no-repeat center center fixed;
            background-size: cover;
            color: #333;
        }

        nav {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav .sections .left img {
            height: 50px;
        }

        nav .sections .right a {
            text-decoration: none;
            color: #333;
            padding: 10px 15px;
            border-radius: 4px;
            background-color: rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s;
        }

        nav .sections .right a:hover {
            background-color: rgba(0, 0, 0, 0.2);
        }

        .profile-container {
            max-width: 600px;
            margin: 50px auto;
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .profile-container h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #555;
        }

        .profile-container label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .profile-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .profile-container button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .profile-container button:hover {
            background-color: #218838;
        }

        .profile-container a {
            text-decoration: none;
            color: #dc3545;
            display: block;
            text-align: center;
            margin-top: 20px;
        }

        footer {
            text-align: center;
            padding: 10px 0;
            background-color: rgba(255, 255, 255, 0.8);
            position: fixed;
            width: 100%;
            bottom: 0;
            box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
<div class="background">
    <nav class="panel top" style="position: relative; z-index: 3;">
        <div class="sections">
            <div class="left">
                <a href="#">
                    <img src="assets/img/logo.jfif" alt="Logo">
                </a>
            </div>
            <div class="right">
                <a href="index.php">Retour à l'accueil</a>
            </div>
        </div>
    </nav>
    <section class="content">
        <div class="profile-container">
            <h2>Mon Profil</h2>
            <?php if (!empty($message)): ?>
                <div style="color: <?= (strpos($message, 'Erreur') !== false) ? 'red' : 'green'; ?>;">
                    <?= htmlspecialchars($message) ?>
                </div>
            <?php endif; ?>
            <form action="profile.php" method="POST">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($user['Nom'] ?? '') ?>" required>
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['Email'] ?? '') ?>" required>
                <button type="submit">Mettre à jour</button>
            </form>
            <div>
                <a href="logout.php">Se Déconnecter</a>
            </div>
            <div style="text-align: center; margin-top: 20px;">
                <a href="index.php" style="color: #007bff;">accueil</a>
            </div>
        </div>
    </section>
</div>
<footer>
    &copy; <?= date("Y") ?> Cultivio - Tous droits réservés.
</footer>
</body>
</html>
