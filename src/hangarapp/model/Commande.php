<?php
namespace hangarapp\model;

class Commande extends \Illuminate\Database\Eloquent\Model{

    protected $table      = 'Commande';  /* le nom de la table */
    protected $primaryKey = 'Id';     /* le nom de la clé primaire */
    public    $timestamps = false;

    public function ajouterCommande($nom, $mail, $montant, $tel)
  {
    $c = new Commande();
    $c->Nom_client = $nom;
    $c->Mail_Client = $mail;
    $c->Montant = $montant;
    $c->Tel_client = $tel;
    $c->save();
  }

}