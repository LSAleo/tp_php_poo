<?php
require_once 'Vehicule.php';

class Voiture extends Vehicule {
    private $nombrePortes;
    
    public function __construct($marque, $modele, $annee, $kilometrage, $nombrePortes) {
        parent::__construct($marque, $modele, $annee, $kilometrage);
        $this->nombrePortes = $nombrePortes;
    }
    
    public function afficherInfos() {
        parent::afficherInfos();
        echo "Nombre de portes : " . $this->nombrePortes . "\n";
        echo "Type : Voiture\n";
    }
}