<?php
namespace modeles;
class Panier{
    private $id_produit;
    private $id_commande;
    private $quantite;
    
    public function __construct($id_produit, $id_commande, $quantite){
        $this->id_produit=$id_produit;
        $this->id_commande=$id_commande;
        $this->quantite=$quantite;
    }
    public function getIdProduit()
    {
        return $this->id_produit;
    }
    public function getIdCommande()
    {
        return $this->id_commande;
    }
    public function getQuantite()
    {
        return $this->quantite;
    }
}