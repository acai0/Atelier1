<?php
namespace modeles;
class Commande{
    private $id;
    private $montant;
    private $etat;
    private $nom_client;
    private $prenom_client;
    private $mail_client;
    private $tel_client;
    
    public function __construct($id, $montant, $etat, $nom_client, $prenom_client, $mail_client, $tel_client){
        $this->id=$id;
        $this->montant=$montant;
        $this->etat=$etat;
        $this->nom_client=$nom_client;
        $this->prenom_client=$prenom_client;
        $this->mail_client=$mail_client;
        $this->tel_client=$tel_client;
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
        return $this->nom_client;
    }
    public function getPrenomClient()
    {
        return $this->prenom_client;
    }
    public function getMailClient()
    {
        return $this->mail_client;
    }
    public function getTelClient()
    {
        return $this->tel_client;
    }
}