<?php
require_once '../../Model/Comment.php';
require_once '../../config.php'; // Include the database connection
$pdo = Config::getConnexion();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['avis_id']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['comment'])) {
    // Validate inputs
    if (!empty($_POST['avis_id']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['comment'])) {
        // Prepare the insert query
        $query = "INSERT INTO comments (avis_id, nom, prenom, comment) VALUES (:avis_id, :nom, :prenom, :comment)";
        $stmt = $pdo->prepare($query);

        // Bind the values
        $stmt->bindParam(':avis_id', $_POST['avis_id']);
        $stmt->bindParam(':nom', $_POST['nom']);
        $stmt->bindParam(':prenom', $_POST['prenom']);
        $stmt->bindParam(':comment', $_POST['comment']);

        // Execute the query
        if ($stmt->execute()) {
            // Redirect back to the avis page
            header("Location: avis-front.php?success=1");
        } else {
            echo "Error: Unable to submit comment.";
        }
    } else {
        echo "Error: All fields are required.";
    }
}
?>
