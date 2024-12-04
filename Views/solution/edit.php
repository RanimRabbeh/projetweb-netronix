<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier une Solution</title>
</head>
<body>
    <h1>Modifier la Solution</h1>
    <form method="POST" action="solutionsreclamation.php?action=edit&id=<?= $solution['id'] ?>">
        <label for="solution">Solution :</label>
        <textarea name="solution" required><?= $solution['solution'] ?></textarea><br><br>
        
        <button type="submit">Mettre à jour</button>
    </form>
</body>
</html>
