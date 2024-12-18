<?php 

class Satisfaction
{
    private ?int $id = null;
    private ?int $satisfaction_solution = null;

    // Constructeur
    public function __construct($id = null, $satisfaction_solution = null)
    {
        $this->id = $id;
        $this->satisfaction_solution = $satisfaction_solution;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getSatisfactionSolution()
    {
        return $this->satisfaction_solution;
    }

    public function setSatisfactionSolution($satisfaction_solution)
    {
        $this->satisfaction_solution = $satisfaction_solution;
        return $this;
    }
}
?>
