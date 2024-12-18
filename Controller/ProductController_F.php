<?php
require_once '../../config.php';
require_once '../../Model/Product_F.php';

class ProductController {
    private $db;

    public function __construct() {
        $this->db = Config::getConnexion();
    }

    public function addProduct($product) {
        $sql = "INSERT INTO produits (Nom, Prix, Quantite, Photo, IdUtilisateur) VALUES (:nom, :prix, :quantite, :photo, :idUtilisateur)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'nom' => $product->getNom(),
            'prix' => $product->getPrix(),
            'quantite' => $product->getQuantite(),
            'photo' => $product->getPhoto(),
            'idUtilisateur' => $product->getIdUtilisateur()
        ]);
    }

    public function getAllProducts() {
        $sql = "SELECT IdProduit, Nom, Prix, Quantite, Photo, IdUtilisateur FROM produits";
        $stmt = $this->db->query($sql);
        $products = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $photoData = base64_encode($row['Photo']);
            $products[] = new Product(
                $row['Nom'],
                $row['Prix'],
                $row['Quantite'],
                $photoData,
                $row['IdUtilisateur'],
                $row['IdProduit']
            );
        }
        return $products;
    }

    public function getProductById($id) {
        $sql = "SELECT IdProduit, Nom, Prix, Quantite, Photo, IdUtilisateur FROM produits WHERE IdProduit = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $photoData = base64_encode($row['Photo']);
            return new Product(
                $row['Nom'],
                $row['Prix'],
                $row['Quantite'],
                $photoData,
                $row['IdUtilisateur'],
                $row['IdProduit']
            );
        }

        return null;
    }
}
?>
