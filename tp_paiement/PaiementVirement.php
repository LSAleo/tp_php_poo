<?php
require_once 'Paiement.php';

class PaiementVirement extends Paiement {
    public function effectuerPaiement() {
        echo "Paiement par virement bancaire effectué.\n";
    }
}