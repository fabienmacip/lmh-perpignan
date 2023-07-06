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
        $_SESSION['role'] = 0;
        $_SESSION['partenaire'] = -1;
        $_SESSION['nom'] = "";
        $_SESSION['prenom'] = "";
        $_SESSION['role-libelle'] = '';
        $_SESSION['idadminpart'] = '';
        session_destroy();
        
        $this->accueil();
    }

    public function verifConnexion($mail,$password) {
        $admin = new Administrateurs($this->pdo);
        $messageConnexion = "";
        //if($admin->verifConnexion($mail,$password)) {
            if($admin->verifConnexion($mail,$password) > 0) {
            //$_SESSION['admin'] = 1;
            /* $this->afficherMissions(); */
            $this->accueil();
        } else {
            session_destroy();
            $messageConnexion = "Identifiant ou mot de passe erroné(s).";
            require_once('vues/page-connexion.php');
        }
    }

    // ACCUEIL

    public function accueil($backToUnivers = 0)
    {
        $universs = new Universs($this->pdo);
        $universs = $universs->lister();
        $partenaires = new Partenaires($this->pdo);
        $partenaires = $partenaires->lister();
        /* $dates = new MyDates($this->pdo);
        $dates = $dates->listerDate(); */
        $backToUnivers = $backToUnivers;
        require_once('vues/accueil.php');
    }
    
    public function pageUnivers($univId, $backToUnivers = 0)
    {
        $universs = new Universs($this->pdo);
        $universs = $universs->lister();
        $partenaires = new Partenaires($this->pdo);
        $partenaires = $partenaires->lister();

        $univToDisplay = $univId;

        $universEnfants = new UniversEnfants($this->pdo);
        $universEnfants = $universEnfants->listerFromUnivers($univToDisplay);

        /* $dates = new MyDates($this->pdo);
        $dates = $dates->listerDate(); */
        $backToUnivers = $backToUnivers;
        require_once('vues/page-univers.php');
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

    public function listerPartenaire($actif = 1)
    {
        $partenaires = new Partenaires($this->pdo);
        $partenaires = $partenaires->lister($actif);
        $universs = new Universs($this->pdo);
        $universs = $universs ->listerOrderById();
        require_once('vues/liste-partenaire.php');
    }

    public function createPartenaire($nom, $univers, $actif, $mail, $telephone)
    {
        $partenaires = new Partenaires($this->pdo);
        $partenaireToCreate = $partenaires->create($nom, $univers, $actif, $mail, $telephone);
        $partenaires = $partenaires->lister();
        $universs = new Universs($this->pdo);
        $universs = $universs ->listerOrderById();
        require_once('vues/liste-partenaire.php');
    }

    public function updatePartenaire($id, $nom, $univers, $mail, $telephone, $actif = '')
    {
        $partenaires = new Partenaires($this->pdo);
        $partenaireToUpdate = $partenaires->update($id, $nom, $univers, $mail, $telephone, $actif);
        $partenaires = $partenaires->lister();
        $universs = new Universs($this->pdo);
        $universs = $universs ->listerOrderById();
        require_once('vues/liste-partenaire.php');
    }

    public function deletePartenaire($id,$nom)
    {
        $partenaires = new Partenaires($this->pdo);
        $partenaireToDelete = $partenaires->delete($id, $nom);
        $partenaires = $partenaires->lister();
        $universs = new Universs($this->pdo);
        $universs = $universs ->listerOrderById();
        require_once('vues/liste-partenaire.php');
    }

    public function toggleActifPartenaire($id,$nom,$actif)
    {
        $partenairesToggle = new Partenaires($this->pdo);
        $partenairesToggle = $partenairesToggle->toggleActif($id,$nom,$actif);
        //$actif = intval($actif);
        $partenaires = new Partenaires($this->pdo);
        $partenaires = $partenaires->lister($actif);
        $universs = new Universs($this->pdo);
        $universs = $universs ->listerOrderById();
        require_once('vues/liste-partenaire.php');
    }

// PAGE D'UN PARTENAIRE

public function affichePartenaire($id, $univers)
{
    $statPartenaire = new StatPartenaires($this->pdo);
    $statPartenaireToCreate = $statPartenaire->create(intval($id));

    $partenaire = new Partenaire($this->pdo);
    $partenaire = $partenaire->afficher($id);
    $univers = $univers;
    require_once('vues/detail-partenaire.php');   
}

// DEVENIR PARTENAIRE
public function devenirPartenaire()
{
    require_once('vues/devenir-partenaire.php');
}

public function devenirPartenaireCreation($nom, $univers, $actif, $mail, $telephone){
    $partenaires = new Partenaires($this->pdo);
    $partenaireToCreate = $partenaires->create($nom, $univers, $actif, $mail, $telephone);
    require_once('vues/devenir-partenaire.php');
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

// RESERVER

public function pageReserver()
{
    require_once('vues/page-reserver.php');
}

// MOT de PASSE PARTENAIRE
public function pageAdminPartenaire($id)
{
    $administrateurs = new Administrateurs($this->pdo);
    $administrateurs = $administrateurs->listerId($id);
    require_once('vues/page-admin-partenaire.php');
}

// PARTENAIRE - Partie Admin (directement modifiée par le partenaire lui-même)
public function updateAdminPartenaire($id,$nom, $prenom, $mail, $mot_de_passe)
{
    $administrateurs = new Administrateurs($this->pdo);
    $partenaireAdminToUpdate = $administrateurs->update($id,$nom, $prenom, $mail, $mot_de_passe);
    $administrateurs = $administrateurs->listerId($id);
    $_SESSION['prenom'] = $prenom;
    $_SESSION['nom'] = $nom;
    $_SESSION['mail'] = $mail;
    require_once('vues/page-admin-partenaire.php');
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

// STATS
    public function pageStats()
    {
        $statPartenaires = new StatPartenaires($this->pdo);
        $statPartenaires = $statPartenaires->listerTout();

        require_once('vues/page-stats.php');
    }

}