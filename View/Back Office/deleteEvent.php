<?php
// deleteEvent.php

require_once('../../config.php');

// Check if the event ID is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare the DELETE query
    $db = config::getConnexion();
    $sql = "DELETE FROM evenements WHERE Idevenement = :id";
    $query = $db->prepare($sql);

    // Execute the query
    try {
        $query->execute(['id' => $id]);

        // If the query executes successfully, return a success message
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}
?>
