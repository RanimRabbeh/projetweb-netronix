<?php
// Include the necessary files
require_once '../../Controller/SubjectC.php';

// Get the subject ID from the URL parameter
if (isset($_GET['id'])) {
    $subjectId = $_GET['id'];

    // Create the controller object and call the delete method
    $controller = new SubjectC();
    $controller->deleteSubject($subjectId);

    // Redirect back to the subject management page after deletion
   // After insertion, refresh the page
   header("Location: avis-back.php"); // Adjust the path as needed
   exit();
    exit();
}
?>
