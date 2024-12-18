<?php
require_once('../../config.php');
require_once('../../Model/SatisfactionModel.php'); 

class SatisfactionController {
    // Ajouter une satisfaction avec des étoiles
    public function ajouterSatisfaction($rating) {
        $sql = "INSERT INTO satisfaction (satisfaction_solution) VALUES (:rating)";
        $db = Config::getConnexion();
        
        try {
            $query = $db->prepare($sql);
            $query->execute(['rating' => $rating]);
            return ['success' => true];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    // Calculer le taux de satisfaction
    public function calculerTauxSatisfaction() {
        $sql = "SELECT 
                    COUNT(*) AS total,
                    SUM(CASE WHEN satisfaction_solution >= 4 THEN 1 ELSE 0 END) AS total_satisfied,
                    SUM(CASE WHEN satisfaction_solution = 3 THEN 1 ELSE 0 END) AS total_neutral,
                    SUM(CASE WHEN satisfaction_solution <= 2 THEN 1 ELSE 0 END) AS total_dissatisfied
                FROM satisfaction";
        $db = Config::getConnexion();

        try {
            $result = $db->query($sql);
            return $result->fetch(PDO::FETCH_ASSOC); // Retourner le taux de satisfaction calculé
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

   
    // Obtenir toutes les satisfactions
    public function getAllSatisfactions() {
        $sql = "SELECT * FROM satisfaction";
        $db = Config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC); // Retourner toutes les satisfactions
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
    public function afficherTauxSatisfaction() {
    // Appel directement à la méthode calculerTauxSatisfaction
    $data = $this->calculerTauxSatisfaction();  
    
    $totalResponses = $data['total'];
    
    if ($totalResponses > 0) {
        $tauxSatisfaction = ($data['total_satisfied'] / $totalResponses) * 100;
    } else {
        $tauxSatisfaction = 0;
    }
    
    return number_format($tauxSatisfaction, 2);  // Retourner le pourcentage formaté
}


    // Obtenir une satisfaction par son ID
    public function getSatisfactionById($id) {
        $sql = "SELECT * FROM satisfaction WHERE IdSatisfaction = :id";
        $db = Config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]);
            return $query->fetch(PDO::FETCH_ASSOC); 
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
    
}
?>
