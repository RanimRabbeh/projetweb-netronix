<?php
class UserModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Vérifier si l'email existe dans la base de données
    public function emailExists($email) {
        $query = "SELECT IdUtilisateur FROM utilisateurs WHERE Email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    // Insérer un utilisateur dans la base de données
    public function insertUser($name, $email, $password) {
        $query = "INSERT INTO utilisateurs (Nom, Email, Mdp) VALUES (:nom, :email, :mdp)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nom', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':mdp', $password);
        return $stmt->execute();
    }

    // Récupérer un utilisateur par son email
    public function getUserByEmail($email) {
        $query = "SELECT * FROM utilisateurs WHERE Email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Sauvegarder le code de réinitialisation dans la base de données
    public function saveResetCode($email, $resetCode) {
        $query = "UPDATE utilisateurs SET code = :reset_code WHERE Email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':reset_code', $resetCode);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }

    // Récupérer le code de réinitialisation par email
    public function getResetCodeByEmail($email) {
        $query = "SELECT code FROM utilisateurs WHERE Email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['code'] : null;
    }

    // Mettre à jour le mot de passe après vérification du code
    public function updatePassword($email, $newPassword) {
        $query = "UPDATE utilisateurs SET Mdp = :mdp, code = NULL WHERE Email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':mdp', $newPassword);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }
}
?>
