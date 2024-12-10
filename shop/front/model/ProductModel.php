<?php
require_once 'Product.php';

class ProductModel {
    private $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO('mysql:host=localhost;dbname=your_database', 'username', 'password');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
            exit;
        }
    }

    public function getProductById($id) {
        $stmt = $this->pdo->prepare('SELECT * FROM products WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $productData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($productData) {
            return new Product($productData);
        } else {
            return null;
        }
    }
}
?>
