<?php
namespace Model;

use PDO;

class Panier
{
  private $BDD;

  public function __construct()
  {
    $this->BDD = new Data;
  }

  public function ajoutPanier($produit,$commande,$qte)
  {//Fonction pour ajouter au panier.
    $connexion = $this->BDD->connexionPDO();
    $requete = "INSERT INTO `Panier`(`Id_produit`, `Id_Commande`, `Quantite`) VALUES ($produit,$commande,$qte)";
    $req = $connexion->prepare($requete);
    $req->execute();
  }

  public function supprimePanier($produit,$commande)
  {//Supprime un produit du panier
    $connexion = $this->BDD->connexionPDO();
    $requete = "DELETE FROM Panier WHERE id_produit = $produit AND id_Commande = $commande";
    $req = $connexion->prepare($requete);
    $req->execute();
  }

  public function modifiePanier($produit,$commande,$qte)
  {//Modifie la quantité d'un produit
    $connexion = $this->BDD->connexionPDO();
    $requete = "UPDATE `Panier` SET Quantite = $qte WHERE id_produit = $produit AND id_Commande = $commande";
    $req = $connexion->prepare($requete);
    $req->execute();
  }

  public function viderPanier($commande)
  {//Vide le panier
    $connexion = $this->BDD->connexionPDO();
    $requete = "DELETE FROM Panier WHERE Id_Commande = $commande";
    $req = $connexion->prepare($requete);
    $req->execute();
  }

  /*public function affichage($user)
  {//Fonction pour afficher le nom du produit, le tarif à l'unité ainsi que la quantité commandée.
    $connexion = $this->connexionPDO();
    $req = "SELECT Produit.Nom, Produit.Quantite,";
    $req = $connexion->prepare($requete);
    $resultat = $req->fetch(PDO::FETCH_ASSOC);
    $result = "<ul>";
    foreach($resulat as $ligne)
    {
      $prix = $ligne["Prix"] * $ligne["Qte"];
      $result += "<li>Produit : $ligne["Nom"]   Prix unitaire : $ligne["Prix"]   <input type ="number" id ="commande" value="$prix"></input></li>";
    }
    return $result + "</ul>";
  }*/
}