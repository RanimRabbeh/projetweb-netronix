<?php
class Product {
    private $idProduit;
    private $nom;
    private $prix;
    private $quantite;
    private $photo;

    public function __construct($nom, $prix, $quantite, $photo = null) {
        $this->nom = $nom;
        $this->prix = $prix;
        $this->quantite = $quantite;
        $this->photo = $photo;
    }

    public function getIdProduit() {
        return $this->idProduit;
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
