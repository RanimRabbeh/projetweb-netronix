<?php
// updateEvent.php

require_once('../../config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $id = $_POST['editEventId'];
    $name = $_POST['editEventName'];
    $location = $_POST['editEventLocation'];
    $date = $_POST['editEventDate'];
    $price = $_POST['editEventPrice'];
    $places = $_POST['editEventPlaces'];

    // Prepare the UPDATE query
    $db = config::getConnexion();
    $sql = "UPDATE evenements SET Nomevenement = :name, Lieuevenement = :location, Dateevenement = :date, Prixevenement = :price, Placedisponible = :places WHERE Idevenement = :id";
    $query = $db->prepare($sql);

    try {
        $query->execute([
            'id' => $id,
            'name' => $name,
            'location' => $location,
            'date' => $date,
            'price' => $price,
            'places' => $places
        ]);

        // Return a success message
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}
?>
