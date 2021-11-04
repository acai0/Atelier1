<?php
declare(strict_types=1);

// Affichage des erreurs
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Autoloader
require_once 'src/mf/utils/AbstractClassLoader.php';
require_once 'src/mf/utils/ClassLoader.php';

/* pour le chargement automatique des classes d'Eloquent (dans le répertoire vendor) */
require_once 'vendor/autoload.php';
require_once 'conf/conf.ini';

$loader = new \mf\utils\ClassLoader('src');
$loader->register();

// Router
use mf\router\Router as Router;

// Models
use hangarapp\model\Commande as Commande;
use hangarapp\model\Categorie as Categorie;
use hangarapp\model\Produit as Produit;
use hangarapp\model\User as User;

// Controllers
use hangarapp\control\HangarController as HangarController;

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

                
$router->setDefaultRoute('/home/');

$router->run();
echo "/*************************** Liste des commandes ********************* /<br>";
$c=new hangarapp\model\Commande;
$requete = Commande::select(); 

$lignesC = $requete->get();  

foreach ($lignesC as $c)     
    echo "Identifiant = $c->Id, Nom = $c->Nom_client, Mail=$c->Mail_client, Telephone= $c->Tel_client, Montant=$c->Montant, Etat=$c->Etat<br>" ;
