<?php
require_once 'CompteBancaire.php';

// Création d'un compte bancaire
$compte = new CompteBancaire(1000, "Jean Dupont");

echo "=== Test de la classe CompteBancaire ===\n\n";

// Affichage des informations initiales
echo "Titulaire du compte : " . $compte->getTitulaire() . "\n";
$compte->afficherSolde();
echo "\n";

// Test de dépôt
echo "--- Test de dépôt ---\n";
$compte->depot(500);
$compte->afficherSolde();
echo "\n";

// Test de dépôt négatif (erreur attendue)
echo "--- Test de dépôt négatif ---\n";
$compte->depot(-100);
echo "\n";

echo "--- Test de retrait ---\n";
$compte->retrait(200);
$compte->afficherSolde();
echo "\n";

echo "--- Test de retrait supérieur au solde ---\n";
$compte->retrait(2000);
$compte->afficherSolde();
echo "\n";

echo "--- Test de retrait négatif ---\n";
$compte->retrait(-50);
echo "\n";

echo "--- Calcul des intérêts ---\n";
$compte->calculerInterets(2.5);
echo "\n";

echo "=== Fin des tests ===\n";
?>
