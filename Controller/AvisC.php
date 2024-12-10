<?php

require_once '../../config.php';
require_once '../../Model/Avis.php';

class avisC 
{

    function addAvis($avis)
    {
        $sql = "INSERT INTO avis (Subject, Nom, Prenom, Email, Description ,Datepost) 
        VALUES (:Subject, :Nom, :Prenom, :Email, :Description, :Datepost)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'Subject' => $avis->getSubject(),
                'Nom' => $avis->getNom(),
                'Prenom' => $avis->getPrenom(),
                'Email' => $avis->getEmail(),
                'Description' => $avis->getDescription(),
                'Datepost'=> $avis->getDatepost(),

            ]);
        }   catch (Exception $e){
            echo 'Error  ' . $e->GetMessage();
        }
    }
    public function getAllAvis($subjectFilter = '') {
        global $pdo;
    
        // Base query for fetching all reviews
        $sql = "SELECT * FROM avis";
    
        // If subject filter is set, modify the query to filter by subject name
        if ($subjectFilter != '') {
            $sql .= " WHERE subject = :subjectFilter";
        }
    
        // Prepare and execute the query
        $stmt = $pdo->prepare($sql);
    
        if ($subjectFilter != '') {
            // Bind the subject filter to the query
            $stmt->bindParam(':subjectFilter', $subjectFilter, PDO::PARAM_STR);
        }
    
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
