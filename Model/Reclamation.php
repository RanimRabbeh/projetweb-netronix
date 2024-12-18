<?php 

require_once('../../config.php');
require_once('../../Controller/ReclamationController.php');

class Reclamations
{
    private ?int $IdReclamation = null;
    private ?int $IdUtilisateur = null;
    private ?string $DateDeLaReclamation = null;
    private ?string $TypeDeReclamation = null;
    private ?string $DescriptionDeLaReclamation = null;
    private ?string $PiecesJointes = null;
    private ?string $Contact = null;
    private ?string $Etat = null;

    public function __construct($id = null, $idUser, $date, $type, $description, $pieces, $contact, $etat)
{
    $this->IdReclamation = $id;
    $this->IdUtilisateur = $idUser;
    $this->DateDeLaReclamation = $date;
    $this->TypeDeReclamation = $type;
    $this->DescriptionDeLaReclamation = $description;
    $this->PiecesJointes = is_array($pieces) ? implode(',', $pieces) : $pieces;
    $this->Contact = $contact;
    $this->Etat = $etat;
}


    public function getIdReclamation()
    {
        return $this->IdReclamation;
    }

    public function getIdUtilisateur()
    {
        return $this->IdUtilisateur;
    }
    public function setIdUtilisateur($IdUtilisateur)
    {
        $this->IdUtilisateur = $IdUtilisateur;
        return $this;
    }

    public function getDateDeLaReclamation()
    {
        return $this->DateDeLaReclamation;
    }
    public function setDateDeLaReclamation($DateDeLaReclamation)
    {
        $this->DateDeLaReclamation = $DateDeLaReclamation;
        return $this;
    }

    public function getTypeDeReclamation()
    {
        return $this->TypeDeReclamation;
    }
    public function setTypeDeReclamation($TypeDeReclamation)
    {
        $this->TypeDeReclamation = $TypeDeReclamation;
        return $this;
    }

    public function getDescriptionDeLaReclamation()
    {
        return $this->DescriptionDeLaReclamation;
    }
    public function setDescriptionDeLaReclamation($DescriptionDeLaReclamation)
    {
        $this->DescriptionDeLaReclamation = $DescriptionDeLaReclamation;
        return $this;
    }

    public function getPiecesJointes()
    {
        return $this->PiecesJointes;
    }
    public function setPiecesJointes($PiecesJointes)
    {
        $this->PiecesJointes = $PiecesJointes;
        return $this;
    }

    public function getContact()
    {
        return $this->Contact;
    }
    public function setContact($Contact)
    {
        $this->Contact = $Contact;
        return $this;
    }

    public function getEtat()
    {
        return $this->Etat;
    }
    public function setEtat($Etat)
    {
        $this->Etat = $Etat;
        return $this;
    }
}
