<?php
require_once '../../config.php';
$pdo = Config::getConnexion(); 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['subjectName'])) {
    $subjectName = htmlspecialchars($_POST['subjectName']);

    $query = "INSERT INTO subjects (name) VALUES (:subjectName)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':subjectName', $subjectName);
    
    if ($stmt->execute()) {
        // After insertion, refresh the page
    header("Location: avis-back.php"); // Adjust the path as needed
    exit();
    } else {
        echo "Error adding subject.";
    }
    
}
?>
