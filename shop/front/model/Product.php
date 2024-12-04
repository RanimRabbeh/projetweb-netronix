
<?php
class Product {
    private $nom;
    private $prix;
    private $quantite;
    private $photo; // Add this property to store BLOB data

    public function __construct($nom, $prix, $quantite, $photo) {
        $this->nom = $nom;
        $this->prix = $prix;
        $this->quantite = $quantite;
        $this->photo = $photo; // Set this property
    }

    // Add getters for the properties
    public function getNom() {
        return $this->nom;
    }

    public function getPrix() {
        return $this->prix;
    }

    public function getQuantite() {
        return $this->quantite;
    }

    public function getPhoto() { // Add this getter
        return $this->photo;
    }
}




?>
