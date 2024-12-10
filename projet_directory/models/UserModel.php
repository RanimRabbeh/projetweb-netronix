<?php
class UserModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
        $this->console_log("Connexion à la base de données initialisée.");
    }

    // Fonction pour loguer des messages dans la console du navigateur
    private function console_log($data) {
        echo "<script>console.log(" . json_encode($data) . ");</script>";
    }

    // Vérifie si un email existe
    public function emailExists($email) {
        $query = "SELECT IdUtilisateur FROM utilisateurs WHERE Email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $this->console_log("Requête exécutée pour vérifier l'existence de l'email: " . $email);
        return $stmt->rowCount() > 0;
    }

    // Insert a new user into the database
    public function insertUser($name, $email, $password = null) {
        try {
            $query = "INSERT INTO utilisateurs (Nom, Email, Mdp) VALUES (:nom, :email, :mdp)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':nom', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindValue(':mdp', $password); // Pass NULL if no password is provided
            $result = $stmt->execute();
            console_log("Insert user result: " . $result);
            return $result;
        } catch (PDOException $e) {
            console_log("Error in insertUser: " . $e->getMessage());
            error_log($e->getMessage());
            return false;
        }
    }
    public function getUserById($userId) {
    $query = "SELECT * FROM utilisateurs WHERE IdUtilisateur = :userId";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function updateUserProfile($userId, $name, $email) {
    $query = "UPDATE utilisateurs SET Nom = :name, Email = :email WHERE IdUtilisateur = :userId";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':userId', $userId);
    return $stmt->execute();
}

    
    // Get a user by their email
    public function getUserByEmail($email) {
        try {
            $query = "SELECT * FROM utilisateurs WHERE Email = :email";
            $stmt = $this->conn->prepare($query); // Utilise correctement $this->conn (instance PDO)
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur dans getUserByEmail : " . $e->getMessage());
            return null;
        }
    }
    
    // Save the reset code in the database
    public function saveResetCode($email, $resetCode) {
        $query = "UPDATE utilisateurs SET code = :reset_code WHERE Email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':reset_code', $resetCode);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }

    // Get the reset code by email
    public function getResetCodeByEmail($email) {
        $query = "SELECT code FROM utilisateurs WHERE Email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['code'] : null;
    }

    // Update password and clear the reset code
    public function updatePassword($email, $newPassword) {
        $query = "UPDATE utilisateurs SET Mdp = :mdp, code = NULL WHERE Email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':mdp', $newPassword);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }
}
?>
