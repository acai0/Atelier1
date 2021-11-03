<?php
namespace modeles;
class Gerant{
    private $BDD;
    
    public function __construct(){
        $this->BDD= new Data;
    }
    
        public function getById(){
    
        $resultat=array();
        try{
            $connexion=$this->BDD->connexionPDO($id);
            $req=$connexion->prepare("select * from Gerant where id:id");
            $req->bindValue(":id", $id, PDO::PARAM_STR);
            $req->execute();
    
            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e){
            print "Erreur ! : " . $e->getMessage();
            die();
                }
        return $resultat;
    }
    
    }