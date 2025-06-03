<?php
require_once 'Animal.php';

class Oiseau extends Animal {
    private $espece;
    
    public function __construct($nom, $age, $espece) {
        parent::__construct($nom, $age);
        $this->espece = $espece;
    }
    
    public function decrire() {
        return "Je suis un animal nommé " . $this->nom . ", j'ai " . $this->age . " ans. Je suis un oiseau de l'espèce " . $this->espece . ".";
    }
    
    public function crier() {
        return "Cui-cui!";
    }
}