<?php
session_start();

// Inclure le contrôleur et le modèle
require_once '../controller/UserController.php';

// Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$userController = new UserController();
$user = $userController->getUserById($_SESSION['user_id']);  // Récupérer les données de l'utilisateur

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire pour mettre à jour le profil
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $userController->updateProfile($_SESSION['user_id'], $nom, $email);
    echo "Profil mis à jour avec succès.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil</title>
    <link rel="stylesheet" href="../css/style.css">

</head>
<body>
    <div class="profile-container">
        <h2>Mon Profil</h2>
        <form action="profile.php" method="POST">
            <input type="text" name="nom" value="<?= $user['Nom'] ?>" required>
            <input type="email" name="email" value="<?= $user['Email'] ?>" required>
            <button type="submit">Mettre à jour</button>
        </form>
        <p><a href="logout.php">Se déconnecter</a></p>
    </div>
</body>
</html>
