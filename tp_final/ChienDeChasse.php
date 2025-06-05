<?php
require_once 'Chien.php';

class ChienDeChasse extends Chien {
    private string $specialite;
    
    public function __construct(string $nom, int $age, string $race, string $couleur, string $sexe, float $poids, string $specialite) {
        parent::__construct($nom, $age, $race, $couleur, $sexe, $poids);
        $this->specialite = $specialite;
    }
    
    public function crier(): string {
        return "Wouaf! Wouaf! Je suis un chasseur!";
    }
    
    public function afficherDetails(): string {
        return parent::afficherDetails() . ", Spécialité: {$this->specialite}";
    }
    
    public function getSpecialite(): string {
        return $this->specialite;
    }
    
    public function setSpecialite(string $specialite): void {
        $this->specialite = $specialite;
    }
}