<?php
require_once '../controller/ProductController.php';

$productController = new ProductController();

// Vérification si l'ID du produit est passé dans l'URL (GET)
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['idProduit'])) {
    $idProduit = $_GET['idProduit'];
    
    // Récupérer tous les produits
    $products = $productController->listProducts();

    // Filtrer les produits pour trouver celui qui correspond à l'ID
    $filteredProducts = array_filter($products, fn($p) => $p->IdProduit == $idProduit);

    // Si un produit est trouvé, on prend le premier élément du tableau filtré
    $product = reset($filteredProducts);  // Retourne le premier élément du tableau ou false si vide
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $idProduit = $_POST['idProduit'];
    $nom = $_POST['nom'];
    $prix = $_POST['prix'];
    $quantite = $_POST['quantite'];
    $photo = $_FILES['photo']['name'];

    // Upload the photo if provided
    if (!empty($photo)) {
        $targetDir = "../uploads/";
        $targetFile = $targetDir . basename($photo);
        move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile);
    } else {
        $photo = $_POST['existing_photo'];
    }

    $product = new Product($nom, $prix, $quantite, $photo);
    $productController->updateProduct($product, $idProduit);

    header('Location: liste.php');
    exit();
}

// Vérification si le produit existe avant d'afficher le formulaire
if (!isset($product)) {
    echo "<p>Produit non trouvé !</p>";
    exit(); // Arrêter l'exécution du script si le produit n'est pas trouvé
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Produit</title>
</head>
<body>
    <h2>Modifier un Produit</h2>
    <form action="form_product.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="idProduit" value="<?= $product->IdProduit ?>">
        <input type="hidden" name="existing_photo" value="<?= $product->Photo ?>">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" value="<?= $product->Nom ?>" required>
        <label for="prix">Prix :</label>
        <input type="number" id="prix" name="prix" value="<?= $product->Prix ?>" required>
        <label for="quantite">Quantité :</label>
        <input type="number" id="quantite" name="quantite" value="<?= $product->Quantite ?>" required>
        <label for="photo">Photo :</label>
        <input type="file" id="photo" name="photo">
        <?php if (!empty($product->Photo)): ?>
            <img src="../uploads/<?= $product->Photo ?>" alt="<?= $product->Nom ?>" style="width: 100px;">
        <?php endif; ?>
        <button type="submit">Modifier</button>
    </form>
</body>
</html>
