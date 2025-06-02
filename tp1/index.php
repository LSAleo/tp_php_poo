<?php
require_once 'Etudiant.php';

$etudiant1 = new Etudiant("Dupont", "Marie");
$etudiant2 = new Etudiant("Martin", "Pierre");
$etudiant3 = new Etudiant("Lemoine", "Sophie");

$etudiant1->ajouterNote(15);
$etudiant1->ajouterNote(18);
$etudiant1->ajouterNote(16);

$etudiant2->ajouterNote(12);
$etudiant2->ajouterNote(10);
$etudiant2->ajouterNote(14);

$etudiant3->ajouterNote(17);
$etudiant3->ajouterNote(19);
$etudiant3->ajouterNote(18);

echo "<h1>Résultats des étudiants</h1>";

echo "<h2>Marie Dupont</h2>";
echo "Notes : " . implode(", ", $etudiant1->getNotes()) . "<br>";
echo "Moyenne : " . $etudiant1->calculerMoyenne() . "<br><br>";

echo "<h2>Pierre Martin</h2>";
echo "Notes : " . implode(", ", $etudiant2->getNotes()) . "<br>";
echo "Moyenne : " . $etudiant2->calculerMoyenne() . "<br><br>";

echo "<h2>Sophie Lemoine</h2>";
echo "Notes : " . implode(", ", $etudiant3->getNotes()) . "<br>";
echo "Moyenne : " . $etudiant3->calculerMoyenne() . "<br>";