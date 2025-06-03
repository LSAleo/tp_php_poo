<?php
class Livre {
    protected $titre;
    protected $auteur;
    protected $anneePublication;
    
    public function __construct($titre, $auteur, $anneePublication) {
        $this->titre = $titre;
        $this->auteur = $auteur;
        $this->anneePublication = $anneePublication;
    }
    
    public function afficherDetails() {
        echo "Titre : " . $this->titre . "\n";
        echo "Auteur : " . $this->auteur . "\n";
        echo "Année de publication : " . $this->anneePublication . "\n";
    }
}