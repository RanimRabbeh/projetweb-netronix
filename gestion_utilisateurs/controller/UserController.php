<?php
require_once __DIR__ . '/../model/UserModel.php';

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    // Récupérer tous les utilisateurs
    public function getUsers() {
        return $this->userModel->getAllUsers();
    }

    // Ajouter un nouvel utilisateur
    public function createUser($name, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hachage du mot de passe
        $this->userModel->addUser($name, $email, $hashedPassword);
    }

    // Récupérer un utilisateur par son ID
    public function getUserById($id) {
        return $this->userModel->getUserById($id);
    }

    // Mettre à jour un utilisateur (avec ou sans mot de passe)
    public function updateUser($id, $name, $email, $password = null) {
        if (!empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hachage du mot de passe
            $this->userModel->updateUserWithPassword($id, $name, $email, $hashedPassword);
        } else {
            $this->userModel->updateUser($id, $name, $email);
        }
    }

    // Supprimer un utilisateur
    public function deleteUser($id) {
        $this->userModel->deleteUserById($id);
    }
}
?>
