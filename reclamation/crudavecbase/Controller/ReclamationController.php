<?php
require_once './Model/Reclamation.php';

class ReclamationController {
    private $model;

    public function __construct() {
        $this->model = new Reclamation();
    }
//affichage de tt les reclamations
    public function list() {
        $reclamations = $this->model->getAllReclamations();
        require './View/list.php';
    }
//creation d 'une nouvelle reclamatiohn
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'idUtilisateur' => $_POST['idUtilisateur'],
                'date' => $_POST['date'],
                'type' => $_POST['type'],
                'description' => $_POST['description'],
                'pieces' => $_POST['pieces'],
                'contact' => $_POST['contact'],
                'etat' => $_POST['etat']
            ];
            $this->model->addReclamation($data);
            header('Location: index.php');//redirection vers home apres la soumission du formulaire
        }
        require './View/formulaire.php';//la fonction add on va lappeler dans la formulaire
    }
//la mise a jour 
    public function edit($id) {
        $reclamation = $this->model->getReclamationById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'idUtilisateur' => $_POST['idUtilisateur'],
                'date' => $_POST['date'],
                'type' => $_POST['type'],
                'description' => $_POST['description'],
                'pieces' => $_POST['pieces'],
                'contact' => $_POST['contact'],
                'etat' => $_POST['etat']
            ];
            $this->model->updateReclamation($id, $data);
            header('Location: index.php');
        }
        require './View/edit.php';
    }

    public function delete($id) {
        $this->model->deleteReclamation($id);
        header('Location: index.php');
    }
}
?>
