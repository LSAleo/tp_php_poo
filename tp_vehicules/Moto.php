<?php
require_once 'Vehicule.php';

class Moto extends Vehicule {
    private $cylindree;
    
    public function __construct($marque, $modele, $annee, $kilometrage, $cylindree) {
        parent::__construct($marque, $modele, $annee, $kilometrage);
        $this->cylindree = $cylindree;
    }
    
    public function afficherInfos() {
        parent::afficherInfos();
        echo "Cylindrée : " . $this->cylindree . " cm³\n";
        echo "Type : Moto\n";
    }
}