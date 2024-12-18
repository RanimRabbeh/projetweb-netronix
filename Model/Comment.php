<?php

require_once '../../config.php';
require_once '../../Controller/AvisC.php';
require_once '../../Controller/SubjectC.php';
require_once '../../Controller/CommentC.php';
class Comment
{
    private ?int $id = null;
    private ?string $avis_id = null;
    private ?string $nom = null;
    private ?string $prenom = null;
    private ?string $comment = null;
    private $date_post	 = null;




    public function __construct($id = null, $avis_id = null, $nom = null, $prenom = null, $comment = null)
    {
        $this->id = $id;
        $this->avis_id = $avis_id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->comment = $comment;
        $this->date_post = $date_post ?? date('Y-m-d H:i:s');

    }
    public function getid()
    {
        return $this->id;
    }
    public function getnom()
    {
        return $this->nom;
    }
    public function setnom($nom)
    {
        $this->nom = $nom;
        return $this;
    }
    public function getprenom()
    {
        return $this->prenom;
    }
    public function setprenom($prenom)
    {
        $this->prenom = $prenom;
        return $this;
    }
    public function getcomment()
    {
        return $this->comment;
    }
    public function setcomment($comment)
    {
        $this->comment = $comment;
        return $this;
    }
    public function getdate_post() {
        return $this->date_post;
    }


}