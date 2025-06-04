<?php
require_once 'NotificationEmail.php';
require_once 'NotificationSMS.php';
require_once 'NotificationPush.php';
require_once 'NotificationSystem.php';

$notifications = array(
    new NotificationEmail(),
    new NotificationSMS(),
    new NotificationPush(),
    new NotificationEmail(),
    new NotificationSMS()
);

echo "=== SYSTÈME DE NOTIFICATIONS ===\n\n";

echo "--- Envoi des notifications ---\n";
foreach ($notifications as $index => $notification) {
    echo "Notification " . ($index + 1) . " : ";
    $notification->envoyerNotification();
}

echo "\n--- Test du système de log ---\n";
$system = new NotificationSystem();
$system->log("Envoi de notification.");
$system->log("Système initialisé.");

echo "\n--- Test de la méthode final ---\n";
$emailNotif = new NotificationEmail();
$emailNotif->configurerServeurSMTP();

echo "\n=== DÉMONSTRATION DU POLYMORPHISME ===\n";
echo "Même interface, comportements différents :\n";
foreach ($notifications as $notification) {
    $notification->envoyerNotification();
}