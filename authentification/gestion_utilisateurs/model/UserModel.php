<?php
require_once __DIR__ . '/../config/database.php';

class UserModel {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function getAllUsers() {
        $stmt = $this->db->prepare("SELECT * FROM utilisateurs");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addUser($name, $email, $password) {
        $stmt = $this->db->prepare("INSERT INTO utilisateurs (Nom, Email, Mdp) VALUES (:name, :email, :password)");
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':password' => password_hash($password, PASSWORD_BCRYPT)
        ]);
    }

    public function getUserById($id) {
        $stmt = $this->db->prepare("SELECT * FROM utilisateurs WHERE IdUtilisateur = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUser($id, $name, $email) {
        $stmt = $this->db->prepare("UPDATE utilisateurs SET Nom = :name, Email = :email WHERE IdUtilisateur = :id");
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':id' => $id
        ]);
    }

    public function deleteUserById($id) {
        $stmt = $this->db->prepare("DELETE FROM utilisateurs WHERE IdUtilisateur = :id");
        $stmt->execute([':id' => $id]);
    }
}
?>
