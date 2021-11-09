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
use hangarapp\view\HangarGestView as HangarGestView;
use hangarapp\auth\HangarAuthentification as HangarAuthentification;

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

class HangarGestController extends \mf\control\AbstractController {


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
        $commande = Commande::select('*')->get();
        $vueCommande = new HangarGestView($commande);
        // echo $vueTweets->renderHome();
        echo $vueCommande->render('renderHome');
    }


    public function viewProductor($id=null){

        /*$requete = tweet::where('id','=',$id)->first();
        $result = $requete->author()->get();*/

        $route = new Router();
        //$http_req = new HttpRequest();
        //$idTweet = $http_req->get['id'];
        //$tweet = Tweet::find($idTweet);
        /*
        $author = $tweet->author()->first();
        $link_user = $route->urlFOr('usertweets',[['id',"$author->id"]]);
        $htmlTweet =
        "<div style='border: 1px solid black; text-align: center'> $tweet->text</div>
        <div style='font-weight: bolder'>AUTHOR : <a href=" . $link_user . "> $author->username </a>\n</div>
        <div style='font-size: smaller'>Created at $tweet->created_at \n</div>
        <div style='font-size: smaller'>Score $tweet->score \n</div>";
fol
        return $htmlTweet;*/

        $id_productor = $id ?? $this->request->get['Id'];
        $productor = Producteur::find($id_productor);
        $vueProductors = new HangarGestView($productor);
        $vueProductors->render('viewProductor');
         

    }
/*
    public function viewLogin(){
        $view_login = new HangarGestView("");
        $view_login->render("renderLogin");
    }*/
    public function viewCommande(){

        $commande = Commande::select('Nom_client,Montant');
        $vueCommande = new HangarGestView($commande);
        echo $vueCommande->render('renderCommande');

    }

    public function viewUneCommande(){
        $route = new Router();
        $http_req = new HttpRequest();
        $idCommande = $id ?? $this->request->get['Id'];
        $commande = Commande::find($idCommande);
        /*
        $panier= Panier::with(['commande'=> function($query){
            $query->select('*');
        }])->with(['produit'=>function ($query){
            $query->select('*');
        }]);
        */
        $panier= $commande::join('Panier','Commande.Id', '=', 'Panier.Id_Commande')
        ->join('Produit', 'Produit.Id', '=', 'Panier.Id_Produit')
        ->select('*')
        ->get();
        $vueCommande = new HangarGestView( $commande, $panier);
        echo $vueCommande->render('renderUneCommande');

    }
    public function viewTdb(){
        $router=new Router();
        $http_req = new HttpRequest();
        $commande= Commande::select('*');
        $vueCommande = new HangarGestView( $commande);
        echo $vueCommande->render('renderTdb');

    }
    public function ajoutPanier($produit,$qte){

        $idcommande = Commande::select('Id')->orderBy('Id','desc');
        $idcommande = $idcommande->first();
        $p = new Panier();
        $p->id_produit = $produit;
        $p->id_Commande = $idcommande->Id;
        $p->Quantite = $qte;
        $p->save();

        
      }
    
      public function supprimePanier($produit,$commande)
      {
       $requete = Panier::where('id_Commande','=', $commande)->where('id_Produit','=', $produit)->delete();
      }
}