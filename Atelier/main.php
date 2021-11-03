<?php
require_once 'ClassLoaders/AbstractClassLoader.php';
require_once 'ClassLoaders/ClassLoader.php';

$loader = new ClassLoaders\ClassLoader('.');
$loader->register();

$panier = new Model\Panier();
$panier->viderPanier(1);
