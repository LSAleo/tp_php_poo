<?php
require_once 'LivrePapier.php';
require_once 'Ebook.php';

$livrePapier = new LivrePapier("Le Petit Prince", "Antoine de Saint-Exupéry", 1943, 96);
$ebook = new Ebook("1984", "George Orwell", 1949, "PDF");

echo "=== Détails du livre papier ===\n";
$livrePapier->afficherDetails();
echo "\n";

echo "=== Détails de l'ebook ===\n";
$ebook->afficherDetails();
echo "\n";

echo "=== Test d'emprunt ===\n";
$livrePapier->emprunter();
$livrePapier->emprunter();
echo "\n";

$ebook->emprunter();
$ebook->emprunter();