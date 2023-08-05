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
    private $partenaire;
    private $isadmin; // si NOT isAdmin, alors c'est un "partenaire"
    
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

    public function getPartenaire()
    {
        return $this->partenaire;
    }

    public function getIsAdmin() 
    {
        return $this->isadmin;
    }

    // ROLES 
    // 1 : Admin
    // 2: Partenaire
    // SUPERADMIN : Role 1 + IdAdmin 1
    public function getRole()
    {
        $role = 0;
        if($this->getIsAdmin() == 1) {
            $role = 1; //admin
        } else {
            $role = 2; //partenaire
        }
        return $role;
    }
}