<?php 

require_once('../../config.php');
require_once('../../Controller/EvenementsC.php');

class Evenements
{
    private ?int $Idevenement = null;
    private ?string $Nomevenement = null;
    private ?string $Lieuevenement = null;
    private ?string $Dateevenement = null;
    private ?string $Prixevenement = null;
    private ?string $Placedisponible = null;
    private ?string $eventimage = null;


    public function __construct($id = null, $n, $l, $d, $p, $pl,$eventimage)
    {
        $this->Idevenement = $id;
        $this->Nomevenement = $n;
        $this->Lieuevenement = $l;
        $this->Dateevenement = $d;
        $this->Prixevenement = $p;
        $this->Placedisponible = $pl;
        $this->eventimage = $eventimage;
    }

    public function getIdevenement()
    {
        return $this->Idevenement;
    }
    public function getNomevenement()
    {
        return $this->Nomevenement;
    }
    public function setNomevenement($Nomevenement)
    {
        $this->Nomevenement = $Nomevenement;
        return $this;
    }
    public function getLieuevenement()
    {
        return $this->Lieuevenement;
    }
    public function setLieuevenement($Lieuevenement)
    {
        $this->Lieuevenement = $Lieuevenement;
        return $this;
    }
    public function getDateevenement()
    {
        return $this->Dateevenement;
    }
    public function setDateevenement($Dateevenement)
    {
        $this->Dateevenement = $Dateevenement;
        return $this;
    }
    public function getPrixevenement()
    {
        return $this->Prixevenement;
    }
    public function setPrixevenement($Prixevenement)
    {
        $this->Prixevenement = $Prixevenement;
        return $this;
    }
    public function getPlacedisponible()
    {
        return $this->Placedisponible;
    }
    public function setPlacedisponible($Placedisponible)
    {
        $this->Placedisponible = $Placedisponible;
        return $this;
    }
    public function geteventimage()
    {
        return $this->eventimage;
    }
    public function seteventimage($eventimage)
    {
        $this->eventimage = $eventimage;
        return $this;
    }
}
