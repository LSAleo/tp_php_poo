<?php
require_once 'FormeGeometrique.php';

class Triangle extends FormeGeometrique {
    private $coteA;
    private $coteB;
    private $coteC;
    
    public function __construct($coteA, $coteB, $coteC) {
        $this->coteA = $coteA;
        $this->coteB = $coteB;
        $this->coteC = $coteC;
    }
    
    public function calculerAire() {
        $s = ($this->coteA + $this->coteB + $this->coteC) / 2;
        return sqrt($s * ($s - $this->coteA) * ($s - $this->coteB) * ($s - $this->coteC));
    }
    
    public function __toString() {
        return "Triangle (côtés: " . $this->coteA . ", " . $this->coteB . ", " . $this->coteC . ")";
    }
}