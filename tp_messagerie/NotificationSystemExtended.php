<?php
require_once 'NotificationSystem.php';

class NotificationSystemExtended extends NotificationSystem {
    public function logAvance($message) {
        echo "Log avancé : " . $message . "\n";
    }
}