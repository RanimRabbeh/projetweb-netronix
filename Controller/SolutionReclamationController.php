<?php
require_once('../../config.php');

class SolutionReclamationController {
    // Insérer une solution 
    public function insertSolution($idReclamation, $idAdmin, $solution)
    {
        $sql = "INSERT INTO solutionreclamations (IdAdmin, IdReclamation, solution) 
                VALUES (:idAdmin, :idReclamation, :solution)";
        $db = Config::getConnexion();
    
        try {
            // Insérer la solution
            $query = $db->prepare($sql);
            $query->execute([
                'idAdmin' => $idAdmin,
                'idReclamation' => $idReclamation,
                'solution' => $solution,
            ]);
    
            // Mettre à jour l'état de la réclamation
            $updateSql = "UPDATE reclamations SET Etat = 'traité' WHERE IdReclamation = :idReclamation";
            $updateQuery = $db->prepare($updateSql);
            $updateQuery->execute(['idReclamation' => $idReclamation]);
    
            return ['success' => true];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
    

    // Obtenir toutes les solutions
    public function getAllSolutions() {
        $sql = "SELECT IdSuivie, IdReclamation, solution FROM solutionreclamations";
        $db = Config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC); 
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return []; 
        }
    }

    // Obtenir une solution par son ID
    public function getSolutionById($id) {
        $sql = "SELECT * FROM solutionreclamations WHERE IdSuivie = :id";
        $db = Config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]);
            return $query->fetch(PDO::FETCH_ASSOC); 
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return null; 
        }
    }
}
?>
