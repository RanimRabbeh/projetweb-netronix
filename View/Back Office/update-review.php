<?php
require_once '../../config.php'; // Include the database connection
$pdo = Config::getConnexion(); 
if (isset($_POST['updateReview'])) {
    $idavis = $_POST['idavis'];
    $description = $_POST['description'];

    try {
        // Prepare the update query
        $query = "UPDATE Avis SET Description = :description WHERE Idavis = :idavis";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':idavis', $idavis, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "<script>alert('Review updated successfully!');</script>";
        } else {
            echo "<script>alert('Failed to update review.');</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    }

    // Redirect back to the reviews page
    header("Location: avis-back.php");
    exit;
} else {
    echo "<script>alert('Invalid request.');</script>";
    header("Location: avis-back.php");
    exit;
}
?>
