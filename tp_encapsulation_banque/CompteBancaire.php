<?php
class CompteBancaire {
    private $solde;
    private $titulaire;
    
    public function __construct($soldeInitial, $nomTitulaire) {
        $this->solde = $soldeInitial;
        $this->titulaire = $nomTitulaire;
    }
    
    public function depot($montant) {
        if ($montant > 0) {
            $this->solde += $montant;
            echo "Dépôt de " . $montant . "€ effectué avec succès.\n";
        } else {
            echo "Erreur : Le montant du dépôt doit être positif.\n";
        }
    }
    
    public function retrait($montant) {
        if ($montant <= 0) {
            echo "Erreur : Le montant du retrait doit être positif.\n";
        } elseif ($montant > $this->solde) {
            echo "Erreur : Solde insuffisant pour effectuer ce retrait.\n";
        } else {
            $this->solde -= $montant;
            echo "Retrait de " . $montant . "€ effectué avec succès.\n";
        }
    }
    
    public function afficherSolde() {
        echo "Solde actuel : " . $this->solde . "€\n";
    }
    
    public function getTitulaire() {
        return $this->titulaire;
    }
    
    public function calculerInterets($tauxAnnuel) {
        $interets = $this->solde * ($tauxAnnuel / 100);
        echo "Montant des intérêts calculés (taux " . $tauxAnnuel . "%) : " . $interets . "€\n";
        return $interets;
    }
}