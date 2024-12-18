<?php
// GetReservationData.php

require_once('../../config.php');

if (isset($_GET['CIN'])) {
    $cin = $_GET['CIN']; // Get the CIN value from the query string

    // Prepare and execute the query to fetch the reservation details
    $db = config::getConnexion();
    $sql = "SELECT * FROM reservation WHERE CIN = :cin";
    $query = $db->prepare($sql);

    try {
        $query->execute(['CIN' => $cin]);
        $reservation = $query->fetch();

        // Return the reservation data as JSON
        if ($reservation) {
            echo json_encode(['success' => true, 'reservation' => $reservation]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Reservation not found']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}
?>
