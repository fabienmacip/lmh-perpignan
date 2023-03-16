<?php

class Partenaire
{
    use Modele;

    private $id;
    private $nom;
    private $univers;
    private $actif;
    
    public function afficher($id)
    {
        if (!is_null($this->pdo)) {
            $stmt = $this->pdo->prepare('SELECT * FROM partenaire WHERE id = ?');
        }
        $tuple = null;
        if ($stmt->execute([$id])) {
            $tuple = $stmt->fetchObject('Partenaire',[$this->pdo]);
            if (!is_object($tuple)) {
                $tuple = null;
            }
        }
        $stmt->closeCursor();
        return $tuple;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getUnivers()
    {
        return $this->univers;
    }

    public function getActif()
    {
        return $this->actif;
    }

    public function getPolice() {
        return $this->actif == 0 ? "police-blanche" : "";
    }


}