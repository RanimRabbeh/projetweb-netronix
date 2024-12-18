<?php

require_once('../../config.php');
require_once('../../Controller/SolutionReclamationController.php');

class SolutionReclamationModel
{
    private ?int $IdSuivie = null;
    private ?int $IdAdmin = null;
    private ?int $IdReclamation = null;
    private ?string $solution = null;

    public function __construct($idAdmin, $idReclamation, $solution)
    {
        $this->IdAdmin = $idAdmin;
        $this->IdReclamation = $idReclamation;
        $this->solution = $solution;
    }

    public function getIdSuivie()
    {
        return $this->IdSuivie;
    }

    public function setIdSuivie($idSuivie)
    {
        $this->IdSuivie = $idSuivie;
        return $this;
    }

    public function getIdAdmin()
    {
        return $this->IdAdmin;
    }

    public function setIdAdmin($idAdmin)
    {
        $this->IdAdmin = $idAdmin;
        return $this;
    }

    public function getIdReclamation()
    {
        return $this->IdReclamation;
    }

    public function setIdReclamation($idReclamation)
    {
        $this->IdReclamation = $idReclamation;
        return $this;
    }

    public function getSolution()
    {
        return $this->solution;
    }

    public function setSolution($solution)
    {
        $this->solution = $solution;
        return $this;
    }
}

?>
