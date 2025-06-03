<?php
require_once 'Livre.php';

class Ebook extends Livre {
    private $format;
    private $emprunte;
    
    public function __construct($titre, $auteur, $anneePublication, $format) {
        parent::__construct($titre, $auteur, $anneePublication);
        $this->format = $format;
        $this->emprunte = false;
    }
    
    public function afficherDetails() {
        parent::afficherDetails();
        echo "Format : " . $this->format . "\n";
        echo "Type : Ebook\n";
    }
    
    public function emprunter() {
        if ($this->emprunte) {
            echo "Cet ebook est déjà emprunté.\n";
        } else {
            $this->emprunte = true;
            echo "L'ebook '" . $this->titre . "' a été emprunté avec succès.\n";
        }
    }
}