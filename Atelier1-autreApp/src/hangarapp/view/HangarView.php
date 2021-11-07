<?php

namespace hangarapp\view;

use mf\router\Router as Router;
use hangarapp\model\Categorie as Categorie;
use hangarapp\model\Commande as Commande;
use hangarapp\model\Gerant as Gerant;
use hangarapp\model\Panier as Panier;
use hangarapp\model\Producteur as Producteur;
use hangarapp\model\Produit as Produit;

//Vue
use hangarapp\view\HangarView as HangarView;
use mf\view\AbstractView as AbstractView ;

//Authentification
use hangarapp\auth\HangarAuthentification as HangarAuthentification;

use mf\utils\HttpRequest as HttpRequest;

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
        return "</div><div style='border: 1px solid yellow;text-align:center'>La super app créée en Licence Pro &copy;2021</div>";
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
    
            $nav = "<div class=\"nav_bar\">
        <div id=\"btn_panier\">
            <a href=".$link_home.">🛒</a>
        </div>
        <div id=\"btn_connexion\">
            <a href=".$link_form.">👤</a>
        </div></div>";
            return $nav;
        
    }

    /* Méthode renderHome
     *
     * 
     *  
     */
    
    private function renderHome()
    {    $route = new Router();
        $commandes= $this->data;
        foreach ($commandes as $commande)
        $link_commande =$route->urlFor('uneCommande',[['Id',"$commande->Id"]]);     
        $html =  "<div style='font-weight: bolder'>Commandes: </div>";
             $html .= "
             <div class='client-nom'> Nom du client:<a href=" . $link_commande ."> $commande->Nom_client </a></div>
             <div class='montant'>Montant:  $commande->Montant \n</div>
             </div>
     ";

 
          return $html;

        $displayCommandes .= "</div>";


        return $displayCommandes;



    }
  
    private function renderUneCommande(){
        $route = new Router();
        var_dump($this->data);
        $commande = $this->data;
        $html =  "<div style='font-weight: bolder'>Informations du client: </div>";
             $html .= "
             <div class='commande-nom'> Nom du client: $commande->Nom_client </div>
             <div class='commande-localisation'>Mail:  $commande->Mail_client \n</div>
             <div class='commande-tel'>Telephone: $commande->Tel_client </div>
             <div class='commande-tel'>Montant: $commande->Montant \n</div>
             <div class='commande-produit'>Produits Commandés: $commande->produit</div>
             </div>
     ";

 
          return $html;
 
     }

    /* Méthode renderViewTweet 
     * 
     * Réalise la vue de la fonctionnalité affichage d'un tweet
     *
     */
    /*
    private function renderCommande(){
        $route = new Router();
        $commandes= $this->data;
        foreach ($commandes as $commande)
        $html =  "<div style='font-weight: bolder'>Commandes: </div>";
             $html .= "
             <div class='producteur-nom'> $commande->Nom </a></div>
             <div class='producteur-localisation'>Localisation:  $commande->Montant \n</div>
             </div>
     ";

 
          return $html;
 
    }
    */

    public function renderLogin() {

        $route = new Router();

        $check_login_route = $route->urlFor('check_login');

        $login_form = <<<EOT
            <article class='theme1'><h3>Veuillez vous connecter pour accéder au gestionnaire des commandes</h3><br><br>
                <form id="login" method="post" class="form" action="$check_login_route">    
                    <label> Mail : </label> <br>   
                    <input type="text" name="Mail" id="Mail" class="forms-text" placeholder="Mail">        
                    <br><label> Mot de passe : </label>    <br>
                    <input type="password" name="Mdp" id="Mdp" class="forms-text" placeholder="Mot de passe">    
        
                    <br><input type="submit" name="log" id="log" class="forms-button" value="Valider" >       
                </form>
            </article>
        EOT;

        return $login_form;

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

                    case 'renderUneCommande':
                        $center = $this->renderUneCommande();
                        $navBar = $this->renderNav();
                        break;
                    
                
            case 'viewLogin':
                $center = $this->renderLogin();
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