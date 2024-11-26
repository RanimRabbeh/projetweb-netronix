<?php
require_once '../../Model/SolutionReclamationModel.php';

class SolutionReclamationController {
    private $model;

    public function __construct() {
        $this->model = new SolutionReclamationModel();
    }

    // Afficher toutes les solutions
    public function index() {
        try {
            $solutions = $this->model->getAllSolutions();
            return $solutions;
        } catch (Exception $e) {
            echo "Erreur dans index() : " . $e->getMessage();
            return [];
        }
    }
    public function addSolution($idReclamation, $idAdmin, $solution) {
        return $this->model->insertSolution($idReclamation, $idAdmin, $solution);
    }
    

    // Modifier une solution
    public function edit($id) {
        $solution = $this->model->getSolutionById($id);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $solutionText = $_POST['solution'];
            
            if ($this->model->updateSolution($id, $solutionText)) {
                $successMessage = "Solution mise à jour avec succès.";
            } else {
                $errorMessage = "Erreur lors de la mise à jour de la solution.";
            }
        }

        require 'Views/solutionsreclamation/edit.php'; // Vue pour modifier une solution
    }

    // Supprimer une solution
    public function delete($id) {
        if ($this->model->deleteSolution($id)) {
            $successMessage = "Solution supprimée avec succès.";
        } else {
            $errorMessage = "Erreur lors de la suppression de la solution.";
        }
        
        // Rediriger vers la liste des solutions après la suppression
        header("Location: index.php"); 
        exit();
    }
}
?>
