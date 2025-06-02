<?php
require_once 'Produit.php';

$produit1 = new Produit("Ordinateur portable", 899.99);
$produit2 = new Produit("Souris gaming", 45.50);
$produit3 = new Produit("Clavier mécanique", 120.00);
$produit4 = new Produit("Écran 24 pouces", 249.99);
$produit5 = new Produit("Casque audio", 79.99);

$panier = [$produit1, $produit2, $produit3, $produit4, $produit5];

echo "<h1>Contenu du panier</h1>";

$total = 0;
foreach ($panier as $produit) {
    echo "Nom : " . $produit->getNom() . " - Prix : " . $produit->getPrix() . "€<br>";
    $total += $produit->getPrix();
}

echo "<hr>";
echo "<h2>Total du panier : " . number_format($total, 2) . "€</h2>";

echo "<hr>";
echo "<h2>Affichage avec la méthode afficherProduit()</h2>";
foreach ($panier as $produit) {
    $produit->afficherProduit();
}