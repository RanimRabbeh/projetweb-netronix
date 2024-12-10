<?php
require_once '../controller/ProductController.php';

// Check if 'id' is set in the URL
if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    
    // Instantiate the ProductController to get the product by ID
    $productController = new ProductController();
    $product = $productController->getProductById($productId);

    if ($product) {
        $priceEUR = $product->getPrix() * 0.31; // Convert TND to EUR
    } else {
        echo "Product not found.";
        exit;
    }
} else {
    echo "No product ID provided.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .product-image {
            width: 100%;
            height: 300px; /* Fixed height to make it square */
            object-fit: cover;
            border-radius: 10px;
        }
        .product-details {
            margin-top: 20px;
        }
        .product-details h2 {
            margin: 0;
            color: #333;
        }
        .product-details p {
            color: #555;
            line-height: 1.6;
        }
        .price {
            color: #e60000;
            font-size: 1.5em;
        }
        .euro-price {
            color: #ff9900;
            font-size: 1.2em;
        }
        .stars {
            display: flex;
            margin-top: 10px;
        }
        .star {
            color: #FFD700;
            font-size: 1.5em;
            margin-right: 5px;
        }
        .buy-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
        }
        .buy-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($product) : ?>
            <img src="data:image/jpeg;base64,<?= $product->getPhoto(); ?>" alt="<?= $product->getNom(); ?>" class="product-image">
            <div class="product-details">
                <h2><?= $product->getNom(); ?></h2>
                <p>Quantité: <?= $product->getQuantite(); ?></p>
                <p class="price">Prix: <?= $product->getPrix(); ?> TND</p>
                <p class="euro-price">Prix: <?= number_format($priceEUR, 2); ?> EUR</p>
                <div class="stars">
                    <?php for ($i = 0; $i < 5; $i++): ?>
                        <span class="star">&#9733;</span>
                    <?php endfor; ?>
                </div>
                <a href="contact_vendeur.php?id=<?= $product->getId(); ?>" class="buy-button">Contacter le vendeur</a>
            </div>
        <?php else : ?>
            <p>Produit non trouvé.</p>
        <?php endif; ?>
    </div>
</body>
</html>
