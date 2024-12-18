<?php
require_once '../../Controller/ReviewController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['product_id'], $_POST['review_text'])) {
        $productId = $_POST['product_id'];
        $reviewText = $_POST['review_text'];
        $userId = 1; // Replace with actual user ID from session or context

        $reviewController = new ReviewController();
        if ($reviewController->addReview($productId, $userId, $reviewText)) {
            header("Location: product_details.php?id=$productId");
            exit;
        } else {
            echo "Error submitting review.";
        }
    } else {
        echo "Invalid input.";
    }
} else {
    echo "Invalid request method.";
}
?>
