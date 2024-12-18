<?php
require_once '../../config.php';
require_once '../../Model/Product.php';

class ProductController {
    private $db;

    public function __construct() {
        $this->db = Config::getConnexion();
    }

    public function addProduct($product, $photo) {
        try {
            $imageContent = file_get_contents($photo["tmp_name"]);
    
            $sql = "INSERT INTO produits (Nom, Prix, Quantite, Photo) VALUES (:nom, :prix, :quantite, :photo)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':nom', $product->getNom());
            $stmt->bindParam(':prix', $product->getPrix());
            $stmt->bindParam(':quantite', $product->getQuantite());
            $stmt->bindParam(':photo', $imageContent, PDO::PARAM_LOB);
            $stmt->execute();
    
            echo "Product added successfully!";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function listProducts() {
        $sql = "SELECT * FROM produits";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function deleteProduct($idProduit) {
        $sql = "DELETE FROM produits WHERE IdProduit = :idProduit";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['idProduit' => $idProduit]);
    }

    public function updateProduct($product, $idProduit, $photo = null) {
        $imageContent = null;
        $updatePhoto = '';

        if ($photo && $photo["error"] == 0) {
            $imageContent = file_get_contents($photo["tmp_name"]);
            $updatePhoto = ", Photo = :photo";
        }

        $sql = "UPDATE produits SET Nom = :nom, Prix = :prix, Quantite = :quantite" . $updatePhoto . " WHERE IdProduit = :idProduit";
        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':nom', $product->getNom());
        $stmt->bindParam(':prix', $product->getPrix());
        $stmt->bindParam(':quantite', $product->getQuantite());
        $stmt->bindParam(':idProduit', $idProduit);

        if ($imageContent !== null) {
            $stmt->bindParam(':photo', $imageContent, PDO::PARAM_LOB);
        }

        $stmt->execute();
    }
}
?>