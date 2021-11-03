<?php
class Gerant{
    private $id;
    private $nom;
    private $mail;
    private $mdp;

    public function __construct($id, $nom, $mail, $mdp){
        $this->id=$id;
        $this->nom=$nom;
        $this->mail=$mail;
        $this->mdp=$mdp;
    }
    
    public function getId()
    {
        return $this->id;
    }
    public function getNom()
    {
        return $this->nom;
    }
    public function getMail()
    {
        return $this->mail;
    }
    public function getMdp()
    {
        return $this->mdp;
    }
}