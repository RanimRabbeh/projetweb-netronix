<?php
session_start();
require_once '../controller/ProductController.php';

if (isset($_POST['id']) && isset($_POST['user_id']) && isset($_POST['action'])) {
    $productId = $_POST['id'];
    $userId = $_POST['user_id'];
    $action = $_POST['action'];

    $productController = new ProductController();

    // Toggle like/unlike
    $productController->toggleLike($productId, $userId, $action);

    // Return updated like count
    $newLikesCount = $productController->getLikesCount($productId);
    echo json_encode(['success' => true, 'newLikesCount' => $newLikesCount]);
} else {
    echo json_encode(['success' => false]);
}
?>
