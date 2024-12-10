<?php
require_once '../../Model/SatisfactionModel.php';

class SatisfactionController {
    private $model;

    public function __construct() {
        $this->model = new SatisfactionModel();
    }

   

    // Méthode pour afficher le taux de satisfaction
    public function afficherTauxSatisfaction() {
        $tauxSatisfaction = $this->model->calculerTauxSatisfaction();
    }
    
    
}
?>
