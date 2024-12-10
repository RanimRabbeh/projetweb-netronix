<?php
require_once __DIR__ . '/../database.php';

class SatisfactionModel {
    private $db;

    public function __construct() {
        // Obtenir une connexion à la base de données via Database
        $database = new Database();
        $this->db = $database->getConnection(); // Correction : assignez la connexion à $this->db
        if ($this->db === null) {
            die("Erreur : Impossible de se connecter à la base de données.");
        }
    }

    public function calculerTauxSatisfaction() {
        // Vérification : s'assurer que $this->db est valide avant d'exécuter une requête
        if ($this->db === null) {
            throw new Exception("Erreur : La connexion à la base de données est invalide.");
        }

        $totalResponsesQuery = $this->db->query('SELECT COUNT(*) FROM satisfaction');
        $totalResponses = $totalResponsesQuery->fetchColumn();
        
        $positiveResponsesQuery = $this->db->query("SELECT COUNT(*) FROM satisfaction WHERE satisfaction_solution = 'Oui'");
        $positiveResponses = $positiveResponsesQuery->fetchColumn();
        
        var_dump($totalResponses, $positiveResponses); // Debug : vérifiez les valeurs
    
        if ($totalResponses > 0) {
            return ($positiveResponses / $totalResponses) * 100;
        } else {
            return 0;
        }
    }
}
?>
