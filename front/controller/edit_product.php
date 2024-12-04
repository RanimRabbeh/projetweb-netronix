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

    $product = new Product($nom, $prix, $quantite);
    $productController->updateProduct($product, $idProduit);

    header('Location: ../view/backoffice.php');
    exit();
}
?>
