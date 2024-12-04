<?php
require_once 'ProductController.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $idProduit = $_POST['idProduit'];
    $productController = new ProductController();
    $productController->deleteProduct($idProduit);

    header('Location: ../view/liste.php');
    exit();
}
?>
