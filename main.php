<?php
require_once 'ClassLoaders/AbstractClassLoader.php';
require_once 'ClassLoaders/ClassLoader.php';
require_once 'model/Data.php';
use model\Commande as commande;
use model\Panier as panier;

$loader = new ClassLoaders\ClassLoader('.');
$loader->register();

$panier = new panier();
$panier->viderPanier(1);

$c = new commande();
$c->getNomClient('CAI');
print_r ($c);

