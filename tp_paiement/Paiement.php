<?php
abstract class Paiement {
    protected $montant;
    
    public function __construct($montant) {
        $this->montant = $montant;
    }
    
    public function afficherMontant() {
        echo "Montant à payer : " . $this->montant . " euros\n";
    }
    
    abstract public function effectuerPaiement();
}