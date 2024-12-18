<?php
require_once '../../Controller/ProductController_F.php';

// Static conversion rate from TND to EUR
$conversionRate = 0.31; // Example conversion rate (1 TND = 0.31 EUR)

$productController = new ProductController();
$products = $productController->getAllProducts();
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
            background-image: url('assets/img/background/sslide2.jpg'); /* Ensure the path is correct */
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
            color:rgb(255, 255, 255);
            text-align: center;
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

        .search-sell-container {
            display: flex;
            align-items: center;
        }

        .search-sell-container input, .search-sell-container button {
            margin-left: 10px;
        }

        #sort-button {
            background-color:rgb(45, 75, 49); 
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            margin-left: 20px;
        }

        #sort-button:hover {
            background-color: #be965a; 
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
            max-height: 380px; /* Limit the height of each product item */
            overflow: hidden; /* Ensure the content doesn't overflow */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .image-gallery {
            display: flex;
            flex-direction: column;
            gap: 5px;
            overflow: hidden;
        }

        .image-gallery img {
            max-width: 100%;
            height: 150px; /* Set a fixed height for product images */
            object-fit: cover; /* Ensure images fit within the box */
            border-radius: 5px;
        }

        .shop-item h2 {
            font-size: 1.2em;
            color: #010100; 
            margin: 10px 0;
        }

        .description {
            font-size: 1em;
            color: #333; 
            display: -webkit-box;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            margin: 5px 0;
        }

        .price {
            font-size: 1.1em;
            color: #000; 
            font-weight: bold;
            margin: 5px 0;
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
            background-color:rgb(41, 56, 29); 
        }

        .details-button {
            background-color: #ffffff; /* White background */
            color: #000000; /* Black text */
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 12px;
            border: 1px solid #ccc; /* Light grey border */
            cursor: pointer;
            margin-top: 5px;
        }

        .details-button:hover {
            background-color: #f0f0f0; /* Slightly darker white on hover */
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
            background-color:rgb(45, 75, 49);  
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
            background-color:rgb(45, 75, 49); 
            color: white;
            padding: 5px 5px;
            font-size: 8px;
            border: none;
            cursor: pointer;
            margin-top: 5px;
        }

        .convert-btn:hover {
            background-color:rgb(45, 75, 49); 
        }
    </style>
</head>
<body>
    
    <header>
        
        <img src="logo.png" alt="Logo" class="logo">
        <h1 class="title">Cultivo boutique</h1>
        
        <div class="search-sell-container">
            <input type="text" id="search-bar" placeholder="Rechercher un produit..." onkeyup="searchProduct()">
            <button id="sort-button" onclick="sortByPrice()">de moins à plus prix</button>
            <a href="vente.php" target="_blank"><button class="sell-button">vendre</button></a>
        </div>
    </header>

    <main id="product-list">
        <?php foreach ($products as $product): ?>
        <div class="shop-item" data-price="<?= $product->getPrix(); ?>" data-clicks="0">
            <div class="image-gallery">
                <img src="data:image/jpeg;base64,<?= $product->getPhoto(); ?>" alt="Product Photo">
            </div>
            <h2><?= $product->getNom(); ?></h2>
            <p class="description"><?= $product->getQuantite(); ?></p>
            <p class="price" id="price-<?= $product->getId(); ?>">Prix: <?= $product->getPrix(); ?> TND</p>
            <button class="convert-btn" onclick="convertToEuro(this, <?= $product->getPrix(); ?>, <?= $product->getId(); ?>)">Convert to Euro</button>
            <p class="euro-price" id="euro-<?= $product->getId(); ?>"></p>
            <a href="product_details.php?id=<?= $product->getId(); ?>" target="_blank"><button class="details-button">Plus de détails</button></a>
        </div>
        <?php endforeach; ?>
    </main>

    <script>
        var originalItems = [];
        var isSorted = false;

        window.onload = function() {
            var main = document.querySelector('main');
            var shopItems = Array.from(main.getElementsByClassName('shop-item'));
            originalItems = shopItems.map(function(item) {
                return item.cloneNode(true); 
            });
        };

        function sortByPrice() {
            var main = document.querySelector('main');
            var shopItems = Array.from(main.getElementsByClassName('shop-item'));
            
            if (isSorted) {
                // Reverse the order to return to the original order
                shopItems.reverse();
            } else {
                // Sort the items based on the price
                shopItems.sort(function(a, b) {
                    var priceA = parseFloat(a.getAttribute('data-price'));
                    var priceB = parseFloat(b.getAttribute('data-price'));
                    return priceA - priceB;
                });
            }

            // Re-append sorted items in the main container
            shopItems.forEach(function(item) {
                main.appendChild(item); // Re-append in sorted order
            });

            isSorted = !isSorted; // Toggle the sorting state
        }

        function searchProduct() {
            var input, filter, main, shopItems, h2, i, txtValue;
            input = document.getElementById('search-bar');
            filter = input.value.toUpperCase();
            main = document.querySelector('main');
            shopItems = main.getElementsByClassName('shop-item');

            for (i = 0; i < shopItems.length; i++) {
                h2 = shopItems[i].getElementsByTagName('h2')[0];
                if (h2) {
                    txtValue = h2.textContent || h2.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        shopItems[i].style.display = '';
                    } else {
                        shopItems[i].style.display = 'none';
                    }
                }
            }
        }

        function convertToEuro(button, priceTND, productId) {
            var product = button.closest('.shop-item');
            var clickCount = parseInt(product.getAttribute('data-clicks'));
            var maxClicks = 3; // Stop after 3 clicks
            var euroPrice = priceTND * <?= $conversionRate; ?>;
            var euroPriceElement = document.getElementById('euro-' + productId);
            var priceElement = document.getElementById('price-' + productId);

            if (clickCount < maxClicks) {
                if (euroPriceElement.style.display === "none" || euroPriceElement.style.display === "") {
                    euroPriceElement.innerText = "Prix: " + euroPrice.toFixed(2) + " EUR";
                    euroPriceElement.style.display = "block";
                    priceElement.style.display = "none";
                    product.setAttribute('data-clicks', clickCount + 1); // Increment click count
                } else {
                    euroPriceElement.style.display = "none";
                    priceElement.style.display = "block";
                }
            } else {
                button.disabled = true; // Disable button after max clicks
                button.innerText = "Max Clicks Reached"; // Change button text to indicate the limit
            }
        }
    </script>
</body>
</html>
