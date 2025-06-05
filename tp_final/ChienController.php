<?php
require_once 'Chenil.php';
require_once 'ChienView.php';
require_once 'ListeChiensView.php';

class ChienController {
    private Chenil $chenil;
    private ChienView $chienView;
    private ListeChiensView $listeView;
    
    public function __construct() {
        $this->chenil = new Chenil();
        $this->chienView = new ChienView();
        $this->listeView = new ListeChiensView();
    }
    
    public function gererRequete(): void {
        $action = $_GET['action'] ?? 'liste';
        
        switch ($action) {
            case 'liste':
                $this->afficherListe();
                break;
            case 'detail':
                $this->afficherDetail();
                break;
            case 'ajouter':
                $this->ajouterChien();
                break;
            case 'modifier':
                $this->modifierChien();
                break;
            case 'supprimer':
                $this->supprimerChien();
                break;
            case 'rechercher':
                $this->rechercherChiens();
                break;
            case 'polymorphisme':
                $this->demonstrationPolymorphisme();
                break;
            default:
                $this->afficherListe();
        }
    }
    
    private function afficherListe(): void {
        $chiens = $this->chenil->obtenirTousLesChiens();
        $this->listeView->afficher($chiens);
    }
    
    private function afficherDetail(): void {
        $index = $_GET['index'] ?? -1;
        $chien = $this->chenil->obtenirChien($index);
        
        if ($chien) {
            $this->chienView->afficherDetail($chien, $index);
        } else {
            $this->listeView->afficherErreur("Chien non trouvé.");
            $this->afficherListe();
        }
    }
    
    private function ajouterChien(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = trim($_POST['nom']);
            $age = intval($_POST['age']);
            $race = trim($_POST['race']);
            $couleur = trim($_POST['couleur']);
            $sexe = $_POST['sexe'];
            $poids = floatval($_POST['poids']);
            $type = $_POST['type'];
            
            if ($type === 'chasse') {
                $specialite = trim($_POST['specialite']);
                $chien = new ChienDeChasse($nom, $age, $race, $couleur, $sexe, $poids, $specialite);
            } else {
                $chien = new Chien($nom, $age, $race, $couleur, $sexe, $poids);
            }
            
            $this->chenil->ajouterChien($chien);
            header('Location: ?action=liste&message=ajoute');
            exit;
        } else {
            $this->chienView->afficherFormulaireAjout();
        }
    }
    
    private function modifierChien(): void {
        $index = $_GET['index'] ?? -1;
        $chien = $this->chenil->obtenirChien($index);
        
        if (!$chien) {
            $this->listeView->afficherErreur("Chien non trouvé.");
            $this->afficherListe();
            return;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $chien->setNom(trim($_POST['nom']));
            $chien->setAge(intval($_POST['age']));
            $chien->setRace(trim($_POST['race']));
            $chien->setCouleur(trim($_POST['couleur']));
            $chien->setSexe($_POST['sexe']);
            $chien->setPoids(floatval($_POST['poids']));
            
            if ($chien instanceof ChienDeChasse) {
                $chien->setSpecialite(trim($_POST['specialite']));
            }
            
            $this->chenil->mettreAJourChien($index, $chien);
            header('Location: ?action=liste&message=modifie');
            exit;
        } else {
            $this->chienView->afficherFormulaireModification($chien, $index);
        }
    }
    
    private function supprimerChien(): void {
        $index = $_GET['index'] ?? -1;
        
        if ($this->chenil->supprimerChien($index)) {
            header('Location: ?action=liste&message=supprime');
        } else {
            header('Location: ?action=liste&message=erreur');
        }
        exit;
    }
    
    private function rechercherChiens(): void {
        $terme = $_GET['q'] ?? '';
        
        if (!empty($terme)) {
            $resultats = $this->chenil->rechercherParNom($terme);
            $this->listeView->afficherResultatsRecherche($resultats, $terme);
        } else {
            $this->afficherListe();
        }
    }
    
    private function demonstrationPolymorphisme(): void {
        $chiens = $this->chenil->obtenirTousLesChiens();
        $this->listeView->afficherPolymorphisme($chiens);
    }
}