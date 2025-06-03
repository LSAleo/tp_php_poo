<?php
require_once 'Livre.php';

class LivrePapier extends Livre {
    private $nombrePages;
    private $emprunte;
    
    public function __construct($titre, $auteur, $anneePublication, $nombrePages) {
        parent::__construct($titre, $auteur, $anneePublication);
        $this->nombrePages = $nombrePages;
        $this->emprunte = false;
    }
    
    public function afficherDetails() {
        parent::afficherDetails();
        echo "Nombre de pages : " . $this->nombrePages . "\n";
        echo "Type : Livre papier\n";
    }
    
    public function emprunter() {
        if ($this->emprunte) {
            echo "Ce livre papier est déjà emprunté.\n";
        } else {
            $this->emprunte = true;
            echo "Le livre papier '" . $this->titre . "' a été emprunté avec succès.\n";
        }
    }
}