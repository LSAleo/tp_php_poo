<?php
class Produit {
    private $nom;
    private $prix;
    
    public function __construct($nom, $prix) {
        $this->nom = $nom;
        $this->prix = $prix;
    }
    
    public function getNom() {
        return $this->nom;
    }
    
    public function getPrix() {
        return $this->prix;
    }
    
    public function afficherProduit() {
        echo "Produit : " . $this->nom . " - Prix : " . $this->prix . "€<br>";
    }
}