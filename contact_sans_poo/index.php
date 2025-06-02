<?php
$contact1 = array(
    'nom' => 'Dupont',
    'prenom' => 'Alice',
    'email' => 'alice@example.com'
);

$contact2 = array(
    'nom' => 'Martin',
    'prenom' => 'Bob',
    'email' => 'bob@example.com'
);

$listeContacts = array($contact1, $contact2);

echo "=== LISTE DES CONTACTS ===\n\n";

echo "--- Affichage avec boucle for ---\n";
for ($i = 0; $i < count($listeContacts); $i++) {
    echo "Contact " . ($i + 1) . " :\n";
    echo "  Nom : " . $listeContacts[$i]['nom'] . "\n";
    echo "  Prénom : " . $listeContacts[$i]['prenom'] . "\n";
    echo "  Email : " . $listeContacts[$i]['email'] . "\n";
    echo "\n";
}

echo "--- Affichage avec boucle foreach ---\n";
$numeroContact = 1;
foreach ($listeContacts as $contact) {
    echo "Contact " . $numeroContact . " :\n";
    echo "  Nom : " . $contact['nom'] . "\n";
    echo "  Prénom : " . $contact['prenom'] . "\n";
    echo "  Email : " . $contact['email'] . "\n";
    echo "\n";
    $numeroContact++;
}