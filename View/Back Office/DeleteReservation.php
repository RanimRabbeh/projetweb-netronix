<?php
// deleteReservation.php

require_once('../../config.php');

// Check if the CIN is provided
if (isset($_GET['CIN'])) {
    $cin = $_GET['CIN'];

    // Prepare the DELETE query
    $db = config::getConnexion();
    $sql = "DELETE FROM reservation WHERE CIN = :CIN";
    $query = $db->prepare($sql);

    // Execute the query
    try {
        $query->execute(['CIN' => $cin]);

        // If the query executes successfully, return a success message
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'CIN not provided']);
}
?>
