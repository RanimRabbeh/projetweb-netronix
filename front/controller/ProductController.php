<?php
require_once '../config/Database.php';
require_once '../model/Product.php';

class ProductController {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function addProduct($product) {
        $sql = "INSERT INTO produits (Nom, Prix, Quantite, Photo) VALUES (:nom, :prix, :quantite, :photo)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'nom' => $product->getNom(),
            'prix' => $product->getPrix(),
            'quantite' => $product->getQuantite(),
            'photo' => $product->getPhoto() // Include the photo
        ]);
    }

    public function getAllProducts() {
        $sql = "SELECT Nom, Prix, Quantite, Photo FROM produits";
        $stmt = $this->db->query($sql);
        $products = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $photoData = base64_encode($row['Photo']);
            $products[] = new Product($row['Nom'], $row['Prix'], $row['Quantite'], $photoData);
        }
        return $products;
    }
    
}
?>
