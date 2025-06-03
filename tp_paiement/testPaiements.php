<?php
require_once 'PaiementCB.php';
require_once 'PaiementPaypal.php';
require_once 'PaiementVirement.php';

$paiements = array(
    new PaiementCB(150.50),
    new PaiementPaypal(89.99),
    new PaiementVirement(250.00),
    new PaiementCB(75.25),
    new PaiementPaypal(199.90)
);

echo "=== SYSTÈME DE PAIEMENT EN LIGNE ===\n\n";

foreach ($paiements as $index => $paiement) {
    echo "--- Paiement " . ($index + 1) . " ---\n";
    $paiement->afficherMontant();
    $paiement->effectuerPaiement();
    echo "\n";
}

echo "=== DÉMONSTRATION DU POLYMORPHISME ===\n";
echo "Nombre total de paiements traités : " . count($paiements) . "\n";