<?php
class Database {
    // Paramètres de connexion à la base de données
    private $host = '127.0.0.1'; // Utilisez 'localhost' ou '127.0.0.1' selon votre configuration
    private $dbname = 'cultivio'; // Nom de la base de données
    private $username = 'root'; // Nom d'utilisateur (par défaut pour XAMPP)
    private $password = ''; // Mot de passe (vide par défaut pour XAMPP)
    private $db;

    public function getConnection() {
        // Connexion à la base de données avec PDO
        try {
            // Créer une connexion PDO
            $this->db = new PDO("mysql:host=$this->host;dbname=$this->dbname;charset=utf8", $this->username, $this->password);

            // Configuration des options PDO
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Mode exception pour les erreurs
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // Mode de récupération par défaut en tableau associatif

            return $this->db;
        } catch (PDOException $e) {
            // Gestion des erreurs de connexion
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }
}
?>
