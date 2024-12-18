<?php
require_once '../../Controller/CommentC.php';

if (isset($_GET['id'])) {
    $commentC = new CommentC();
    $commentC->deleteComment($_GET['id']);
    header('Location: avis-back.php');
}
?>
