<?php
require_once 'Paiement.php';

class PaiementCB extends Paiement {
    public function effectuerPaiement() {
        echo "Paiement par carte bancaire effectué.\n";
    }
}