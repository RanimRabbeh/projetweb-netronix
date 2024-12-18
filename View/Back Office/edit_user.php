<?php
require_once '../../Controller/UserController_B.php';

$controller = new UserController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->updateUser($_POST['id'], $_POST['name'], $_POST['email'], $_POST['password']);
    header('Location: list_users.php');
    exit;
}

$user = $controller->getUserById($_GET['id']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier l'Utilisateur</title>
    <link rel="stylesheet" href="css/styleuser.css">
    <script src="js/formValidation.js" defer></script>
</head>
<body>
    <div class="admin-container">
        <h2>Modifier l'Utilisateur</h2>
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['IdUtilisateur']); ?>">
            <label for="name">Nom :</label>
            <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($user['Nom']); ?>" >
            
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['Email']); ?>" >
            
            <label for="password">Mot de passe :</label>
            <input type="password" name="password" id="password" placeholder="Laisser vide pour conserver l'ancien mot de passe">

            <button type="submit">Mettre à Jour</button>
        </form>
    </div>
</body>
</html>
