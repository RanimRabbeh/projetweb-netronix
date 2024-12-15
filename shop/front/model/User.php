<?php
require_once '../config/Database.php';  // Inclure Database.php en utilisant le chemin relatif correct

class User {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection(); // Connexion à la base de données
    }

    // Récupérer un utilisateur par son ID
    public function getUserById($id) {
        $sql = "SELECT Nom, Email FROM utilisateurs WHERE IdUtilisateur = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC); // Récupère les informations sous forme de tableau associatif

        return $user;
    }
}
?>
