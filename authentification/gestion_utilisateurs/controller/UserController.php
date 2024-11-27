<?php
require_once __DIR__ . '/../model/UserModel.php';

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function getUsers() {
        return $this->userModel->getAllUsers();
    }

    public function createUser($name, $email, $password) {
        $this->userModel->addUser($name, $email, $password);
    }

    public function getUserById($id) {
        return $this->userModel->getUserById($id);
    }

    public function updateUser($id, $name, $email) {
        $this->userModel->updateUser($id, $name, $email);
    }

    public function deleteUser($id) {
        $this->userModel->deleteUserById($id);
    }
    
}
?>
