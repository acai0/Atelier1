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

/* Classe HangarController :
 *  
 * Réalise les algorithmes des fonctionnalités suivantes: 
 *
 *  - afficher la liste des Tweets 
 *  - afficher un Tweet
 *  - afficher les tweet d'un utilisateur 
 *  - afficher la le formulaire pour poster un Tweet
 *  - afficher la liste des utilisateurs suivis 
 *  - évaluer un Tweet
 *  - suivre un utilisateur
 *   
 */

class HangarController extends \mf\control\AbstractController {


    /* Constructeur :
     * 
     * Appelle le constructeur parent
     *
     * c.f. la classe \mf\control\AbstractController
     * 
     */
    
    public function __construct()
    {
        parent::__construct();
    }


    /* Méthode viewHome : 
     * 
     * Réalise la fonctionnalité : afficher la liste de Tweet
     * 
     */
    
    public function viewHome(){

        $info["produit"] = Produit::select('*')->orderBy('Id_Categorie')->orderBy('nom')->get();
        $info["categorie"] = Categorie::select('*')->orderBy('nom')->get();
        $info["producteur"]= Producteur::select('*')->orderBy('nom')->get();
        $vueProduit = new HangarView($info);
        echo $vueProduit->render('renderHome');

    }
    public function viewUnProducteur(){
        $route = new Router();
        $http_req = new HttpRequest();
        $idProducteur = $id ?? $this->request->get['Id'];
        $producteur = Producteur::find($idProducteur);
        $vueProducteur = new HangarView($producteur);
        echo $vueProducteur->render('renderUnProducteur');
    }

    public function viewTest(){
        $info = array();
        $a="";
        $b="";
        $tic = false;
        foreach ($_POST as $data)
        {
            $b = $a;
            $a = $data;
            if (($a != 0) && ($tic == true))
            {
                $info[] = array("id"=>$b,"qte"=>$a);
            }
            if ($tic == false)
            {
                $tic = true;
            }
            else
            {
                $tic = false;
            }
        }
        $vue = new HangarView($info);
        echo $vue->render('renderTest');

    }

}
