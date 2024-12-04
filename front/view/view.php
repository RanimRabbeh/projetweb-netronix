<?php
require_once '../controller/ProductController.php';

// Static conversion rate from TND to EUR
$conversionRate = 0.31; // Example conversion rate (1 TND = 0.31 EUR)

$productController = new ProductController();
$products = $productController->getAllProducts();

// Sort products by price (ascending order)
usort($products, function($a, $b) {
    return $a->getPrix() - $b->getPrix(); // Compare the price of products
});
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cultivo boutique</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            background-color: #fefefe;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url('../assets/img/6.png'); /* Ensure the path is correct */
            background-size: cover; /* Optional: ensure the background covers the whole page */
            background-repeat: no-repeat; /* Optional: prevent the background from repeating */
            background-attachment: fixed;
        }

        header {
            display: flex;
            align-items: center;
            padding: 50px;
        }
        header h1.title {
            margin: 0;
            color: #9b640b;
            text-align: match-parent;
            flex: 1;
        }
        header h1 {
            margin: 0 auto; 
            color: #d4942e; 
        }

        .logo {
            height: 80px;
            margin-right: 5px; 
        }

        main {
            display: flex;
            justify-content: flex-start; /* Align items from left to right */
            flex-wrap: wrap; /* Wrap items to the next line if necessary */
            padding: 20px;
        }

        .shop-item {
            background-color: hsla(0, 0%, 100%, 1);
            border: 1px solid #3c2600d8;
            border-radius: 5px;
            padding: 5px;
            margin: 10px;
            text-align: center;
            width: 200px; /* Adjust width as needed */
        }

        .image-gallery {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .image-gallery img {
            max-width: 100%;
            border-radius: 5px;
        }

        .shop-item h2 {
            font-size: 1.2em;
            color: #010100; 
        }

        .description {
            font-size: 1em;
            color: #333; 
            display: -webkit-box;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .show-more {
            background-color: transparent;
            color: #5D3A00;
            border: none;
            cursor: pointer;
            padding: 0;
            font-size: 0.9em;
            margin-top: 5px;
        }

        .price {
            font-size: 1.1em;
            color: #000; 
            font-weight: bold;
        }

        .buy-button {
            background-color: #b3720a; 
            color: rgb(255, 255, 255);
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .buy-button:hover {
            background-color: #3b2606; 
        }

        #search-bar {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 200px;
            margin-left: 20px;
        }

        .sell-button {
            background-color: #5D3A00; 
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .sell-button:hover {
            background-color: #be965a; 
        }

        .favorite-icon {
            color:#808080; /* White color for the favorite icon */
            font-size: 1.5em;
            margin-top: 10px;
            cursor: pointer;
        }

        .favorite-icon.active {
            color: #ffd700; /* Yellow color when the icon is active */
        }

        .euro-price {
            display: none; /* Initially hide the Euro price */
            font-size: 1.1em;
            color: #ffd700;
        }

        .convert-btn {
            background-color: #5D3A00;
            color: white;
            padding: 5px 5px;
            font-size: 8px;
            border: none;
            cursor: pointer;
            margin-top: 5px;
        }

        .convert-btn:hover {
            background-color: #be965a;
        }
    </style>
</head>
<body>
    
    <header>
        <img src="logo.png" alt="Logo" class="logo">
        <h1 class="title">Cultivo boutique</h1>
        
        <div class="search-sell-container">
            <input type="text" id="search-bar" placeholder="Rechercher un produit..." onkeyup="searchProduct()">
            <a href="vente.php" target="_blank"><button class="sell-button">vendre</button></a>
        </div>
    </header>

    <main>
    <?php foreach ($products as $product) : 
    $priceEUR = $product->getPrix() * $conversionRate; // Convert TND to EUR
?>
    <div class="shop-item" data-name="<?= $product->getNom(); ?>">
    <?php if ($product->getPhoto()) : ?>
            <img src="data:image/jpeg;base64,<?= $product->getPhoto(); ?>" alt="<?= $product->getNom(); ?>" style="width: 150px; height: 90px; object-fit: cover;">
        <?php endif; ?>
        <h2><?= $product->getNom(); ?></h2>
        <p class="description"><?= $product->getQuantite(); ?></p>
        <p class="price">Prix: <?= $product->getPrix(); ?> TND</p>
        <p class="euro-price">Prix: <?= number_format($priceEUR, 2); ?> EUR</p>
        
        <button class="convert-btn" onclick="toggleEuroPrice(this)">Convert to Euro</button>
        <a href="achat.php" target="_blank"><button class="buy-button">Acheter</button></a>
        <div class="favorite-icon" onclick="toggleFavorite(this)">
            <i class="fas fa-star"></i> <!-- Font Awesome star icon -->
        </div>
    </div>
<?php endforeach; ?>


        
    </main>

    <script>
        function searchProduct() {
            const searchValue = document.getElementById('search-bar').value.toLowerCase();
            const shopItems = document.querySelectorAll('.shop-item');

            shopItems.forEach(item => {
                const itemName = item.getAttribute('data-name').toLowerCase();
                if (itemName.includes(searchValue)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        function toggleEuroPrice(button) {
            const euroPrice = button.previousElementSibling;
            euroPrice.style.display = (euroPrice.style.display === "none") ? "block" : "none";
        }

        function toggleFavorite(element) {
            element.classList.toggle('active');
        }
    </script>

</body>
</html>
