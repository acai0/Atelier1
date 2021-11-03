<?php
class Commande{
    private $id;
    private $montant;
    private $etat;
    private $nomClient;
    private $prenomClient;
    private $mail;
    private $telephone;
    
    public function __construct($id, $montant, $etat, $nomClient, $prenomClient, $mail, $telephone){
        $this->id=$id;
        $this->montant=$montant;
        $this->etat=$etat;
        $this->nomClient=$nomClient;
        $this->prenomClient=$prenomClient;
        $this->mail=$mail;
        $this->telephone=$telephone;
    }

    public function getId(){
        return $this->id;
    }

    public function getMontant(){
        return $this->montant;
    }

    public function getEtat(){
        return $this->etat;
    }
    public function getNomClient()
    {
        return $this->nomClient;
    }
    public function getPrenomClient()
    {
        return $this->prenomClient;
    }
    public function getMail()
    {
        return $this->mail;
    }
    public function getTelephone()
    {
        return $this->telephone;
    }
}