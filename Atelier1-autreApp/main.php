<?php

declare(strict_types=1);
header( 'content-type: text/html; charset=utf-8' );

//Affichage des erreurs
ini_set("display_errors","1");
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

//Autoloader
require_once 'src/mf/utils/AbstractClassLoader.php';
require_once 'src/mf/utils/ClassLoader.php';

//pour le chargement automatique des classes d'Eloquent(rep. vendor)
require_once 'vendor/autoload.php';

$loader = new mf\utils\ClassLoader('src');
$loader->register();

//Router
use mf\router\Router as Router;

//Modèles 
use hangarapp\model\Categorie as Categorie;
use hangarapp\model\Commande as Commande;
use hangarapp\model\Gerant as Gerant;
use hangarapp\model\Panier as Panier;
use hangarapp\model\Producteur as Producteur;
use hangarapp\model\Produit as Produit;

//Controllers
use hangarapp\control\HangarController as HangarGestController;
use hangarapp\control\HangarAuthController as HangarAuthController;

//Authentification
use hangarapp\auth\HangarAuthentification as HangarAuthentification;

// Paramètre de connexion issus de conf.ini
$paramsServer = parse_ini_file("conf/conf.ini");

/* une instance de connexion  */
$db = new Illuminate\Database\Capsule\Manager();

$db->addConnection( $paramsServer ); /* configuration avec nos paramètres */
$db->setAsGlobal();            /* rendre la connexion visible dans tout le projet */
$db->bootEloquent();           /* établir la connexion */

$router = new Router();

$router->addRoute('home',
                  '/home/',
                  '\hangarapp\control\HangarController',
                  'viewHome');

                  $router->addRoute('test',
                  '/test/',
                  '\hangarapp\control\HangarController',
                  'viewTest');

                  $router->addRoute('home',
                    '/home/',
                    '\hangarapp\control\HangarController',
                    'viewHome',
                    HangarAuthentification::ACCESS_LEVEL_USER);

                    $router->addRoute('login',
                    '/login/',
                    '\hangarapp\control\HangarAuthController',
                    'login',
                    HangarAuthentification::ACCESS_LEVEL_NONE);

                    $router->addRoute('check_login',
                    '/check_login/',
                    '\hangarapp\control\HangarAuthController',
                    'CheckLogin',
                    HangarAuthentification::ACCESS_LEVEL_USER);


                  $router->addRoute('unProducteur',
                  '/unProducteur/',
                  '\hangarapp\control\HangarController',
                  'viewunProducteur');

                  
                  $router->addRoute('commandes',
                  '/commandes/',
                  '\hangarapp\control\HangarController',
                  'viewCommande');

                  
                  $router->addRoute('uneCommande',
                  '/uneCommande/',
                  '\hangarapp\control\HangarController',
                  'viewUneCommande');


                
                  $auth = new HangarAuthentification();
                  //$auth->createUser("Henry", "Marseille", "henry@mail.com", "1999",100);
                  
                  $router->setDefaultRoute('/login/');
                  $router->run();
