<?php
require_once 'Animal.php';

class Chat extends Animal {
    private $couleur;
    
    public function __construct($nom, $age, $couleur) {
        parent::__construct($nom, $age);
        $this->couleur = $couleur;
    }
    
    public function decrire() {
        return "Je suis un animal nommé " . $this->nom . ", j'ai " . $this->age . " ans. Je suis un chat de couleur " . $this->couleur . ".";
    }
    
    public function crier() {
        return "Miaou!";
    }
}