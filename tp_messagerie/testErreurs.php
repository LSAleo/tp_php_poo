<?php
echo "=== TEST DES ERREURS AVEC FINAL ===\n\n";

echo "--- Test 1: Tentative d'héritage de classe final ---\n";
try {
    require_once 'NotificationSystemExtended.php';
    echo "ERREUR : L'héritage de classe final devrait être bloqué !\n";
} catch (Error $e) {
    echo "Erreur PHP attendue : " . $e->getMessage() . "\n";
}

echo "\n--- Test 2: Tentative de redéfinition de méthode final ---\n";
try {
    require_once 'NotificationEmailAvancee.php';
    echo "ERREUR : La redéfinition de méthode final devrait être bloquée !\n";
} catch (Error $e) {
    echo "Erreur PHP attendue : " . $e->getMessage() . "\n";
}