<?php
require_once '../../Controller/ProductController_F.php';
require_once '../../Controller/ReviewController.php';

// Check if 'id' is set in the URL
if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    
    // Instantiate the ProductController to get the product by ID
    $productController = new ProductController();
    $product = $productController->getProductById($productId);

    if ($product) {
        $priceEUR = $product->getPrix() * 0.31; // Convert TND to EUR
    } else {
        echo "Product not found.";
        exit;
    }
} else {
    echo "No product ID provided.";
    exit;
}

// Get all reviews for the product
$reviewController = new ReviewController();
$reviews = $reviewController->getReviewsByProductId($productId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .product-image {
            width: 100%;
            height: 300px; /* Fixed height to make it square */
            object-fit: cover;
            border-radius: 10px;
        }
        .product-details {
            margin-top: 20px;
        }
        .product-details h2 {
            margin: 0;
            color: #333;
        }
        .product-details p {
            color: #555;
            line-height: 1.6;
        }
        .price {
            color: #e60000;
            font-size: 1.5em;
        }
        .euro-price {
            color: #ff9900;
            font-size: 1.2em;
        }
        .stars {
            display: flex;
            margin-top: 10px;
        }
        .star {
            color: #FFD700;
            font-size: 1.5em;
            margin-right: 5px;
        }
        .review-form {
            margin-top: 20px;
        }
        .review-form textarea {
            width: 100%;
            max-width: 500px; /* Limit width */
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            resize: vertical;
            margin-bottom: 10px; /* Add space between textarea and button */
        }
        .review-form button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }
        .review-form button:hover {
            background-color: #45a049;
        }
        .reviews {
            margin-top: 30px;
        }
        .review {
            background: #f1f1f1;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
            max-width: 500px; /* Limit width of reviews */
        }
        .review p {
            margin: 0;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($product) : ?>
            <img src="data:image/jpeg;base64,<?= $product->getPhoto(); ?>" alt="<?= $product->getNom(); ?>" class="product-image">
            <div class="product-details">
                <h2><?= $product->getNom(); ?></h2>
                <p>Quantité: <?= $product->getQuantite(); ?></p>
                <p class="price">Prix: <?= $product->getPrix(); ?> TND</p>
                <p class="euro-price">Prix: <?= number_format($priceEUR, 2); ?> EUR</p>
                <div class="stars">
                    <?php for ($i = 0; $i < 5; $i++): ?>
                        <span class="star">&#9733;</span>
                    <?php endfor; ?>
                </div>
            </div>
            
            <!-- Review Form (aligned left) -->
            <div class="review-form">
                <h3>Submit a Review</h3>
                <form action="submit_review.php" method="post">
                    <input type="hidden" name="product_id" value="<?= $product->getId(); ?>">
                    <textarea name="review_text" rows="5" required></textarea>
                    <button type="submit">Submit</button>
                </form>
            </div>

            <!-- Reviews List (aligned left) -->
            <div class="reviews">
                <h3>Reviews</h3>
                <?php foreach ($reviews as $review): ?>
                    <div class="review">
                        <p><strong>User ID:</strong> <?= htmlspecialchars($review->getUserId()); ?></p>
                        <p><?= htmlspecialchars($review->getReviewText()); ?></p>
                        <p><em>Submitted on <?= $review->getCreatedAt(); ?></em></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <p>Produit non trouvé.</p>
        <?php endif; ?>
    </div>
</body>
</html>
