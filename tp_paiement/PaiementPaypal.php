<?php
require_once 'Paiement.php';

class PaiementPaypal extends Paiement {
    public function effectuerPaiement() {
        echo "Paiement via PayPal effectué.\n";
    }
}