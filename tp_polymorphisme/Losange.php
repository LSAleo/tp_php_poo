<?php
require_once 'FormeGeometrique.php';

class Losange extends FormeGeometrique {
    private $diagonale1;
    private $diagonale2;
    
    public function __construct($diagonale1, $diagonale2) {
        $this->diagonale1 = $diagonale1;
        $this->diagonale2 = $diagonale2;
    }
    
    public function calculerAire() {
        return ($this->diagonale1 * $this->diagonale2) / 2;
    }
    
    public function __toString() {
        return "Losange (diagonales: " . $this->diagonale1 . ", " . $this->diagonale2 . ")";
    }
}