<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="aa.css">
    <title>Connexion Administrateur</title>
</head>
<body>
    <form action="" method="POST">
        <label for="idadmin">ID Admin :</label>
        <input type="text" id="idadmin" name="idadmin" required>

        <label for="mdp">Mot de passe :</label>
        <input type="password" id="mdp" name="mdp" required>

        <button type="submit">Se connecter</button>
    </form>

    <!-- Affichage des messages -->
    <?php if (!empty($successMessage)): ?>
        <div class="success-message"><?= htmlspecialchars($successMessage) ?></div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <div class="error-message"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
</body>
</html>
