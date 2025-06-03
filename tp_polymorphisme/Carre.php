<?php
require_once 'FormeGeometrique.php';

class Carre extends FormeGeometrique {
    private $cote;
    
    public function __construct($cote) {
        $this->cote = $cote;
    }
    
    public function calculerAire() {
        return pow($this->cote, 2);
    }
    
    public function __toString() {
        return "Carré (côté: " . $this->cote . ")";
    }
}