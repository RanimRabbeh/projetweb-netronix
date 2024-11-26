<?php
require_once '../includes/database.php';

class UserModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Vérifier si l'email existe déjà
    public function emailExists($email) {
        $query = "SELECT IdUtilisateur FROM utilisateurs WHERE Email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    // Insérer un nouvel utilisateur
    public function insertUser($nom, $email, $mdp) {
        $query = "INSERT INTO utilisateurs (Nom, Email, Mdp) VALUES (:nom, :email, :mdp)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':mdp', $mdp);
        return $stmt->execute();
    }

    // Récupérer un utilisateur par email
    public function getUserByEmail($email) {
        $query = "SELECT * FROM utilisateurs WHERE Email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Récupérer un utilisateur par ID
    public function getUserById($id) {
        $query = "SELECT * FROM utilisateurs WHERE IdUtilisateur = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Mettre à jour le profil de l'utilisateur
    public function updateProfile($id, $nom, $email) {
        $query = "UPDATE utilisateurs SET Nom = :nom, Email = :email WHERE IdUtilisateur = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Supprimer un utilisateur
    public function deleteAccount($id) {
        $query = "DELETE FROM utilisateurs WHERE IdUtilisateur = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Générer et stocker un code de réinitialisation
    public function saveResetCode($email, $code) {
        $query = "UPDATE utilisateurs SET reset_code = :code, reset_expires = NOW() + INTERVAL 10 MINUTE WHERE Email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':code', $code);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }

    // Vérifier le code de réinitialisation
    public function verifyResetCode($email, $code) {
        $query = "SELECT * FROM utilisateurs WHERE Email = :email AND reset_code = :code AND reset_expires > NOW()";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':code', $code);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Réinitialiser le mot de passe
    public function resetPassword($email, $newPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $query = "UPDATE utilisateurs SET Mdp = :newPassword, reset_code = NULL, reset_expires = NULL WHERE Email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':newPassword', $hashedPassword);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }
}
