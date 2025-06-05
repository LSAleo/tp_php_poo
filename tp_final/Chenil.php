<?php
require_once 'Chien.php';
require_once 'ChienDeChasse.php';

class Chenil {
    private array $chiens;
    
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['chiens'])) {
            $_SESSION['chiens'] = [];
            $this->initialiserChiensPourDemo();
        }
        
        $this->chargerChiens();
    }
    
    private function initialiserChiensPourDemo(): void {
        $chiensDemo = [
            new Chien("Rex", 5, "Berger Allemand", "Brun", "Mâle", 35.5),
            new Chien("Bella", 3, "Golden Retriever", "Doré", "Femelle", 28.2),
            new ChienDeChasse("Hunter", 7, "Pointer", "Blanc et marron", "Mâle", 22.8, "Gibier à plumes"),
            new Chien("Luna", 2, "Husky", "Gris et blanc", "Femelle", 18.5),
            new ChienDeChasse("Ranger", 6, "Braque", "Marron", "Mâle", 25.3, "Sanglier")
        ];
        
        foreach ($chiensDemo as $index => $chien) {
            $_SESSION['chiens'][$index] = serialize($chien);
        }
    }
    
    private function chargerChiens(): void {
        $this->chiens = [];
        foreach ($_SESSION['chiens'] as $index => $chienSerialized) {
            $this->chiens[$index] = unserialize($chienSerialized);
        }
    }
    
    private function sauvegarderChiens(): void {
        $_SESSION['chiens'] = [];
        foreach ($this->chiens as $index => $chien) {
            $_SESSION['chiens'][$index] = serialize($chien);
        }
    }
    
    public function ajouterChien(Chien $chien): void {
        $this->chiens[] = $chien;
        $this->sauvegarderChiens();
    }
    
    public function obtenirTousLesChiens(): array {
        return $this->chiens;
    }
    
    public function obtenirChien(int $index): ?Chien {
        return $this->chiens[$index] ?? null;
    }
    
    public function mettreAJourChien(int $index, Chien $chien): bool {
        if (isset($this->chiens[$index])) {
            $this->chiens[$index] = $chien;
            $this->sauvegarderChiens();
            return true;
        }
        return false;
    }
    
    public function supprimerChien(int $index): bool {
        if (isset($this->chiens[$index])) {
            unset($this->chiens[$index]);
            $this->chiens = array_values($this->chiens);
            $this->sauvegarderChiens();
            return true;
        }
        return false;
    }
    
    public function rechercherParNom(string $nom): array {
        $resultats = [];
        foreach ($this->chiens as $index => $chien) {
            if (stripos($chien->getNom(), $nom) !== false) {
                $resultats[$index] = $chien;
            }
        }
        return $resultats;
    }
    
    public function getNombreChiens(): int {
        return count($this->chiens);
    }
}