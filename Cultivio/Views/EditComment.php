<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un commentaire</title>
    <link rel="stylesheet" href="./Back/css/mystyle.css"> <!-- Optional for styling -->
</head>

<body>
    <h1>Modifier le commentaire</h1>
    <form action="saveComment.php" method="POST">
        <label for="comment">Commentaire :</label>
        <textarea id="comment" name="comment" rows="4" cols="50">
            <?php
            // Get the comment from the query parameter
            if (isset($_GET['comment'])) {
                echo htmlspecialchars($_GET['comment']);
            }
            ?>
        </textarea>
        <br>
        <button type="submit">Enregistrer</button>
        <button type="button" onclick="window.history.back();">Annuler</button>
    </form>
</body>

</html>