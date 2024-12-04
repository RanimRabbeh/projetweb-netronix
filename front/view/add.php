<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un produit</title>
</head>
<body>
    <h1>Ajouter un nouveau produit</h1>
    <form action="../add_product_action.php" method="POST" enctype="multipart/form-data">
        <label for="nom_produit">Nom du produit :</label>
        <input type="text" id="nom_produit" name="nom_produit" required><br><br>

        <label for="prix">Prix :</label>
        <input type="text" id="prix" name="prix" required><br><br>

        <label for="image">Image :</label>
        <input type="file" id="image" name="image" required><br><br>

        <input type="submit" value="Ajouter le produit">
    </form>
</body>
</html>
