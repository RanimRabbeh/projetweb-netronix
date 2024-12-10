<?php
require_once 'ProductController.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get form data
    $nom = $_POST['nom'];
    $prix = $_POST['prix'];
    $quantite = $_POST['quantite'];
    $photo = $_FILES['photo']; // Get the uploaded photo

    // Create a new Product object
    $product = new Product($nom, $prix, $quantite);

    // Create a new ProductController instance
    $productController = new ProductController();

    // Call the addProduct method, passing the product and photo
    $productController->addProduct($product, $photo);

    // Redirect to the product listing page after adding the product
    header('Location: ../view/liste.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Produit</title>
</head>
<body>
    <h2>Ajouter un Produit</h2>
    <form action="add_product.php" method="POST" enctype="multipart/form-data">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>
        <label for="prix">Prix :</label>
        <input type="number" id="prix" name="prix" required>
        <label for="quantite">Quantité :</label>
        <input type="number" id="quantite" name="quantite" required>
        <label for="photo">Photo :</label>
        <input type="file" id="photo" name="photo" required>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>
