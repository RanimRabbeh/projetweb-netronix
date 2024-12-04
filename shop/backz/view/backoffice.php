<?php
require_once '../controller/ProductController.php';

$productController = new ProductController();
$products = $productController->listProducts();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Produits</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Liste des Produits</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $product->IdProduit ?></td>
                    <td><?= $product->Nom ?></td>
                    <td><?= $product->Prix ?></td>
                    <td><?= $product->Quantite ?></td>
                    <td>
                        <form action="../controller/delete_product.php" method="POST" style="display: inline;">
                            <input type="hidden" name="idProduit" value="<?= $product->IdProduit ?>">
                            <button type="submit">Supprimer</button>
                        </form>
                        <form action="form_product.php" method="GET" style="display: inline;">
                            <input type="hidden" name="idProduit" value="<?= $product->IdProduit ?>">
                            <button type="submit">Modifier</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Ajouter un Produit</h2>
    <form action="../controller/add_product.php" method="POST">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>
        <label for="prix">Prix :</label>
        <input type="number" id="prix" name="prix" required>
        <label for="quantite">Quantité :</label>
        <input type="number" id="quantite" name="quantite" required>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>
