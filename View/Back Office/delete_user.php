<?php
require_once '../../Controller/UserController_B.php';

if (isset($_GET['id'])) {
    $controller = new UserController();
    $controller->deleteUser($_GET['id']);
    header('Location: list_users.php');
    exit;
}
?>
