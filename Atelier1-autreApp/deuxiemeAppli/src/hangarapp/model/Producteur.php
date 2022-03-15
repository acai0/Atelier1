<?php

namespace hangarapp\model;


class Producteur extends \Illuminate\Database\Eloquent\Model{
    
    protected $table = "Producteur";
    public $primaryKey = "id";
    public $timestamps = false;

    public function lesProduits(){
        return $this->belongsTo('hangarapp\model\Produit','Id');
    }    
    
    public function ajoutProducteur($nom,$localisation,$mail,$mdp){
        $p = new Producteur();
        $p->Nom = $nom;
        $p->Localisation = $localisation;
        $p->Mail = $mail;
        $p->Mdp = $mdp;
    }
    
}    
    
    
    