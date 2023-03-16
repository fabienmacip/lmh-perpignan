<?php

class Animal
{
    use Modele;

    private $id;
    private $nom;
    private $actif;
    
    public function afficherAnimal($id)
    {
        if (!is_null($this->pdo)) {
            $stmt = $this->pdo->prepare('SELECT * FROM animaux WHERE id = ?');
        }
        $animal = null;
        if ($stmt->execute([$id])) {
            $animal = $stmt->fetchObject('Animal',[$this->pdo]);
            if (!is_object($animal)) {
                $animal = null;
            }
        }
        $stmt->closeCursor();
        return $animal;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getActif()
    {
        return $this->actif;
    }

    public function getPolice() {
        return $this->actif == 0 ? "police-blanche" : "";
    }


}