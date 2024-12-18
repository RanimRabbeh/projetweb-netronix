<?php
require_once '../../config.php';
require_once '../../Model/Review.php';

class ReviewController {
    private $db;

    public function __construct() {
        $this->db = Config::getConnexion();
    }

    public function addReview($productId, $userId, $reviewText) {
        $sql = "INSERT INTO reviews (product_id, user_id, review_text) VALUES (:product_id, :user_id, :review_text)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'product_id' => $productId,
            'user_id' => $userId,
            'review_text' => $reviewText
        ]);
    }

    public function getReviewsByProductId($productId) {
        $sql = "SELECT * FROM reviews WHERE product_id = :product_id ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['product_id' => $productId]);
        $reviews = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $reviews[] = new Review(
                $row['id'],
                $row['product_id'],
                $row['user_id'],
                $row['review_text'],
                $row['created_at']
            );
        }
        return $reviews;
    }
}
?>
