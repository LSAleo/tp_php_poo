<?php
require_once 'NotificationEmail.php';

class NotificationEmailAvancee extends NotificationEmail {
    public function envoyerNotification() {
        echo "Envoi d'un email de notification avancée avec template.\n";
    }
    
    public function configurerServeurSMTP() {
        echo "Configuration avancée du serveur SMTP.\n";
    }
}