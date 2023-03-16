<?php

require_once('modeles/Modele.php');
class Controleur {
     use Modele; 

    public function afficherMissions()
    {
        $universs = new Universs($this->pdo);
        $universs = $universs->lister();
        $pdo = $this->pdo;
        require_once('vues/liste-univers.php');
    }

    public function connexion() {
        require_once('vues/page-connexion.php');
    }

    public function deconnexion() {
        // Procédure de deconnexion
        $_SESSION['admin'] = 0;
        session_destroy();
        
        $this->afficherMissions();
    }

    public function verifConnexion($mail,$password) {
        $admin = new Administrateurs($this->pdo);
        $messageConnexion = "";
        if($admin->verifConnexion($mail,$password)) {
            $_SESSION['admin'] = 1;
            /* $this->afficherMissions(); */
            $this->accueil();
        } else {
            $_SESSION['admin'] = 0;
            $messageConnexion = "Identifiant ou mot de passe erroné(s).";
            require_once('vues/page-connexion.php');
        }
    }

    // ACCUEIL

    public function accueil()
    {
        $universs = new Universs($this->pdo);
        $universs = $universs->lister();
        $animals = new Animals($this->pdo);
        $animals = $animals->listerAnimal();
        $dates = new MyDates($this->pdo);
        $dates = $dates->listerDate();
        require_once('vues/accueil.php');
    }
    
    // UNIVERS - CRUD

    public function listerUnivers()
    {
        $universs = new Universs($this->pdo);
        $universs = $universs->lister();
        require_once('vues/liste-univers.php');
    }

    public function createUnivers($nom, $surnom)
    {
        $universs = new Universs($this->pdo);
        $universToCreate = $universs->create($nom, $surnom);
        $universs = $universs->lister();
        require_once('vues/liste-univers.php');
    }

    public function updateUnivers($id, $nom, $surnom)
    {
        $universs = new Universs($this->pdo);
        $universToUpdate = $universs->update($id, $nom, $surnom);
        $universs = $universs->lister();
        require_once('vues/liste-univers.php');
    }

    public function deleteUnivers($id,$nom)
    {
        $universs = new Universs($this->pdo);
        $universToDelete = $universs->delete($id, $nom);
        $universs = $universs->lister();
        require_once('vues/liste-univers.php');
    }


    // PARTENAIRE - CRUD

    public function listerPartenaire()
    {
        $partenaires = new Partenaires($this->pdo);
        $partenaires = $partenaires->lister();
        require_once('vues/liste-partenaire.php');
    }

    public function createPartenaire($nom, $univers)
    {
        $partenaires = new Partenaires($this->pdo);
        $partenaireToCreate = $partenaires->create($nom, $univers);
        $partenaires = $partenaires->lister();
        require_once('vues/liste-partenaire.php');
    }

    public function updatePartenaire($id, $nom, $univers)
    {
        $partenaires = new Partenaires($this->pdo);
        $partenaireToUpdate = $partenaires->update($id, $nom, $univers);
        $partenaires = $partenaires->lister();
        require_once('vues/liste-partenaire.php');
    }

    public function deletePartenaire($id,$nom)
    {
        $partenaires = new Partenaires($this->pdo);
        $partenaireToDelete = $partenaires->delete($id, $nom);
        $partenaires = $partenaires->lister();
        require_once('vues/liste-partenaire.php');
    }

// DATE - CRUD

public function listerDate()
{
    $dates = new MyDates($this->pdo);
    $dates = $dates->listerDate();
    require_once('vues/liste-date.php');
}

public function createDate($date)
{
    $dates = new MyDates($this->pdo);
    $dateToCreate = $dates->createDate($date);
    $dates = $dates->listerDate();
    require_once('vues/liste-date.php');
}

public function updateDate($id, $date)
{
    $dates = new MyDates($this->pdo);
    $dateToUpdate = $dates->updateDate($id, $date);
    $dates = $dates->listerDate();
    require_once('vues/liste-date.php');
}

public function deleteDate($id,$date)
{
    $dates = new MyDates($this->pdo);
    $dateToDelete = $dates->deleteDate($id, $date);
    $dates = $dates->listerDate();
    require_once('vues/liste-date.php');
}



// ADMINISTRATEUR - CRUD

    public function listerAdministrateurs()
    {
        $administrateurs = new Administrateurs($this->pdo);
        $administrateurs = $administrateurs->lister();
        require_once('vues/liste-administrateurs.php');
    }

    public function createAdministrateur($nom, $prenom, $mail, $mot_de_passe)
    {
        $administrateurs = new Administrateurs($this->pdo);
        $administrateurToCreate = $administrateurs->create($nom, $prenom, $mail, $mot_de_passe);
        $administrateurs = $administrateurs->lister();
        require_once('vues/liste-administrateurs.php');
    }

    public function updateAdministrateur($id,$nom, $prenom, $mail, $mot_de_passe)
    {
        $administrateurs = new Administrateurs($this->pdo);
        $administrateurToUpdate = $administrateurs->update($id,$nom, $prenom, $mail, $mot_de_passe);
        $administrateurs = $administrateurs->lister();
        require_once('vues/liste-administrateurs.php');
    }

    public function deleteAdministrateur($id,$nom,$prenom)
    {
        $administrateurs = new Administrateurs($this->pdo);
        $administrateurToDelete = $administrateurs->delete($id, $nom, $prenom);
        $administrateurs = $administrateurs->lister();
        require_once('vues/liste-administrateurs.php');
    }

}