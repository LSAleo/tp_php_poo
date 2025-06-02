<?php
require_once 'Contact.php';

$contact1 = new Contact("Dupont", "Alice", "alice@example.com");
$contact2 = new Contact("Martin", "Bob", "bob@example.com");

echo "Contact 1 :\n";
echo "Nom : " . $contact1->getNom() . "\n";
echo "Prénom : " . $contact1->getPrenom() . "\n";
echo "Email : " . $contact1->getEmail() . "\n\n";

echo "Contact 2 :\n";
echo "Nom : " . $contact2->getNom() . "\n";
echo "Prénom : " . $contact2->getPrenom() . "\n";
echo "Email : " . $contact2->getEmail() . "\n";