<?php

class Prospect
{
    use Modele;

    private $id;
    private $nom;
    private $prenom;
    private $mail;
    private $telephone;
    private $dateokcookie;
    
    public function afficher($id)
    {
        if (!is_null($this->pdo)) {
            $stmt = $this->pdo->prepare('SELECT * FROM prospect WHERE id = ?');
        }
        $tuple = null;
        if ($stmt->execute([$id])) {
            $tuple = $stmt->fetchObject('Prospect',[$this->pdo]);
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

    public function getPrenom() 
    {
        return $this->prenom;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function getTelephone()
    {
        return $this->telephone;
    }

    public function getDateOkCookie()
    {
        return $this->dateokcookie;
    }

}