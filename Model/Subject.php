<?php

require_once '../../config.php';
require_once '../../Controller/AvisC.php';
require_once '../../Controller/SubjectC.php';
class Subject
{
    private ?int $id = null;
    private ?string $name = null;


    public function __construct($id = null, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
    public function getid()
    {
        return $this->id;
    }
    public function getname()
    {
        return $this->name;
    }
    public function setname($name)
    {
        $this->name = $name;
        return $this;
    }

}