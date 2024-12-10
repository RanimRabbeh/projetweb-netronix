<?php
require_once 'ProductController.php';

$productController = new ProductController();

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['idProduit'])) {
    $idProduit = $_GET['idProduit'];
    $products = $productController->listProducts();
    $product = array_filter($products, fn($p) => $p->IdProduit == $idProduit)[0];
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
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile)) {
            // Photo uploaded successfully
        } else {
            echo 'Erreur lors de l\'upload de la photo.';
            exit;
        }
    } else {
        $photo = $_POST['existing_photo'];
    }

    $product = new Product($nom, $prix, $quantite, $photo);
    $productController->updateProduct($product, $idProduit);

    header('Location: ../view/liste.php');
    exit();
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
    <form action="edit_product.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="idProduit" value="<?= htmlspecialchars($product->IdProduit) ?>">
        <input type="hidden" name="existing_photo" value="<?= htmlspecialchars($product->Photo) ?>">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($product->Nom) ?>" required>
        <label for="prix">Prix :</label>
        <input type="number" id="prix" name="prix" value="<?= htmlspecialchars($product->Prix) ?>" required>
        <label for="quantite">Quantité :</label>
        <input type="number" id="quantite" name="quantite" value="<?= htmlspecialchars($product->Quantite) ?>" required>
        <label for="photo">Photo :</label>
        <input type="file" id="photo" name="photo">
        <button type="submit">Modifier</button>
    </form>
</body>
</html>
