<?php

namespace hangarapp\model;

class Panier extends \Illuminate\Database\Eloquent\Model
{

       protected $table      = 'Panier';  /* le nom de la table */
       protected $primaryKey = ['Id_Produit','Id_Commande'];     /* le nom de la clé primaire */
       public    $timestamps = false;    /* si vrai la table doit contenir
                                            les deux colonnes updated_at,
                                            created_at */   

       public function commande(){
                     return $this->belongsTo('model\Commande', 'Id_commande');
       }
       public function produit(){
              return $this->belongsTo('model\Produit', 'Id_produit');
       }
}