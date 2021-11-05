<?php

namespace hangarapp\view;

use mf\router\Router as Router;
use hangarapp\model\Categorie as Categorie;
use hangarapp\model\Gerant as Gerant;
use hangarapp\model\Panier as Panier;
use hangarapp\model\commande as commande;
use hangarapp\model\Produit as Produit;
use hangarapp\view\HangarView as HangarView;
use mf\view\AbstractView as AbstractView ;

class HangarView extends AbstractView 
{
  
    /* Constructeur 
    *
    * Appelle le constructeur de la classe parent
    */
    public function __construct( $data )
    {
        parent::__construct($data);
    }

    /* Méthode renderHeader
     *
     *  Retourne le fragment HTML de l'entête (unique pour toutes les vues)
     */ 
    private function renderHeader()
    {
        return "<div class='theme-backcolor1'><h1>Le Hangar</h1>%%NAV%%</div><div class='theme-backcolor2'>";
    }
    
    /* Méthode renderFooter
     *
     * Retourne le fragment HTML du bas de la page (unique pour toutes les vues)
     */
    private function renderFooter()
    {
        return "</div><div class='theme-backcolor1 tweet-footer'>La super app créée en Licence Pro &copy;2021</div>";
    }

     /* Méthode renderNav
     *
     * Retourne le fragment HTML du menu de naviguation 
     */
    private function renderNav()
    {
        $route = new Router();
        $link_home =$route->urlFor('home');
        $link_login =$route->urlFor('home');
        $link_register =$route->urlFor('home');

        $link_form =$route->urlFor('home');

        $nav = "<div><a href=".$link_home.">🛒</a></div>
        <div><a href=".$link_form.">👤</a></div>";
        return $nav;
    }

    /* Méthode renderHome
     *
     * 
     *  
     */
    
    private function renderHome()
    {

       $html = "coucou";

         return $html;


    }
  

  
    /* Méthode renderViewTweet 
     * 
     * Réalise la vue de la fonctionnalité affichage d'un tweet
     *
     */
    
    private function renderViewTweet()
    {

        /* 
         * Retourne le fragment HTML qui réalise l'affichage d'un tweet 
         * en particulié 
         * 
         * L'attribut $this->data contient un objet Tweet
         *
         */

        $route = new Router();

        $tweet = $this->data;
        $author = $tweet->author()->first();

        $link_user = $route->urlFor('usertweets',[['id',"$author->id"]]);

        $htmlTweet =
            "<div class='tweet'><div> $tweet->text</div>
             <div class='tweet-author'> <a href=" . $link_user . "> $author->username </a>\n</div>
             <div class='tweet-footer'>Created at $tweet->created_at \n</div>
             <div class='tweet-score'>👍 $tweet->score \n</div></div>";

       return $htmlTweet;
        
    }
    public function renderCommande(){
        $route = new Router();
        $commandes = $this->data;
        $html =  "<div style='font-weight: bolder'>Commandes</div>";
          foreach ($commandes as $commande)
          {
             //$link_commande =$route->urlFor('commande',[['id',"$commande->Id"]]);
             $html .=/*"
             <div class='commande-id'><div><a href=" . $link_commande ."> $commande->Id </a></div>"*/
             "
             <div class='commande-nomclient'>Nom du client :  $commande->Nom_client \n</div>
             <div class='commande-mailclient'>Mail du client : $commande->Mail_client \n</div>
             <div class='commande-telclient'>Telephone : $commande->Tel_client \n</div>
             <div class='commande-montant'>Montant :$commande->Montant \n</div>
             <div class='commande-etat'>Etat : $commande->Etat \n</div>
             </div>
     ";
          }
 
          return $html;
 
     }

     public function renderProducteur(){
        $route = new Router();
        $produit = $this->data;
        $producteurs = $produit->producteur()->get();
       //$producteurs= $this->data;
 
        $html =  "<div style='font-weight: bolder'>Producteur/div>";
          foreach ($producteurs as $producteur)
          {
            // $link_producteur =$route->urlFor('producteur',[['id',"$producteur->Id_Prooducteur"]]);
             $html .= "
             <div class='producteur-nom'><div><a href=" . $link_producteur ."> $producteur->Nom </a></div>
             <div class='producteur-localisation'> $producteur->Localisation \n</div>
             <div class='produit-nom'>$produit->Nom \n</div>
             <div class='produit-tarif'>$produit->Tarif \n</div>
             <div class='producteur-desc'>$producteur->Description \n</div>
             </div>
     ";
          }
 
          return $html;
 
     }


    /* Méthode renderBody
     *
     * Retourne la framgment HTML de la balise <body> elle est appelée
     * par la méthode héritée render.
     *
     */
    
    public function renderBody($selector)
    {

        /*
         * voire la classe AbstractView
         */

        $header = $this->renderHeader();
        $center = "";
        $navBar = "";
        $footer = $this->renderFooter();
        
        // variable $$ au lieu du case ??    
        switch ($selector) {
            case 'renderHome':
                $center = $this->renderHome();
                $navBar = $this->renderNav();
                break;

                case 'renderCommande':
                    $center = $this->renderCommande();
                    $navBar = $this->renderNav();
                    break;

                    case 'renderProducteur':
                        $center = $this->renderProducteur();
                        $navBar = $this->renderNav();
                        break;

            default:
                $center = "Pas de fonction view correspondante";
                break;
        }


$body = <<<EOT
${header}
${center}
${footer}
EOT;

        return str_replace("%%NAV%%", $navBar, $body);
        
    }

}