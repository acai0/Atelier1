<?php

namespace hangarapp\control;

use mf\utils\HttpRequest as HttpRequest;
use mf\router\Router as Router;
use hangarapp\model\Categorie as Categorie;
use hangarapp\model\Commande as Commande;
use hangarapp\model\Gerant as Gerant;
use hangarapp\model\Panier as Panier;
use hangarapp\model\Producteur as Producteur;
use hangarapp\model\Produit as Produit;
use hangarapp\view\HangarView as HangarView;

class HangarController extends \mf\control\AbstractController {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function viewHome(){

        $produit = Produit::all();
        $vueProduit = new HangarView($produit);
        // echo $vueTweets->renderHome();
        echo $vueProduit->render('renderHome');

    }

}