<?php
require_once '../../config.php';
require_once '../../Controller/CommentC.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $updatedComment = $_POST['comment'];

    if (!empty($id) && !empty($updatedComment)) {
        $pdo = config::getConnexion();
        CommentC::updateComment($pdo, $id, $updatedComment);
        header("Location: avis-back.php"); // Redirect to the back office page
        exit();
    } else {
        echo "Error: All fields are required.";
    }
}
