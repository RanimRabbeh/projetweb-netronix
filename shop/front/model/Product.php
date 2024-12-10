<?php
class Product {
    private $id;
    private $nom;
    private $prix;
    private $quantite;
    private $photo;

    public function __construct($data) {
        $this->id = $data['id']; 
        $this->nom = $data['nom'];
        $this->prix = $data['prix'];
        $this->quantite = $data['quantite'];
        $this->photo = $data['photo'];
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
}
?>
