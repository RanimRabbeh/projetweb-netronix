<?php
require_once('../../config.php');
require_once('../../Model/Reservations.php');

class ReservationC
{
    // Insert reservation into the Config
    public function insertReservation($reservation)
    {
        $sql = "INSERT INTO reservations (Nom, Prenom, CIN, eventname, eventdate, Baggage, Email, dateReservation,IdEvent) 
                VALUES (:Nom, :Prenom, :CIN, :eventname, :eventdate, :Baggage, :Email, :dateReservation, :IdEvent)";
        $db = Config::getConnexion();
        
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'Nom' => $reservation->getNom(),
                'Prenom' => $reservation->getPrenom(),
                'CIN' => $reservation->getCIN(),
                'eventname' => $reservation->geteventname(),
                'eventdate' => $reservation->geteventdate(),
                'Baggage' => $reservation->getBaggage(),
                'dateReservation' => $reservation->getDateReservation(),
                'Email' => $reservation->getEmail(),
                'IdEvent' =>$reservation->getIdEvent(),
            ]);
            return ['success' => true];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
    public function getAllReservations() {
        $sql = "SELECT * FROM reservations";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll();  // Fetch all reservations and return them
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return [];  // Return an empty array in case of an error
        }
    }
    public function getReservationsCounts() {
        $sql = "SELECT eventname, COUNT(*) AS reservations_count
                FROM reservations
                GROUP BY eventname";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll(); // Returns all subscription counts by type
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return [];  // Return an empty array in case of an error
        }
}
}


?>
