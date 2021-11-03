<?php
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
    public function getNom_Client()
    {
        return $this->nom_client;
    }
    public function getPrenom_Client()
    {
        return $this->prenom_client;
    }
    public function getMail_Client()
    {
        return $this->mail_client;
    }
    public function getTel_Client()
    {
        return $this->tel_client;
    }
}