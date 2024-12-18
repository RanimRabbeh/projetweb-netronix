<?php
// getEventData.php

require_once('../../config.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare and execute the query to fetch the event details
    $db = config::getConnexion();
    $sql = "SELECT * FROM evenements WHERE Idevenement = :id";
    $query = $db->prepare($sql);

    try {
        $query->execute(['id' => $id]);
        $event = $query->fetch();

        // Return the event data as JSON
        if ($event) {
            echo json_encode(['success' => true, 'event' => $event]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Event not found']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}
?>
