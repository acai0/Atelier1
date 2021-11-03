<?php
class Produit{
    private $id;
    private $id_producteur;
    private $id_categorie;
    private $nom;
    private $description;
    private $tarif_unitaire;
    private $photo;

    public function __construct($id, $id_producteur, $id_categorie, $nom, $description, $tarif_unitaire, $photo){
        $this->id=$id;
        $this->id_producteur=$id_producteur;
        $this->id_categorie=$id_categorie;
        $this->nom=$nom;
        $this->description=$description;
        $this->tarif_unitaire=$tarif_unitaire;
        $this->photo=$photo;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getId_Producteur()
    {
        return $this->id_producteur;
    }
    public function getId_Categorie()
    {
        return $this->id_categorie;
    }
    public function getNom()
    {
        return $this->nom;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function getTarif_Unitaire()
    {
        return $this->tarif_unitaire;
    }
    public function getPhoto()
    {
        return $this->photo;
    }
}