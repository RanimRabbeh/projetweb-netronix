<?php
require_once __DIR__ . '/../Model/AdminModel.php';

class AdminController {
    private $model;

    public function __construct() {
        $this->model = new AdminModel();
    }
    public function getAllAdmins() {
        return $this->model->getAllAdmins();
    }
    

    public function login() {
        session_start(); // Démarrer la session

        $successMessage = null; // Message de succès
        $error = null; // Message d'erreur

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Vérifie si les champs sont remplis
            $idadmin = $_POST['idadmin'] ?? null;
            $mdp = $_POST['mdp'] ?? null;

            if (!empty($idadmin) && !empty($mdp)) {
                $admin = $this->model->authenticate($idadmin, $mdp);

                if ($admin) {
                    // Connexion réussie, stocker l'idadmin dans la session
                    $_SESSION['admin'] = $admin['idadmin'];

                    // Message de succès (facultatif)
                    $successMessage = "Bienvenue, administrateur ! Connexion réussie.";

                    // Redirection vers la page d'accueil
                    header("Location: index.html");
                    exit();
                } else {
                    // Erreur d'authentification
                    $error = "Identifiant ou mot de passe incorrect.";
                }
            } else {
                $error = "Veuillez remplir tous les champs.";
            }
        }

        require 'Views/login.php'; 
    }
}
?>
