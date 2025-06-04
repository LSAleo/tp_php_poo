<?php
class TacheController {
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['taches'])) {
            $_SESSION['taches'] = array();
        }
    }
    
    public function ajouterTache($nom, $description) {
        $id = uniqid();
        $tache = array(
            'id' => $id,
            'nom' => $nom,
            'description' => $description,
            'date_creation' => date('Y-m-d H:i:s'),
            'completee' => false
        );
        
        $_SESSION['taches'][] = $tache;
        return $id;
    }
    
    public function getTaches() {
        return $_SESSION['taches'];
    }
    
    public function supprimerTache($id) {
        foreach ($_SESSION['taches'] as $index => $tache) {
            if ($tache['id'] === $id) {
                unset($_SESSION['taches'][$index]);
                $_SESSION['taches'] = array_values($_SESSION['taches']);
                return true;
            }
        }
        return false;
    }
    
    public function modifierTache($id, $nom, $description) {
        foreach ($_SESSION['taches'] as &$tache) {
            if ($tache['id'] === $id) {
                $tache['nom'] = $nom;
                $tache['description'] = $description;
                return true;
            }
        }
        return false;
    }
    
    public function marquerComplete($id) {
        foreach ($_SESSION['taches'] as &$tache) {
            if ($tache['id'] === $id) {
                $tache['completee'] = !$tache['completee'];
                return true;
            }
        }
        return false;
    }
    
    public function getTache($id) {
        foreach ($_SESSION['taches'] as $tache) {
            if ($tache['id'] === $id) {
                return $tache;
            }
        }
        return null;
    }
}