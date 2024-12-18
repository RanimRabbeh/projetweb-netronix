<?php
require_once  '../../config.php';

class AdminModel {
    private $db;

    public function __construct() {
        $Config = new Config(); 
        $this->db = $Config->getConnexion(); // Utiliser la méthode getConnexion() pour obtenir la connexion
    }
   public function getAllAdmins() {
    $query = "SELECT IdAdmin, NomUtilisateur FROM administrateurs";
    $stmt = $this->db->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    
    public function authenticate($idadmin, $mdp) {
        $query = "SELECT * FROM administrateurs WHERE idadmin = :idadmin AND mdp = :mdp";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':idadmin', $idadmin);
        $stmt->bindParam(':mdp', $mdp);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>
