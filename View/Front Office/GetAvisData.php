<?php
// GetavisData.php

require_once('../../config.php');

if (isset($_GET['Idavis'])) {
    $id = $_GET['Idavis']; // Get the CIN value from the query string

    // Prepare and execute the query to fetch the avis details
    $db = config::getConnexion();
    $sql = "SELECT * FROM avis WHERE Idavis = :id";
    $query = $db->prepare($sql);

    try {
        $query->execute(['Idavis' => $id]);
        $avis = $query->fetch();

        // Return the avis data as JSON
        if ($avis) {
            echo json_encode(['success' => true, 'avis' => $avis]);
        } else {
            echo json_encode(['success' => false, 'error' => 'avis not found']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}
?>
