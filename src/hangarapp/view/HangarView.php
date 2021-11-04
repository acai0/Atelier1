<?php

namespace tweeterapp\view;

use mf\router\Router as Router;
use tweeterapp\model\Tweet as Tweet;
use tweeterapp\model\User as User;
use tweeterapp\view\TweeterView as TweeterView;

class TweeterView extends \mf\view\AbstractView 
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
        return "<div class='theme-backcolor1'><h1>MiniTweeTR</h1>%%NAV%%</div><div class='theme-backcolor2'>";
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

        $link_form =$route->urlFor('form');

        $nav = "<div><table><tr><td><a href=".$link_home.">🏠</a></td><td><a href=\"\">🚪</a></td><td><a href=".$link_form.">✉️</a></td></tr></table></div>";
        return $nav;
    }

    /* Méthode renderHome
     *
     * Vue de la fonctionalité afficher tous les Tweets. 
     *  
     */
    
    private function renderHome()
    {

        /*
         * Retourne le fragment HTML qui affiche tous les Tweets. 
         *  
         * L'attribut $this->data contient un tableau d'objets tweet.
         * 
         */

        $route = new Router();
        
       $tweets = $this->data;

       $displayTweets = "";
         foreach ($tweets as $tweet)
         {
            $author = $tweet->author()->first();
            $link_tweet =$route->urlFor('tweet',[['id',"$tweet->id"]]);
            $link_user = $route->urlFOr('usertweets',[['id',"$author->id"]]);

             $displayTweets .= "<div class='tweet'><div class='tweet-text'><a href=" . $link_tweet . "> $tweet->text</a></div><div class='tweet-author'><a href= ".$link_user."> $author->username </a> \n</div><div class='tweet-footer'>Created at $tweet->created_at \n</div></div>";
         }

         return $displayTweets;


    }
  
    /* Méthode renderUeserTweets
     *
     * Vue de la fonctionalité afficher tout les Tweets d'un utilisateur donné. 
     * 
     */
     
    private function renderUserTweets()
    {

        /* 
         * Retourne le fragment HTML pour afficher
         * tous les Tweets d'un utilisateur donné. 
         *  
         * L'attribut $this->data contient un objet User.
         *
         */

        $route = new Router();
        $user = $this->data;
        $tweets = $user->tweets()->get();

        $htmlUser = "
        <div style='font-weight: bolder'>User</div>
        <div> Fullname : $user->fullname, Username : $user->username, Followers : $user->followers </div>
        ";
        
        $htmlTweets = "<div style='font-weight: xx-bold; text-align: right'> TWEETS </div>";
        
        foreach ($tweets as $tweet)
        {
            $link_tweet =$route->urlFor('tweet',[['id',"$tweet->id"]]);
            $htmlTweets .= "
                    <div class='tweet'><div><a href=" . $link_tweet ."> $tweet->text </a></div>
                    <div class='tweet-author'> $user->username \n</div>
                    <div class='tweet-footer'>Created at $tweet->created_at \n</div></div>
            ";
        }

        return $htmlUser . $htmlTweets;
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



    /* Méthode renderPostTweet
     *
     * Realise la vue de régider un Tweet
     *
     */
    protected function renderPostTweet()
    {
        $route = new Router();
        $send_route = $route->urlFor('send');
        
        return     "<div><form method=\"POST\" action=\"$send_route\"><textarea id=\"tweet-form\" name=\"text\" placeholder=\"Enter your fabulous tweet ...\" , maxlength=\"140\"></textarea><div><input id=\"send_button\" type=\"submit\" name=\"send\" value=\"send\"></div></form></div>";
        
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
            
            case 'viewTweet':
                $center = $this->renderViewTweet();
                $navBar = $this->renderNav();
                break;

            case 'userTweets':
                $center = $this->renderUserTweets();
                $navBar = $this->renderNav();
                break;

            case 'renderPostTweet':
                $center = $this->renderPostTweet();
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
