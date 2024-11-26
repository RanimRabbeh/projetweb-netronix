<?php
require_once __DIR__ . '/../../database.php';

class Reclamation {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    
    public function getReclamationsWithSolutionByUserId($idUtilisateur) {
        $sql = "
            SELECT r.IdReclamation,  sr.Solution, r.DescriptionDeLaReclamation
            FROM reclamations r
            LEFT JOIN solutionreclamations sr ON r.IdReclamation = sr.IdReclamation
            WHERE r.IdUtilisateur = :idUtilisateur
        ";
        
        $stmt = $this->conn->prepare($sql); 
        $stmt->execute(['idUtilisateur' => $idUtilisateur]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
   

    public function addReclamation($data) {
        try {
            $query = "INSERT INTO reclamations (IdUtilisateur, DateDeLaReclamation, TypeDeReclamation, DescriptionDeLaReclamation, PiecesJointes, Contact, Etat)
                      VALUES (:idUtilisateur, :date, :TypeDeReclamation, :description, :pieces, :contact, :etat)";
            $stmt = $this->conn->prepare($query);
    
            // Debug : vérifiez la requête et les données
            echo "Requête SQL : $query<br>";
            echo "Données : <pre>";
            print_r($data);
            echo "</pre>";
    
            $stmt->execute($data);
    
            echo "Insertion réussie.";
        } catch (PDOException $e) {
            echo "Erreur lors de l'insertion : " . $e->getMessage();
            die();
        }
    }
    
    

   
}
?>
