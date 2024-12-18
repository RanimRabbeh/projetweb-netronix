<?php
require_once '../../Controller/ProductController.php';

$productController = new ProductController();

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['idProduit'])) {
    $idProduit = $_GET['idProduit'];
    $products = $productController->listProducts();
    $filteredProducts = array_filter($products, fn($p) => $p->IdProduit == $idProduit);
    $product = reset($filteredProducts);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $idProduit = $_POST['idProduit'];
    $nom = $_POST['nom'];
    $prix = $_POST['prix'];
    $quantite = $_POST['quantite'];
    $photo = $_FILES['photo'];

    if ($photo['error'] === 0) {
        $productController->updateProduct(new Product($nom, $prix, $quantite), $idProduit, $photo);
    } else {
        $productController->updateProduct(new Product($nom, $prix, $quantite), $idProduit);
    }

    header('Location: liste.php');
    exit();
}

if (!isset($product)) {
    echo "<p>Produit non trouvé !</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Produit</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 10px;
            color: #555;
        }
        input[type="text"],
        input[type="number"],
        input[type="file"] {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
            box-sizing: border-box;
        }
        button {
            padding: 15px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #218838;
        }
        .image-preview {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .image-preview img {
            max-width: 100px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Modifier un Produit</h2>
        <form action="form_product.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="idProduit" value="<?= htmlspecialchars($product->IdProduit) ?>">

            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($product->Nom) ?>" required>

            <label for="prix">Prix :</label>
            <input type="number" id="prix" name="prix" value="<?= htmlspecialchars($product->Prix) ?>" required>

            <label for="quantite">Quantité :</label>
            <input type="number" id="quantite" name="quantite" value="<?= htmlspecialchars($product->Quantite) ?>" required>

            <label for="photo">Photo :</label>
            <input type="file" id="photo" name="photo">

            <!-- Display the existing photo if it's set -->
            <?php if (!empty($product->Photo)): ?>
                <div class="image-preview">
                    <img src="data:image/jpeg;base64,<?= base64_encode($product->Photo) ?>" alt="<?= htmlspecialchars($product->Nom) ?>">
                </div>
            <?php endif; ?>

            <button type="submit">Modifier</button>
        </form>
    </div>
</body>
</html>
