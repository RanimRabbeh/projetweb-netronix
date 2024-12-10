<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Forum</title>
</head>

<body>
    <h1>Add a Forum Entry</h1>
    <form action="/cultivio/index.php?action=addForum" method="POST">
        <label for="utilisateur">Utilisateur:</label>
        <input type="text" id="utilisateur" name="utilisateur" required><br><br>

        <label for="avis">Avis:</label>
        <textarea id="avis" name="avis" rows="4" required></textarea><br><br>

        <button type="submit">Add Forum</button>
    </form>
</body>

</html>