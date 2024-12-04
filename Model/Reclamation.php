<?php
require_once '../../database.php';

class Reclamation {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    public function countReclamations() {
        $query = "SELECT COUNT(*) as count FROM reclamations";
        $stmt = $this->conn->query($query); // Utilisez $this->conn
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }
    public function countReclamationsByType() {
        $query = "SELECT TypeDeReclamation, COUNT(*) as count 
                  FROM reclamations 
                  GROUP BY TypeDeReclamation";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function countReclamationsByEtat() {
        $query = "SELECT Etat, COUNT(*) as count 
                  FROM reclamations 
                  GROUP BY Etat";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
        
    
    public function getAllReclamations() {
        $query = "SELECT * FROM reclamations";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getReclamationById($id) {
        $query = "SELECT * FROM reclamations WHERE IdReclamation = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    

    public function deleteReclamation($id) {
        $query = "DELETE FROM reclamations WHERE IdReclamation = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
    public function getMostCommonReclamationType() {
        // Récupère le type de réclamation le plus fréquent
        $query = "SELECT TypeDeReclamation, COUNT(*) as count FROM reclamations GROUP BY TypeDeReclamation ORDER BY count DESC LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getTotalReclamationsCount() {
        // Récupère le nombre total de réclamations
        $query = "SELECT COUNT(*) as total FROM reclamations";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
    
}

?>
