<?php
require_once './Controller/ReclamationController.php';
// amlna instance mel controlleur w idha tabda el action mta3na get raw chenaytou lel reclamation lkol idha fama id donc chenaytou juste l formulaire eli tab3a id hadheka 
$controller = new ReclamationController();
$action = $_GET['action'] ?? 'list'; 
$id = $_GET['id'] ?? null;

if (method_exists($controller, $action)) {
    $controller->$action($id);
} else {
    echo "Action non trouvée.";
}
?>
