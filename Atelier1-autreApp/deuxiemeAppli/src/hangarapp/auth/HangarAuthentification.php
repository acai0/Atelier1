<?php

namespace hangarapp\auth;

use mf\auth\exception\AuthentificationException as AuthentificationException;
use hangarapp\model\Producteur as Producteur;

class HangarAuthentification extends \mf\auth\Authentification {

    /*
     * Classe TweeterAuthentification qui définie les méthodes qui dépendent
     * de l'application (liée à la manipulation du modèle User) 
     *
     */

    /* niveaux d'accès de HangarApp 
     *
     * Le niveau USER correspond a un utilisateur inscrit avec un compte
     * Le niveau ADMIN est un plus haut niveau (non utilisé ici)
     * 
     * Ne pas oublier le niveau NONE un utilisateur non inscrit est hérité 
     * depuis AbstractAuthentification 
     */
    const ACCESS_LEVEL_USER  = 100;   
    const ACCESS_LEVEL_ADMIN = 200;

    /* constructeur */
    public function __construct(){
        parent::__construct();
    }

    /* La méthode createUser 
     * 
     *  Permet la création d'un nouvel utilisateur de l'application
     * 
     *  
     * @param : $username : le nom d'utilisateur choisi 
     * @param : $pass : le mot de passe choisi 
     * @param : $fullname : le nom complet 
     * @param : $level : le niveaux d'accès (par défaut ACCESS_LEVEL_USER)
     * 
     * Algorithme :
     *
     *  Si un utilisateur avec le même nom d'utilisateur existe déjà en BD
     *     - soulever une exception 
     *  Sinon      
     *     - créer un nouvel modèle User avec les valeurs en paramètre 
     *       ATTENTION : Le mot de passe ne doit pas être enregistré en clair.
     * 
     */
    
    public function createUser($nom, $local, $mail, $mdp,
                               $level=self::ACCESS_LEVEL_USER) {

        
        if(Producteur::select()->where('Nom','=',"$nom")->exists()) {
            echo('DEBUG >>> user déjà existant \n');
            echo('DEBUG >>> user déjà existant \n');
            $emess = "User $nom already exists";
            throw new AuthentificationException($emess);
        } else {
            echo('DEBUG >>> user en création \n');

            $new_user = new Producteur();

            $new_user->Nom = $nom;
            $new_user->Localisation = $local;
            $new_user->Mail = $mail;
            $new_user->Mdp = $this->hashPassword($pass);
            $new_user->level= $level;

            $new_user->save();

        }

    }

    /* La méthode loginUser
     *  
     * permet de connecter un utilisateur qui a fourni son nom d'utilisateur 
     * et son mot de passe (depuis un formulaire de connexion)
     *
     * @param : $username : le nom d'utilisateur   
     * @param : $password : le mot de passe tapé sur le formulaire
     *
     * Algorithme :
     * 
     *  - Récupérer l'utilisateur avec l'identifiant $username depuis la BD
     *  - Si aucun de trouvé 
     *      - soulever une exception 
     *  - sinon 
     *      - réaliser l'authentification et la connexion (cf. la class Authentification)
     *
     */
    
    public function loginUser($mail, $password){

        if(!Producteur::select()->where('Mail','=',"$mail")->exists()) {
            echo('DEBUG >>> user does not exist ok \n');
            $emess = "Productor $mail doesn't exist";
            throw new AuthentificationException($emess);
        } else {
            $user = Producteur::select()->where('Mail','=',"$mail")->first();
        $this->login($user->Mail, $user->Mdp, $password ,$user->level);
        }

    }

}