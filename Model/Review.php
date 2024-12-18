<?php
class Review {
    private $id;
    private $productId;
    private $userId;
    private $reviewText;
    private $createdAt;

    public function __construct($id, $productId, $userId, $reviewText, $createdAt) {
        $this->id = $id;
        $this->productId = $productId;
        $this->userId = $userId;
        $this->reviewText = $reviewText;
        $this->createdAt = $createdAt;
    }

    public function getId() {
        return $this->id;
    }

    public function getProductId() {
        return $this->productId;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getReviewText() {
        return $this->reviewText;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }
}
?>
