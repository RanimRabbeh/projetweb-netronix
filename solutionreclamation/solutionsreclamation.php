<?php
require_once 'Controller/SolutionReclamationController.php';

$controller = new SolutionReclamationController();

// Vérification des actions possibles
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action == 'add') {
        $controller->add(); // Ajouter une solution
    } elseif ($action == 'edit' && isset($_GET['id'])) {
        $controller->edit($_GET['id']); // Modifier une solution
    } elseif ($action == 'delete' && isset($_GET['id'])) {
        $controller->delete($_GET['id']); // Supprimer une solution
    } else {
        $controller->index(); // Afficher la liste des solutions
    }
} else {
    // Si aucune action, afficher toutes les solutions
    $controller->index();
}
?>
