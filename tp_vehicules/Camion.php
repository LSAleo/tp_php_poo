<?php
require_once 'Vehicule.php';

class Camion extends Vehicule {
    private $poidsMax;
    private $chargeActuelle;
    
    public function __construct($marque, $modele, $annee, $kilometrage, $poidsMax) {
        parent::__construct($marque, $modele, $annee, $kilometrage);
        $this->poidsMax = $poidsMax;
        $this->chargeActuelle = 0;
    }
    
    public function afficherInfos() {
        parent::afficherInfos();
        echo "Poids maximum : " . $this->poidsMax . " kg\n";
        echo "Charge actuelle : " . $this->chargeActuelle . " kg\n";
        echo "Type : Camion\n";
    }
    
    public function charger($poids) {
        if (($this->chargeActuelle + $poids) > $this->poidsMax) {
            echo "Erreur : La charge dépasse le poids maximum autorisé\n";
            echo "Charge actuelle : " . $this->chargeActuelle . " kg\n";
            echo "Poids à charger : " . $poids . " kg\n";
            echo "Poids maximum : " . $this->poidsMax . " kg\n";
        } else {
            $this->chargeActuelle += $poids;
            echo "Chargement de " . $poids . " kg effectué avec succès\n";
            echo "Nouvelle charge : " . $this->chargeActuelle . " kg\n";
        }
    }
}