<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cultivio boutique - vendre</title>
    <link rel="icon" href="C:\Users\Amine\Desktop\projet\view\logo.png" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: #fff;
            padding: 38px;
            border-radius: 8px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-container input[type="text"],
        .form-container input[type="number"],
        .form-container input[type="file"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .form-container button {
            width: 100%;
            padding: 12px;
            background-color: #5D3A00;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #4A2D00;
        }

        .form-container input[type="file"] {
            border: none;
            padding: 8px 0;
        }

        .form-container input[type="file"]::file-selector-button {
            background-color: #5D3A00;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        .form-container input[type="file"]::file-selector-button:hover {
            background-color: #4A2D00;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>- vendre un produit -</h2>
        <form action="../controller/add_product.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" pattern="[a-zA-Z0-9 ]+" title="Le nom doit contenir uniquement des lettres et des chiffres" required>
            <label for="prix">Prix :</label>
            <input type="number" id="prix" name="prix" min="0" step="any" inputmode="decimal" required>
            <label for="quantite">Quantité :</label>
            <input type="number" id="quantite" name="quantite" min="0" step="1" inputmode="numeric" required>
            <label for="photo">Photo :</label>
            <input type="file" id="photo" name="photo" accept="image/*" required>
            <button type="submit">Ajouter</button>
        </form>
    </div>

    <script>
        function validateForm() {
            // Get form values
            const nom = document.getElementById('nom').value;
            const prix = document.getElementById('prix').value;
            const quantite = document.getElementById('quantite').value;

            // Validate nom (only letters and numbers)
            const nomPattern = /^[a-zA-Z0-9 ]+$/;
            if (!nomPattern.test(nom)) {
                alert('Le nom doit contenir uniquement des lettres et des chiffres.');
                return false;
            }

            // Validate prix (only numbers and decimal)
            if (isNaN(prix) || prix < 0) {
                alert('Le prix doit être un nombre valide.');
                return false;
            }

            // Validate quantite (only numbers)
            if (isNaN(quantite) || quantite < 0) {
                alert('La quantité doit être un nombre valide.');
                return false;
            }

            return true;
        }
    </script>

</body>
</html>
