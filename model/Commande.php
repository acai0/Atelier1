<?php
namespace model;
use model\Data;
use PDO;

class Commande{
    private $BDD;
    
    public function __construct(){
        $this->BDD= new Data;
    }
    
        public function getNomClient($nom_client){
    
        $resultat=array();
        try{
            $connexion=$this->BDD->connexionPDO();
            $req=$connexion->prepare("select * from commande where Nom_client=:nom_client");
            $req->bindValue(":nom_client", $nom_client, PDO::PARAM_STR);
            $req->execute();
    
            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e){
            print "Erreur ! : " . $e->getMessage();
            die();
                }
        return $resultat;
    }
    
    public function ModifierEtat($etat, $id){
    $connexion = $this->BDD->connexionPDO();
    $requete = "UPDATE Commande SET etat = $etat WHERE id=$id";
    $req = $connexion->prepare($requete);
    $req->execute();
  }
  public function ModifierInfoClient($id, $nom_client, $mail_client, $tel_client){
    $connexion = $this->BDD->connexionPDO();
    $requete = "UPDATE Commande SET Nom_client = $nom_client, Mail_client=$mail_client, Tel_client=$tel_client WHERE id=$id";
    $req = $connexion->prepare($requete);
    $req->execute();
  }
    }