<?php
class Producteur{
    private $id;
    private $nom;
    private $localisation;
    private $mail;
    private $mdp;

    public function __construct($id, $nom, $localisation, $mail, $mdp){
        $this->id=$id;
        $this->nom=$nom;
        $this->localisation=$localisation;
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
    public function getLocalisation()
    {
        return $this->localisation;
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