<?php
// path_to_your_php_script.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $Nomevenement = $_POST['Nomevenement'];
    $Lieuevenement = $_POST['Lieuevenement'];
    $Dateevenement = $_POST['Dateevenement'];
    $Prixevenement = $_POST['Prixevenement'];
    $Placedisponible = $_POST['Placedisponible'];

    // Include your classes (EvenementsC, Evenements)
    require_once('../config.php');
    require_once('../Model/Evenements.php');
    require_once('../Controller/EvenementsC.php');

    // Handle image upload
    $eventImage = null; // Default to null in case no image is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $targetDir = "../uploads/"; // Directory to save images (adjust path as needed)
        $eventImage = uniqid() . "_" . basename($_FILES['image']['name']); // Unique file name
        $targetFilePath = $targetDir . $eventImage;

        // Create the directory if it doesn't exist
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Move the uploaded file
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
            echo json_encode(['success' => false, 'message' => 'Error uploading image.']);
            exit; // Stop further processing
        }
    }

    // Create an instance of Evenements and EvenementsC to save the data
    $evenement = new Evenements(null, $Nomevenement, $Lieuevenement, $Dateevenement, $Prixevenement, $Placedisponible, $eventImage);
    $controller = new evenementsC();
    $controller->addEvent($evenement);

    // Send a JSON response
    echo json_encode(['success' => true]);  // Send a success response
}
?>
