<?php
class ReservationConflictException extends Exception {
    public function __construct($message = "Conflit de réservation détecté", $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}