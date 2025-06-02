<?php
class Etudiant
{
    private $nom;
    private $prenom;
    private $notes = [];

    public function __construct($nom, $prenom)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
    }
    public function ajouterNote($note)
    {
        if ($note >= 0 && $note <= 20) {
            $this->notes[] = $note;
        } else {
            throw new InvalidArgumentException("La note doit être comprise entre 0 et 20");
        }
    }

    public function getNotes()
    {
        return $this->notes;
    }

    public function calculerMoyenne()
    {
        if (count($this->notes) === 0) {
            return null;
        }
        return array_sum($this->notes) / count($this->notes);
    }

    public function afficherInformations()
    {
        echo "Nom : " . $this->nom . "<br>";
        echo "Prénom : " . $this->prenom . "<br>";
        echo "Notes : " . implode(", ", $this->notes) . "<br>";

        $moyenne = $this->calculerMoyenne();
        if ($moyenne !== null) {
            echo "Moyenne : " . number_format($moyenne, 2) . "<br>";
        } else {
            echo "Moyenne : Aucune note disponible<br>";
        }
    }

}