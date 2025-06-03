<?php
class Vehicule {
    protected $marque;
    protected $modele;
    protected $annee;
    protected $kilometrage;
    protected $dernierEntretien;
    
    public function __construct($marque, $modele, $annee, $kilometrage) {
        $this->marque = $marque;
        $this->modele = $modele;
        $this->annee = $annee;
        $this->kilometrage = $kilometrage;
        $this->dernierEntretien = null;
    }
    
    public function afficherInfos() {
        echo "Marque : " . $this->marque . "\n";
        echo "Modèle : " . $this->modele . "\n";
        echo "Année : " . $this->annee . "\n";
        echo "Kilométrage : " . $this->kilometrage . " km\n";
    }
    
    public function programmerEntretien($date) {
        $this->dernierEntretien = $date;
        echo "Entretien programmé le " . $date . "\n";
    }
    
    public function afficherProchainEntretien() {
        if ($this->dernierEntretien) {
            echo "Dernier entretien : " . $this->dernierEntretien . "\n";
            echo "Prochain entretien recommandé dans 6 mois\n";
        } else {
            echo "Aucun entretien programmé\n";
        }
    }
}