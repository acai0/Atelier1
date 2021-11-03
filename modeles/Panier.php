<?php
class Panier{
    private $id_produit;
    private $id_commande;
    private $quantite;
    
    public function __construct($id_produit, $id_commande, $quantite){
        $this->id_produit=$id_produit;
        $this->id_commande=$id_commande;
        $this->quantite=$quantite;
    }
    public function getId_Produit()
    {
        return $this->id_produit;
    }
    public function getId_Commande()
    {
        return $this->id_commande;
    }
    public function getQuantite()
    {
        return $this->quantite;
    }
}