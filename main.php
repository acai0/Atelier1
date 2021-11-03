<?php
require_once 'Data';
//use model\Commande as commande;
include "model/Commande.php";
//Récupérer toute les commandes
echo "/****************************Recupere toute les commandes ********************************/<br>";
$c = new Commande();
$requete = $c::select(); 

$lignesC = $requete->get();   

foreach ($lignesC as $c)     
    echo "Identifiant = $c->id, Nom = $c->nom_client <br>" ;