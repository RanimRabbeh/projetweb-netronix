<?php

require_once '../../config.php';
require_once '../../Controller/AvisC.php';
class Avis
{
    private ?int $Idavis = null;
    private ?string $Subject = null;
    private ?string $Nom = null;
    private ?string $Prenom = null;
    private ?string $Email = null;
    private ?string $Description;
    private $Datepost = null;


    public function __construct($id = null, $s, $n, $p, $email, $d)
    {
        $this->Idavis = $id;
        $this->Subject = $s;
        $this->Nom = $n;
        $this->Prenom = $p;
        $this->Email = $email;
        $this->Description = $d;
        $this->Datepost = $Datepost ?? date('Y-m-d H:i:s');
    }

    public function getIdavis()
    {
        return $this->Idavis;
    }
    public function getSubject()
    {
        return $this->Subject;
    }
    public function setSubject($Subject)
    {
        $this->Subject = $Subject;
        return $this;
    }
    public function getNom()
    {
        return $this->Nom;
    }
    public function setNom($Nom)
    {
        $this->Nom = $Nom;
        return $this;
    }
    public function getPrenom()
    {
        return $this->Prenom;
    }
    public function setPrenom($Prenom)
    {
        $this->Prenom = $Prenom;
        return $this;
    }
    public function getEmail()
    {
        return $this->Email;
    }
    public function setEmail($Email)
    {
        $this->Email = $Email;
        return $this;
    }
    public function getDescription()
    {
        return $this->Description;
    }
    public function setDescription($Description)
    {
        $this->Description = $Description;
        return $this;
    }
    public function getDatepost() {
        return $this->Datepost;
    }
}