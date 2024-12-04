<?php
require_once '../controller/UserController.php';

$userController = new UserController();
$users = $userController->getUsers();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Utilisateurs</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="admin-container">
        <h1>Liste des Utilisateurs</h1>
        <a href="add_user.php" class="button add-user-button">Ajouter un Utilisateur</a>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($users)): ?>
                    <tr>
                        <td colspan="3">Aucun utilisateur trouvé.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['Nom']); ?></td>
                            <td><?php echo htmlspecialchars($user['Email']); ?></td>
                            <td>
                                 <!-- Bouton Modifier -->
    <a href="edit_user.php?id=<?php echo $user['IdUtilisateur']; ?>" class="button edit-button">Modifier</a>
    <!-- Bouton Supprimer -->
    <a href="delete_user.php?id=<?php echo $user['IdUtilisateur']; ?>" class="button delete-button">Supprimer</a>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
