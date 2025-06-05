<?php
class TaskAlreadyCompletedException extends Exception {
    public function __construct($message = "Cette tâche est déjà terminée", $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}