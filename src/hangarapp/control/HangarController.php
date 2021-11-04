<?php

namespace tweeterapp\control;

use mf\utils\HttpRequest as HttpRequest;
use mf\router\Router as Router;
use tweeterapp\model\Commande as Commande;
use tweeterapp\model\User as User;
use tweeterapp\view\TweeterView as TweeterView;

/* Classe TweeterController :
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

class TweeterController extends \mf\control\AbstractController {


    /* Constructeur :
     * 
     * Appelle le constructeur parent
     *
     * c.f. la classe \mf\control\AbstractController
     * 
     */
    
    public function __construct(){
        parent::__construct();
    }


    /* Méthode viewHome : 
     * 
     * Réalise la fonctionnalité : afficher la liste de Tweet
     * 
     */
    
    public function viewHome(){

        /* Algorithme :
         *  
         *  1 Récupérer tout les tweet en utilisant le modèle Tweet
         *  2 Parcourir le résultat 
         *      afficher le text du tweet, l'auteur et la date de création
         *  3 Retourner un block HTML qui met en forme la liste
         * 
         */

        // //  $route = new Router();

        $tweets = Tweet::all();
        $vueTweets = new TweeterView($tweets);
        // echo $vueTweets->renderHome();
        echo $vueTweets->render('renderHome');

    }


    /* Méthode viewTweet : 
     *  
     * Réalise la fonctionnalité afficher un Tweet
     *
     */
    
    public function viewTweet(){

        /* Algorithme : 
         *  
         *  1 L'identifiant du Tweet en question est passé en paramètre (id) 
         *      d'une requête GET 
         *  2 Récupérer le Tweet depuis le modèle Tweet
         *  3 Afficher toutes les informations du tweet 
         *      (text, auteur, date, score)
         *  4 Retourner un block HTML qui met en forme le Tweet
         * 
         *  Erreurs possibles : (*** à implanter ultérieurement ***)
         *    - pas de paramètre dans la requête
         *    - le paramètre passé ne correspond pas a un identifiant existant
         *    - le paramètre passé n'est pas un entier 
         * 
         */
         $route = new Router();

         $http_req = new HttpRequest();
         $idTweet = $http_req->get['id'];

         $tweet = Tweet::find($idTweet);

         $vueTweet = new TweeterView($tweet); // changer le nom de cette var. WHY ??
        //  echo $vueTweet->renderViewTweet();
         echo $vueTweet->render('viewTweet');


    }


    /* Méthode viewUserTweets :
     *
     * Réalise la fonctionnalité afficher les tweet d'un utilisateur
     *
     */
    
    public function viewUserTweets(){

        /*
         *
         *  1 L'identifiant de l'utilisateur en question est passé en 
         *      paramètre (id) d'une requête GET 
         *  2 Récupérer l'utilisateur et ses Tweets depuis le modèle 
         *      Tweet et User
         *  3 Afficher les informations de l'utilisateur 
         *      (non, login, nombre de suiveurs) 
         *  4 Afficher ses Tweets (text, auteur, date)
         *  5 Retourner un block HTML qui met en forme la liste
         *
         *  Erreurs possibles : (*** à implanter ultérieurement ***)
         *    - pas de paramètre dans la requête
         *    - le paramètre passé ne correspond pas a un identifiant existant
         *    - le paramètre passé n'est pas un entier 
         * 
         */

        $route = new Router();

        $http_req = new HttpRequest();
        $idUser = $http_req->get['id'];

        $user = User::find($idUser);
        $tweets = $user->tweets()->get();

        $vueUserTweets = new TweeterView($user);
        // echo $vueUserTweets->renderUserTweets();
        echo $vueUserTweets->render('userTweets');

        


    }

    public function viewPostTweet(){

        /*
         *
         *  1 L'identifiant de l'utilisateur en question est passé en 
         *      paramètre (id) d'une requête GET 
         *  2 Récupérer l'utilisateur et ses Tweets depuis le modèle 
         *      Tweet et User
         *  3 Afficher les informations de l'utilisateur 
         *      (non, login, nombre de suiveurs) 
         *  4 Afficher ses Tweets (text, auteur, date)
         *  5 Retourner un block HTML qui met en forme la liste
         *
         *  Erreurs possibles : (*** à implanter ultérieurement ***)
         *    - pas de paramètre dans la requête
         *    - le paramètre passé ne correspond pas a un identifiant existant
         *    - le paramètre passé n'est pas un entier 
         * 
         */

        $route = new Router();
        $http_req = new HttpRequest();
        $tweets = Tweet::all();
        $vueUserTweets = new TweeterView($tweets);
        // echo $vueUserTweets->renderUserTweets();
        echo $vueUserTweets->render('renderPostTweet');

    }

    public function sendPostTweet()
    {
        // $http_req = new HttpRequest(); //Injectin de dépendance ?? Eviter l'instanciation de $route à chaque fois
        $text_form = $this->request->post['text'];
        
        // Requete préparée, filtrer les données... que fait eloquent que ne fait-il pas ?
        $new_tweet = new Tweet();
        // requête préparée ok mais pas "sécurisé"
        $new_tweet->text = filter_var($text_form,FILTER_SANITIZE_SPECIAL_CHARS); // résiste au drop_database ?
        $new_tweet->author = '9';
        $new_tweet->save();

        $_GET["id"] = $new_tweet->id;

        $this->viewTweet($new_tweet->id); // changer avec execute route ?
        
        
    }

}
