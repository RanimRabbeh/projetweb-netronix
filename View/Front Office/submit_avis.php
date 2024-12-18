<?php
// Include necessary files
require_once '../../config.php';
require_once '../../Controller/AvisC.php';
require_once '../../Model/Avis.php';
require_once '../../Controller/SubjectC.php';
require_once '../../Model/Subject.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $SubjectId = $_POST['subject'];  // This is the subject ID
    $Nom = $_POST['nom'];
    $Prenom = $_POST['prenom'];
    $Email = $_POST['email'];
    $Description = $_POST['description'];

    // Get the subject name based on the selected subject ID
    $db = config::getConnexion();
    $stmt = $db->prepare("SELECT name FROM subjects WHERE id = :id");
    $stmt->execute(['id' => $SubjectId]);
    $subjectResult = $stmt->fetch();

    // If a subject was found, use its name
    if ($subjectResult) {
        $SubjectName = $subjectResult['name'];  // This is the name of the subject
    } else {
        // Handle the case where the subject ID doesn't exist (optional)
        $SubjectName = 'Unknown Subject';  // Fallback to a default value
    }

    // Create an instance of Avis model and set the subject name
    $avis = new Avis(null, $SubjectName, $Nom, $Prenom, $Email, $Description);

    // Create an instance of AvisC controller and call the addAvis method
    $avisController = new avisC();
    $avisController->addAvis($avis);

    // Redirect to the front office page with a success message
    header("Location: avis-front.php?success=1");
    exit();
}
?>
