<?php
// Include necessary files
require_once '../../Controller/SubjectC.php';

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subjectId = $_POST['id'];
    $newName = $_POST['newName'];

    // Create the controller object and call the update method
    $controller = new SubjectC();
    $controller->updateSubject($subjectId, $newName);

    // Redirect to the subject management page after update
    // After insertion, refresh the page
    header("Location: avis-back.php"); // Adjust the path as needed
    exit();
    
}
?>
