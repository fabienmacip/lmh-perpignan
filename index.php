<?php
session_start();

////////////////////////////////////////////////////////////////
/* $pdo = null;

try {
    //$pdo = new PDO('mysql:host=localho6st;dbname=???;charset=utf8', 'root', '');
    $pdo = new PDO('mysql:host=91.216.107.1661;dbname=f_____b1___6_9____j;charset=utf8', 'f______1____6', '***');
    } catch (PDOException $e) {
        exit('Erreur : '.$e->getMessage());
    } */
require_once('modeles/ConnectMe.php');
//use ConnectMe;
////////////////////////////////////////////////////////////////

require_once('controleurs/controleur.php');
require_once('modeles/Modele.php');
require_once('modeles/Univers.php');
require_once('modeles/Universs.php');
require_once('modeles/Partenaire.php');
require_once('modeles/Partenaires.php');
require_once('modeles/MyDate.php');
require_once('modeles/MyDates.php');
require_once('modeles/Administrateur.php');
require_once('modeles/Administrateurs.php');

/* $LISTE_PAYS = "index.php?page=payss";
$LISTE_SPECIALITES = "index.php?page=specialites";
$LISTE_TYPE_MISSIONS = "index.php?page=typemissions";
$LISTE_PLANQUES = "index.php?page=planques";
$LISTE_PERSONNES = "index.php?page=personnes";
$LISTE_MISSIONS = "index.php?page=missions";
$LISTE_ADMINISTRATEURS = "index.php?page=administrateurs"; */

$controleur = new Controleur($pdo);

/* var_dump($_POST);
foreach($_POST as $key => $value) {
        $_POST[$key] = htmlspecialchars($value);
    echo "La clé ".$key." est ".$_POST[$key].PHP_EOL;
}
var_dump('AFTER');
var_dump($_POST); */

if(isset($_POST['action']) && 'connexion' === $_POST['action']) {
    $controleur->verifConnexion($_POST['mail'], $_POST['password']);
}

/* if(isset($_SESSION['admin']) && $_SESSION['admin'] === 1) {
    $connecte = true;
} else {
    $connecte = false;
} */


// Par défaut, index.php affiche la liste des missions (voir le dernier ELSE)
// Connexion / Déconnexion des admins
if(isset($_GET['page']) && 'connexion' === $_GET['page']) {
    $controleur->connexion();
} else if (isset($_GET['page']) && 'deconnexion' === $_GET['page']) {
    $controleur->deconnexion();

}// UNIVERS - CRUD
// UNIVERS - CREATE
elseif (isset($_POST['page']) && 'universs' === $_POST['page'] && isset($_POST['action']) && 'createUnivers' === $_POST['action'] && isset($_POST['nom']) && isset($_POST['surnom'])) {
    $controleur->createUnivers($_POST['nom'],$_POST['surnom']);
// UNIVERS - UPDATE
} elseif (isset($_POST['page']) && 'universs' === $_POST['page'] && isset($_POST['action']) && 'updateUnivers' === $_POST['action'] && isset($_POST['nom']) && isset($_POST['surnom'])) {
    $controleur->updateUnivers($_POST['idUniversToUpdate'],$_POST['nom'],$_POST['surnom']);
// UNIVERS - DELETE
} elseif (isset($_GET['page']) && 'universs' === $_GET['page'] && isset($_GET['action']) && 'delete' === $_GET['action'] && isset($_GET['id']) && isset($_GET['nom'])) {
    $controleur->deleteUnivers($_GET['id'],$_GET['nom']);
// UNIVERS - READ
} elseif (isset($_GET['page']) && 'universs' === $_GET['page'] && !isset($_GET['action'])) {
    $controleur->listerUnivers();
}

// PARTENAIRE - CRUD
// PARTENAIRE - CREATE
elseif (isset($_POST['page']) && 'partenaires' === $_POST['page'] && isset($_POST['action']) && 'createPartenaire' === $_POST['action'] && isset($_POST['nom'])) {
    $controleur->createPartenaire($_POST['nom'], $_POST['univers']);
// PARTENAIRE - UPDATE
} elseif (isset($_POST['page']) && 'partenaires' === $_POST['page'] && isset($_POST['action']) && 'updatePartenaire' === $_POST['action'] && isset($_POST['nom'])) {
    $controleur->updatePartenaire($_POST['idPartenaireToUpdate'],$_POST['nom'],$_POST['univers']);
// PARTENAIRE - DELETE
} elseif (isset($_GET['page']) && 'partenaires' === $_GET['page'] && isset($_GET['action']) && 'delete' === $_GET['action'] && isset($_GET['id']) && isset($_GET['nom'])) {
    $controleur->deletePartenaire($_GET['id'],$_GET['nom']);
// PARTENAIRE - READ
} elseif (isset($_GET['page']) && 'partenaires' === $_GET['page'] && !isset($_GET['action'])) {
    $controleur->listerPartenaire();
}

// DATE - CRUD
// DATE - CREATE
elseif (isset($_POST['page']) && 'dates' === $_POST['page'] && isset($_POST['action']) && 'createDate' === $_POST['action'] && isset($_POST['date'])) {
    $controleur->createDate($_POST['date']);
// DATE - UPDATE
} elseif (isset($_POST['page']) && 'dates' === $_POST['page'] && isset($_POST['action']) && 'updateDate' === $_POST['action'] && isset($_POST['date'])) {
    $controleur->updateDate($_POST['idDateToUpdate'],$_POST['date']);
//DATE - DELETE
} elseif (isset($_GET['page']) && 'dates' === $_GET['page'] && isset($_GET['action']) && 'delete' === $_GET['action'] && isset($_GET['id']) && isset($_GET['date'])) {
    $controleur->deleteDate($_GET['id'],$_GET['date']);
// DATE - READ
} elseif (isset($_GET['page']) && 'dates' === $_GET['page'] && !isset($_GET['action'])) {
    $controleur->listerDate();
}


// ADMINISTRATEURS - CRUD    
// ADMINISTRATEURS - CREATE
elseif (isset($_POST['page']) && 'administrateurs' === $_POST['page'] && isset($_POST['action']) && 'create' === $_POST['action'] 
            && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mail']) && isset($_POST['mot_de_passe'])) {
    $controleur->createAdministrateur($_POST['nom'],$_POST['prenom'],$_POST['mail'],$_POST['mot_de_passe']);
// ADMINISTRATEURS - UPDATE
} elseif (isset($_POST['page']) && 'administrateurs' === $_POST['page'] && isset($_POST['action']) && 'update' === $_POST['action'] && isset($_POST['nom']) && isset($_POST['prenom'])) {
    $controleur->updateAdministrateur($_POST['idAdministrateurToUpdate'],$_POST['nom'],$_POST['prenom'],$_POST['mail'],$_POST['mot_de_passe']);
// ADMINISTRATEURS - DELETE
} elseif (isset($_GET['page']) && 'administrateurs' === $_GET['page'] && isset($_GET['action']) && 'delete' === $_GET['action'] && isset($_GET['id']) && isset($_GET['nom']) && isset($_GET['prenom'])) {
    $controleur->deleteAdministrateur($_GET['id'],$_GET['nom'],$_GET['prenom']);
// ADMINISTRATEURS - READ
} elseif (isset($_GET['page']) && 'administrateurs' === $_GET['page']) {
    $controleur->listerAdministrateurs();
}
else {
    $controleur->accueil();
}

