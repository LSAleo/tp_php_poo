<?php
class Animal {
    protected $nom;
    protected $age;
    
    public function __construct($nom, $age) {
        $this->nom = $nom;
        $this->age = $age;
    }
    
    public function decrire() {
        return "Je suis un animal nommé " . $this->nom . ", j'ai " . $this->age . " ans.";
    }
}