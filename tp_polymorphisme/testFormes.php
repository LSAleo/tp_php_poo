<?php
require_once 'Cercle.php';
require_once 'Rectangle.php';
require_once 'Triangle.php';
require_once 'Carre.php';
require_once 'Losange.php';
require_once 'CalculateurAire.php';

$formes = array(
    new Cercle(5),
    new Rectangle(10, 6),
    new Triangle(3, 4, 5),
    new Carre(7),
    new Losange(8, 6),
    new Cercle(3.5),
    new Rectangle(4.5, 2.8)
);

$calculateur = new CalculateurAire();

echo "=== CALCUL DES AIRES GÉOMÉTRIQUES ===\n\n";
echo "Aires individuelles:\n";
echo str_repeat("-", 50) . "\n";

$aireTotal = $calculateur->calculerAireTotale($formes);

echo str_repeat("-", 50) . "\n";
echo "Aire totale de toutes les formes: " . round($aireTotal, 2) . "\n";

echo "\n=== DÉMONSTRATION DU POLYMORPHISME ===\n";
echo "Même méthode calculerAire() appelée sur différentes formes:\n\n";

foreach ($formes as $index => $forme) {
    echo "Forme " . ($index + 1) . ": " . round($forme->calculerAire(), 2) . "\n";
}