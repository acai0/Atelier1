<?php 
namespace modeles;
class Categorie{
    private $BDD;

    public function __construct (){
        $this->BDD = new Data;
    }
    public function getById($id){
        $resultat=array();
        try{
            $connexion=$this->BDD->connexionPDO();
            $req=$connexion->prepare("select * from categorie where id:id");
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