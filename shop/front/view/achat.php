<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cultivo boutique</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="C:\Users\Amine\Desktop\projet\view\logo.png" type="image/x-icon">
    <style>
        body {
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        header {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .header-container {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            position: relative;
        }

        header h1.title {
            margin: 0;
            color: #5D3A00;
            text-align: center;
            flex: 1;
        }

        .logo {
            height: 50px;
            position: absolute;
            left: 20px; 
        }

        .search-sell-container {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        #search-bar {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 200px;
            margin-right: 10px;
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
            background-color: #4A2D00; 
        }

        .shop-item-container {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }

        .shop-item {
            background-color: white;
            border: 1px solid #fcbc;
            border-radius: 5px;
            padding: 20px;
            margin: 10px;
            text-align: center;
            width: 200px;
        }

        .buy-button {
            background-color: #5D3A00; 
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .buy-button:hover {
            background-color: #4A2D00; 
        }

        .image-gallery {
            display: flex;
            justify-content: center;
        }

        .image-gallery img {
            margin: 5px;
            width: 150px;
            height: 150px;
        }

        .description {
            max-height: 50px;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .description.expanded {
            max-height: none;
        }

        .show-more {
            cursor: pointer;
            color: rgb(52, 37, 3);
            text-decoration: underline;
        }

        .order-form {
            display: none;
            background-color: #fff;
            border: 1px solid #e8b977;
            border-radius: 15px;
            padding: 30px;
            width: 300px;
            margin: 7px;
        }

        .order-form input, .order-form textarea {
            width: 100%;
            padding: 7px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .order-form button {
            background-color: #000000; 
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .order-form button:hover {
            background-color: #156614; 
        }
    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <img src="C:\Users\Amine\Desktop\projet\view\logo.png" class="logo">
            <h1 class="title">Cultivo boutique</h1>
        </div>
       
        <div class="search-sell-container">
            <input type="text" id="search-bar" placeholder="Rechercher un produit..." onkeyup="searchProduct()">
            <a href="vente.php" target="_blank"><button class="buy-button">vendre</button></a>
        </div>
    </header>
    <main>
        <div class="shop-item-container">
            <div class="shop-item" data-name="Article 1">
        
                <h2>produit 1</h2>
                <p class="description">2</p>
                <span class="show-more" onclick="toggleDescription(this)">Afficher plus</span>
                <p class="price">Prix: 100 TND</p>
                <button class="buy-button" onclick="openOrderForm('Article 1', '100TND')">Acheter</button>
            </div>
            <div class="order-form" id="order-form">
                <h2>Passer une commande</h2>
                <form>
                    <label for="name">Nom*:</label>
                    <input type="text" id="name" name="name" required>

                    <label for="surname">Prénom*:</label>
                    <input type="text" id="surname" name="surname" required>
                    <label for="numtel">numero de telephone*:</label>
                    <input type="text" id="surname" name="surname" required>

                    <label for="address">Adresse*:</label>
                    <textarea id="address" name="address" required></textarea>

                    <label for="price">Prix:</label>
                    <input type="text" id="price" name="price" readonly>


                    <button type="submit">Commander</button>
                </form>
            </div>
        </div>
    </main>
    <script>
        function toggleDescription(element) {
            const description = element.previousElementSibling;
            description.classList.toggle('expanded');
            if (description.classList.contains('expanded')) {
                element.textContent = 'Afficher moins';
            } else {
                element.textContent = 'Afficher plus';
            }
        }

        function openOrderForm(articleName, articlePrice) {
            const orderForm = document.getElementById('order-form');
            orderForm.style.display = 'block';
            document.getElementById('price').value = articlePrice;
        }
    </script>
</body>
</html>
