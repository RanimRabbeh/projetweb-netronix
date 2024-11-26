<?php
class Database {
    private $host = "127.0.0.1";  // Hôte de votre base de données
    private $db_name = "cultivio";  // Nom de la base de données
    private $username = "root";  // Nom d'utilisateur
    private $password = "";  // Mot de passe (laisser vide si pas défini)
    private $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, 
                                  $this->username, 
                                  $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Erreur de connexion à la base de données : " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
