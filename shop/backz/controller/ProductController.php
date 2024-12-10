<?php
require_once '../config/Database.php';
require_once '../model/Product.php';

class ProductController {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function addProduct($product, $photo) {
        try {
            $targetDir = "../uploads/";
            $uploadOk = 1;
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
        // Handle photo upload (if a new photo is provided)
        if ($photo && $photo["error"] == 0) {
            // Handle new file upload for update
            $targetDir = "../uploads/";
            $targetFile = $targetDir . basename($photo["name"]);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            $uploadOk = 1;

            // Check if the file is an image
            if (getimagesize($photo["tmp_name"]) === false) {
                echo "Le fichier n'est pas une image.";
                $uploadOk = 0;
            }

            // Check if file already exists
            if (file_exists($targetFile)) {
                echo "Désolé, le fichier existe déjà.";
                $uploadOk = 0;
            }

            // Check file size (limit to 5MB)
            if ($photo["size"] > 5000000) {
                echo "Désolé, votre fichier est trop volumineux.";
                $uploadOk = 0;
            }

            // Allow only certain file formats (JPEG, PNG, JPG, GIF)
            if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
                echo "Désolé, seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
                $uploadOk = 0;
            }

            // Try to upload the file if everything is fine
            if ($uploadOk == 1) {
                if (move_uploaded_file($photo["tmp_name"], $targetFile)) {
                    $photoPath = basename($photo["name"]);  // Store the filename in the database
                } else {
                    echo "Désolé, une erreur est survenue lors du téléchargement de votre fichier.";
                    return;
                }
            } else {
                return;
            }
        } else {
            // If no new photo is uploaded, keep the old one
            $photoPath = $product->getPhoto();  // Assuming there's a method to get the current photo path
        }

        // Update product in the database along with the photo (if new)
        $sql = "UPDATE produits SET Nom = :nom, Prix = :prix, Quantite = :quantite, Photo = :photo WHERE IdProduit = :idProduit";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'nom' => $product->getNom(),
            'prix' => $product->getPrix(),
            'quantite' => $product->getQuantite(),
            'photo' => $photoPath,
            'idProduit' => $idProduit
        ]);
    }
}
?>
