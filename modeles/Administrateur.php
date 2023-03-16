<?php

class Administrateur
{
    use Modele;

    private $id;
    private $nom;
    private $prenom;
    private $mail;
    private $date_creation;
    private $mot_de_passe;
    
    public function afficher($id)
    {
        if (!is_null($this->pdo)) {
            $stmt = $this->pdo->prepare('SELECT * FROM administrateur WHERE id = ?');
        }
        $element = null;
        if ($stmt->execute([$id])) {
            $element = $stmt->fetchObject('Administrateur',[$this->pdo]);
            if (!is_object($element)) {
                $element = null;
            }
        }
        $stmt->closeCursor();
        return $element;
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

    public function getDateCreation()
    {
        return $this->date_creation;
    }

    public function getMotDePasse()
    {
        return $this->mot_de_passe;
    }


}