<?php
require_once 'Chien.php';
require_once 'Chat.php';
require_once 'Oiseau.php';

$animaux = array(
    new Chien("Rex", 5, "Berger Allemand"),
    new Chat("Whiskers", 3, "noir"),
    new Oiseau("Tweety", 2, "canari"),
    new Chien("Buddy", 7, "Labrador"),
    new Chat("Minou", 4, "blanc"),
    new Oiseau("Eagle", 8, "aigle")
);

echo "=== ZOO INTERACTIF ===\n\n";

echo "--- Descriptions des animaux ---\n";
foreach ($animaux as $animal) {
    echo $animal->decrire() . "\n";
    echo "Cri : " . $animal->crier() . "\n";
    echo str_repeat("-", 50) . "\n";
}

echo "\n=== DÉMONSTRATION DU POLYMORPHISME ===\n";
echo "Même méthode appelée, comportements différents :\n\n";

foreach ($animaux as $index => $animal) {
    echo "Animal " . ($index + 1) . " : " . $animal->crier() . "\n";
}