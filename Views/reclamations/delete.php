<?php
require_once '../Controller/ReclamationController.php';

// Récupère l'identifiant depuis l'URL
$id = $_GET['id'] ?? null;

if ($id) {
    $controller = new ReclamationController();
    $controller->delete($id);
} else {
    echo "Aucun identifiant fourni.";
}
