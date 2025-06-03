<?php
require_once 'Voiture.php';
require_once 'Moto.php';
require_once 'Camion.php';

$voiture = new Voiture("Peugeot", "308", 2020, 45000, 5);
$moto = new Moto("Yamaha", "MT-07", 2019, 12000, 689);
$camion = new Camion("Renault", "Master", 2018, 80000, 3500);

echo "=== INFORMATIONS DES VÉHICULES ===\n\n";

echo "--- Voiture ---\n";
$voiture->afficherInfos();
echo "\n";

echo "--- Moto ---\n";
$moto->afficherInfos();
echo "\n";

echo "--- Camion ---\n";
$camion->afficherInfos();
echo "\n";

echo "=== PROGRAMMATION DES ENTRETIENS ===\n\n";

$voiture->programmerEntretien("15/06/2025");
$voiture->afficherProchainEntretien();
echo "\n";

$moto->programmerEntretien("20/06/2025");
$moto->afficherProchainEntretien();
echo "\n";

$camion->programmerEntretien("25/06/2025");
$camion->afficherProchainEntretien();
echo "\n";

echo "=== TEST DE CHARGEMENT DU CAMION ===\n\n";

$camion->charger(1000);
echo "\n";

$camion->charger(1500);
echo "\n";

$camion->charger(1200);
echo "\n";

echo "--- État final du camion ---\n";
$camion->afficherInfos();