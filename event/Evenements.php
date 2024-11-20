<?php
require_once('../config.php');
require_once('../Controller/EvenementsC.php');

class evenements
{
    private ?int $Idevenement = null;
    private ?string $Nomevenement = null;
    private ?string $Lieuevenement = null;
    private ?string $Dateevenement = null;
    private ?int $Prixbillet = null;
    private ?int $Idadmin = null;

public function __construct ($id = null , $n , $l , $d ,  $p , $i ){
    $this->Idevenement=$id;
    $this->Nomevenement=$n;
    $this->Lieuevenement=$l;
    $this->Dateevenement=$d;
    $this->Prixbillet=$p;
    $this->Idadmin=$i;

}

public function getIdevenement(): ?int {
    return $this->Idevenement;
}

public function getNomevenement(): ?string {
    return $this->Nomevenement;
}
public function setNomevenement(): ?string {
    $this->Nomevenement = $Nomevenement;
    return $this ;
}
public function getLieuevenement(): ?string {
    return $this->Lieuevenement;
}
public function setLieuevenement(): ?string {
    $this->Lieuevenement = $Lieuevenement;
    return $this ;
}
public function getDateevenement(): ?string {
    return $this->Dateevenement;
}
public function setDateevenement(): ?string {
    $this->Dateevenement = $Dateevenement;
    return $this ;
}
public function getPrixbillet(): ?int {
    return $this->Prixbillet;
}
public function setPrixbillet(): ?int {
    $this->Prixbillet = $Prixbillet;
    return $this ;
}
public function getIdadmin(): ?int {
    return $this->Idadmin;
}



}
?>