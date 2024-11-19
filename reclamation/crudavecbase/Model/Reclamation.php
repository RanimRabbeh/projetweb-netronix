<?php
require_once 'database.php';

class Reclamation {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAllReclamations() {
        $query = "SELECT * FROM reclamations";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getReclamationById($id) {
        $query = "SELECT * FROM reclamations WHERE IdReclamation = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addReclamation($data) {
        $query = "INSERT INTO reclamations (IdUtilisateur, DateDeLaReclamation, TypeDeReclamation, DescriptionDeLaReclamation, PiecesJointes, Contact, Etat)
                  VALUES (:idUtilisateur, :date, :type, :description, :pieces, :contact, :etat)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute($data);
    }

    public function updateReclamation($id, $data) {
        $query = "UPDATE reclamations SET IdUtilisateur = :idUtilisateur, DateDeLaReclamation = :date, TypeDeReclamation = :type,
                  DescriptionDeLaReclamation = :description, PiecesJointes = :pieces, Contact = :contact, Etat = :etat
                  WHERE IdReclamation = :id";
        $stmt = $this->conn->prepare($query);
        $data['id'] = $id;
        $stmt->execute($data);
    }

    public function deleteReclamation($id) {
        $query = "DELETE FROM reclamations WHERE IdReclamation = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
?>
