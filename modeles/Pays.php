<?php

class Pays
{
    use Modele;

    private $id;
    private $nom;
    private $prenom;

    public function afficherPays($id)
    {
        if (!is_null($this->pdo)) {
            $stmt = $this->pdo->prepare('SELECT * FROM chasseurs WHERE id = ?');
        }
        $pays = null;
        if ($stmt->execute([$id])) {
            $pays = $stmt->fetchObject('Pays',[$this->pdo]);
            if (!is_object($pays)) {
                $pays = null;
            }
        }
        $stmt->closeCursor();
        return $pays;
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


}