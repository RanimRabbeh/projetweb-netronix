<?php 

require_once('../../config.php');
require_once('../../Model/Evenements.php');

class evenementsC 
{

    function addEvent($evenement)
    {
        $sql = "INSERT INTO evenements (Nomevenement, Lieuevenement, Dateevenement, Prixevenement, Placedisponible ,eventimage) 
        VALUES (:Nomevenement, :Lieuevenement, :Dateevenement, :Prixevenement, :Placedisponible, :eventimage)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'Nomevenement' => $evenement->getNomevenement(),
                'Lieuevenement' => $evenement->getLieuevenement(),
                'Dateevenement' => $evenement->getDateevenement(),
                'Prixevenement' => $evenement->getPrixevenement(),
                'Placedisponible' => $evenement->getPlacedisponible(),
                'eventimage'=> $evenement->geteventimage(),

            ]);
        }   catch (Exception $e){
            echo 'Error  ' . $e->GetMessage();
        }
    }
    public function getAllEvents() {
        $sql = "SELECT * FROM evenements";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll();  // Fetch all events and return them
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return [];  // Return an empty array in case of an error
        }
    }
}
