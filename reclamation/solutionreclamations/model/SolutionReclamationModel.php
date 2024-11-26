<?php
require_once __DIR__ . '/../database.php';

class SolutionReclamationModel {
    private $db;

    public function __construct() {
        $database = new Database(); // Créer une instance de la classe Database
        $this->db = $database->getConnection(); // Appeler la méthode sur l'instance
    }
    public function __destruct() {
        $this->db = null; // Fermer la connexion PDO
    }
    
    public function insertSolution($idReclamation, $idAdmin, $solution) {
        $query = "INSERT INTO solutionreclamations (IdAdmin, IdReclamation, solution) 
                  VALUES (:idAdmin, :idReclamation, :solution)";
        
        $stmt = $this->db->prepare($query);
        
        $stmt->bindParam(':idAdmin', $idAdmin);
        $stmt->bindParam(':idReclamation', $idReclamation);
        $stmt->bindParam(':solution', $solution);
        
        return $stmt->execute();
    }
    

    public function getAllSolutions() {
        $query = "SELECT IdSuivie, IdReclamation, solution FROM solutionreclamations";
        $stmt = $this->db->query($query);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
    
    

    // Obtenir une solution par son ID
    public function getSolutionById($id) {
        $query = "SELECT * FROM solutionreclamations WHERE IdSuivie = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Mettre à jour une solution
    public function updateSolution($id, $solution) {
        $query = "UPDATE solutionreclamations SET solution = :solution WHERE IdSuivie = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':solution', $solution);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Supprimer une solution
    public function deleteSolution($id) {
        $query = "DELETE FROM solutionreclamations WHERE IdSuivie = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
