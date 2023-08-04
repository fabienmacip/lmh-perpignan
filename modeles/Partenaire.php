<?php

class Partenaire
{
    use Modele;

    private $id;
    private $nom;
    private $nomcontact;
    private $activiteentreprise;
    private $mail;
    private $telephone;
    private $univers;
    private $universenfant;
    private $image;
    private $description;
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

    public function getNomContact() 
    {
        return $this->nomcontact;
    }

    public function getActiviteEntreprise()
    {
        return $this->activiteentreprise;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function getTelephone()
    {
        return $this->telephone;
    }

    public function getUnivers()
    {
        return $this->univers;
    }

    public function getUniversArray(){
        return explode(",",$this->univers);
    }

    public function getUniversEnfant()
    {
        return $this->universenfant;
    }

    public function getUniversEnfantArray(){
        return explode(",",$this->universenfant);
    }

    public function getImage(){
        return $this->image;
    }

    public function getDescription(){
        return $this->description;
    }
    
    public function getDescriptionBreve(){
        return "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias id qui architecto repudiandae...";
        //return $this->description;
    }

    public function getActif()
    {
        return $this->actif;
    }


    public function getPolice() {
        return $this->actif == 0 ? "police-blanche" : "";
    }



}