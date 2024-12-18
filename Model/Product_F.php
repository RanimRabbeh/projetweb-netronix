<?php
class Product {
    private $id;
    private $nom;
    private $prix;
    private $quantite;
    private $photo;
    private $idUtilisateur;

    // Rendre $id optionnel avec une valeur par défaut null
    public function __construct($nom, $prix, $quantite, $photo, $idUtilisateur, $id = null) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prix = $prix;
        $this->quantite = $quantite;
        $this->photo = $photo;
        $this->idUtilisateur = $idUtilisateur;
    }

    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrix() {
        return $this->prix;
    }

    public function getQuantite() {
        return $this->quantite;
    }

    public function getPhoto() {
        return $this->photo;
    }

    public function getIdUtilisateur() {
        return $this->idUtilisateur;
    }
}
class User {
    private $db;

    public function __construct() {
        $this->db = Config::getConnexion(); // Assurez-vous que la connexion à la base de données fonctionne
    }

    // Récupérer un utilisateur par son ID
    public function getUserById($id) {
        $sql = "SELECT Nom, Email FROM utilisateurs WHERE IdUtilisateur = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC); // Récupère les informations sous forme de tableau associatif

        return $user;
    }
}
?>
