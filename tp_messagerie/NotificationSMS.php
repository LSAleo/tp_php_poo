<?php
require_once 'Notifiable.php';

class NotificationSMS implements Notifiable {
    public function envoyerNotification() {
        echo "Envoi d'un SMS de notification.\n";
    }
}