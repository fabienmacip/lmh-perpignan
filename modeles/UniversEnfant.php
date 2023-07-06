<?php

class UniversEnfant
{
    use Modele;

    private $id;
    private $nom;
    private $surnom;
    private $image;
    private $univers;
    private $actif;
    
    public function afficher($id)
    {
        if (!is_null($this->pdo)) {
            $stmt = $this->pdo->prepare('SELECT * FROM universenfant WHERE id = ?');
        }
        $tuple = null;
        if ($stmt->execute([$id])) {
            $tuple = $stmt->fetchObject('UniversEnfant',[$this->pdo]);
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

    public function getSurnom()
    {
        return $this->surnom;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getUniversId()
    {
        return $this->univers;
    }

}