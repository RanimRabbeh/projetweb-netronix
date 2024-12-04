<?php
require_once '../../Model/Reclamation.php';

class ReclamationController {
    private $model;

    public function __construct() {
        $this->model = new Reclamation();
    }
    public function getReclamations() {
        // Récupère les réclamations
        return $this->model->getAllReclamations();
    }
    public function countReclamations() {
        return $this->model->countReclamations();
    }
    public function getReclamationsCountByType() {
        return $this->model->countReclamationsByType();
    }
    public function getReclamationsCountByEtat() {
        return $this->model->countReclamationsByEtat();
    }
    public function getMostCommonReclamationTypeAndPercentage() {
        // Récupère le type de réclamation le plus fréquent
        $mostCommonType = $this->model->getMostCommonReclamationType();
        // Récupère le nombre total de réclamations
        $totalReclamations = $this->model->getTotalReclamationsCount();
    
        // Calcul du pourcentage
        $percentage = 0;
        if ($totalReclamations > 0) {
            $percentage = ($mostCommonType['count'] / $totalReclamations) * 100;
        }
    
        // Déterminer le statut
        $status = 'faible';
        if ($percentage >= 50) {
            $status = 'critique';
        } elseif ($percentage >= 20) {
            $status = 'moyen';
        }
    
        return [
            'type' => $mostCommonType['TypeDeReclamation'],
            'count' => $mostCommonType['count'],
            'percentage' => $percentage,
            'status' => $status
        ];
    }
                

   

    public function delete($id) {
        // Supprime la réclamation du modèle
        $this->model->deleteReclamation($id);
    }
}
?>
