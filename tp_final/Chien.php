<?php
require_once 'Animal.php';

class Chien implements Animal {
    private string $nom;
    private int $age;
    private string $race;
    private string $couleur;
    private string $sexe;
    private float $poids;
    
    public function __construct(string $nom, int $age, string $race, string $couleur, string $sexe, float $poids) {
        $this->nom = $nom;
        $this->age = $age;
        $this->race = $race;
        $this->couleur = $couleur;
        $this->sexe = $sexe;
        $this->poids = $poids;
    }
    
    public function afficherDetails(): string {
        return "Nom: {$this->nom}, Âge: {$this->age} ans, Race: {$this->race}, " .
               "Couleur: {$this->couleur}, Sexe: {$this->sexe}, Poids: {$this->poids} kg";
    }
    
    public function calculerAgeHumain(): int {
        return $this->age * 7;
    }
    
    public function crier(): string {
        return "Wouf! Wouf!";
    }
    
    public function estEnSurpoids(): bool {
        return $this->poids > 20;
    }
    
    // Getters et setters...
    public function getNom(): string {
        return $this->nom;
    }
    
    public function getAge(): int {
        return $this->age;
    }
    
    public function getRace(): string {
        return $this->race;
    }
    
    public function getCouleur(): string {
        return $this->couleur;
    }
    
    public function getSexe(): string {
        return $this->sexe;
    }
    
    public function getPoids(): float {
        return $this->poids;
    }
    
    public function setNom(string $nom): void {
        $this->nom = $nom;
    }
    
    public function setAge(int $age): void {
        $this->age = $age;
    }
    
    public function setRace(string $race): void {
        $this->race = $race;
    }
    
    public function setCouleur(string $couleur): void {
        $this->couleur = $couleur;
    }
    
    public function setSexe(string $sexe): void {
        $this->sexe = $sexe;
    }
    
    public function setPoids(float $poids): void {
        $this->poids = $poids;
    }
}