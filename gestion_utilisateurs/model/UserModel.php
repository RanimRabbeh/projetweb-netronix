<?php
require_once __DIR__ . '/../config/database.php';

class UserModel {
    private $db;

    public function __construct() {
        $this->db = Database::connect(); // Connexion à la base via la classe Database
    }

    // Récupérer tous les utilisateurs
    public function getAllUsers() {
        $stmt = $this->db->prepare("SELECT * FROM utilisateurs");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ajouter un utilisateur
    public function addUser($name, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT); // Hachage du mot de passe
        $stmt = $this->db->prepare("INSERT INTO utilisateurs (Nom, Email, Mdp) VALUES (:name, :email, :password)");
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':password' => $hashedPassword
        ]);
    }

    // Récupérer un utilisateur par son ID
    public function getUserById($id) {
        $stmt = $this->db->prepare("SELECT * FROM utilisateurs WHERE IdUtilisateur = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Mettre à jour un utilisateur (sans changer le mot de passe)
    public function updateUser($id, $name, $email) {
        $stmt = $this->db->prepare("UPDATE utilisateurs SET Nom = :name, Email = :email WHERE IdUtilisateur = :id");
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':id' => $id
        ]);
    }

    // Mettre à jour un utilisateur (avec mot de passe)
    public function updateUserWithPassword($id, $name, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT); // Hachage du mot de passe
        $stmt = $this->db->prepare("UPDATE utilisateurs SET Nom = :name, Email = :email, Mdp = :password WHERE IdUtilisateur = :id");
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':password' => $hashedPassword,
            ':id' => $id
        ]);
    }

    // Supprimer un utilisateur par ID
    public function deleteUserById($id) {
        $stmt = $this->db->prepare("DELETE FROM utilisateurs WHERE IdUtilisateur = :id");
        $stmt->execute([':id' => $id]);
    }
}
?>
