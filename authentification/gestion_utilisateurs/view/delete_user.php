<?php
require_once '../controller/UserController.php';

if (isset($_GET['id'])) {
    $controller = new UserController();
    $controller->deleteUser($_GET['id']);
    header('Location: list_users.php');
    exit;
}
?>
