<?php
require_once('../models/UserModel.php');


class UtilisateurController {
    private $model;

    public function __construct($db) {
        $this->model = new UtilisateurModel($db);
    }

    // Afficher la liste des utilisateurs
    public function index() {
        $utilisateurs = $this->model->getAllUtilisateurs();
        include 'views/utilisateur/index.php';
    }

    // Afficher le formulaire pour ajouter un utilisateur
    public function create() {
        include 'views/utilisateur/create.php';
    }

    // Ajouter un utilisateur
    public function store() {
        if (isset($_POST['username'], $_POST['password'], $_POST['email'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $this->model->addUtilisateur($username, $password, $email);
            header('Location: index.php?action=index');
        }
    }

    // Afficher le formulaire pour modifier un utilisateur
    public function edit($id) {
        $utilisateur = $this->model->getAllUtilisateurs($id);
        include 'views/utilisateur/edit.php';
    }

    // Mettre à jour un utilisateur
    public function update($id) {
        if (isset($_POST['username'], $_POST['password'], $_POST['email'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $this->model->updateUtilisateur($id, $username, $password, $email);
            header('Location: index.php?action=index');
        }
    }

    // Supprimer un utilisateur
    public function destroy($id) {
        $this->model->deleteUtilisateur($id);
        header('Location: index.php?action=index');
    }
}
?>
