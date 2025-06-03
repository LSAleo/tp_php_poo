<?php
require_once 'FormeGeometrique.php';

class Cercle extends FormeGeometrique {
    private $rayon;
    
    public function __construct($rayon) {
        $this->rayon = $rayon;
    }
    
    public function calculerAire() {
        return pi() * pow($this->rayon, 2);
    }
    
    public function __toString() {
        return "Cercle (rayon: " . $this->rayon . ")";
    }
}