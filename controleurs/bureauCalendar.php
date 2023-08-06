<?php
 
session_start();

 require_once(dirname(__FILE__,2).'/modeles/ConnectMe.php');
 require_once(dirname(__FILE__,2).'/modeles/Modele.php');
 
 require_once(dirname(__FILE__).'/controleur4.php');
 
 require_once(dirname(__FILE__,2).'/modeles/Partenaire.php');
 require_once(dirname(__FILE__,2).'/modeles/Partenaires.php');
 require_once(dirname(__FILE__,2).'/modeles/Bureau.php');
 require_once(dirname(__FILE__,2).'/modeles/Bureaus.php');
 require_once(dirname(__FILE__,2).'/modeles/BureauCalendar.php');
 require_once(dirname(__FILE__,2).'/modeles/BureauCalendars.php');

 //require_once(dirname(__FILE__,2).'/services/sendMail.php');

 $controleur4 = new Controleur4($pdo);

if(!isset($_POST['admin']) && isset($_POST['action']) && ('add' === $_POST['action'] || 'remove' === $_POST['action'])) {
  
  $partenaireId = $_POST['partenaireId'] ?? '';
  $bureauId = $_POST['bureauId'] ?? '';
  $jour = $_POST['jour'] ?? '';
  $heure = $_POST['heure'] ?? '';
  $action = $_POST['action'] ?? '';

  if (isset($_POST['partenaireId']) && isset($_POST['bureauId'])) {
    if($action === 'add'){

      $reponse = $controleur4->addCreneauHoraire($partenaireId,$bureauId,$jour,$heure);
      
      if($reponse){
        $res["status"] = "200";
        $res["data"] = "Créneau horaire réservé avec succès.";
        $res["requeteok"] = "true";
      }
      else {
        $res['status'] = "404";
        $res["data"] ="Erreur lors de la réservation du créneau horaire";
        $res["requeteok"] = "false";
      }

    } elseif($action === 'remove') {

      $reponse = $controleur4->removeCreneauHoraire($partenaireId,$bureauId,$jour,$heure);
      
      if($reponse){
        $res["status"] = "200";
        $res["data"] = "Créneau horaire supprimé avec succès.";
        $res["requeteok"] = "true";
      }
      else {
        $res['status'] = "404";
        $res["data"] ="Erreur lors de la suppression du créneau horaire";
        $res["requeteok"] = "false";
      }
    }

    $res["heures-restantes"] = $controleur4->reloadRemainingHours($partenaireId,$jour);

    echo json_encode($res);

    /* else {
      var_dump("ERREUR lors de la récupération des données PROSPECT et/ou PARTENAIRE.");
    } */
  
  }
}

if(isset($_POST['action']) && 'reloadRemaningHours' === $_POST['action'] && isset($_POST['day'])) {

  $reponse = $controleur4->reloadRemainingHours($_POST['partenaireId'],$_POST['day']);
    
  // ***********************************************************
  if($reponse || $reponse === 0){
    $res["status"] = "200";
    $res["data"] = "reload ok";
    $res["requeteok"] = "true";
    $res["remainingHours"] = $reponse;//ici, mettre à jour le nombre d'heures restantes pour le partenaire
  }
  else {
    $res['status'] = "404";
    $res["data"] ="Erreur lors du reload";
    $res["requeteok"] = "false";
  }
  echo json_encode($res);
   
}
  
if(isset($_GET['moisan']) && isset($_GET['id']) && isset($_GET['action']) && 'display-bureau-next-month' === $_GET['action']) {
  //$container = '<div>Coucou les gens</div><div>Coucou les gens 2</div><div>Coucou les gens 3</div><div>'.$_GET['moisan'].' - '.$_GET['id'].' - '.$_GET['action'].'</div>';
  
  $id = intval($_GET['id']);
  $moisan = $_GET['moisan'];

  $container = '';
  
  $bureau = $controleur4->getBureauById($id);
  

// Idem que dans vues/page-reserver.php
      require_once(dirname(__FILE__,2).'/services/functionMoisFrancais.php');

      $currentMonth = substr($moisan, 4, 2);
      //$currentDay = date("d");
      $currentYear = substr($moisan, 0, 4);
      
      $premierjourdumois = $currentYear."-".$currentMonth."-01";
      $premierjourdumois = strtotime($premierjourdumois);
      $firstDayOfCurrentMonth = date('w',$premierjourdumois); 

      $numberOfDaysOfCurrentMonth = date("t");

      $moisFrancais = moisFrancais($currentMonth);

// FIN idem que dans vues/page-reserver.php

    $calendarsObject = $controleur4->getMonthFromBureau($currentYear, $currentMonth, $id);
    $calendars = $calendarsObject->readAllForOneBureau($currentYear, $currentMonth, $id);    

    if(isset($_SESSION['partenaireActuel']) && $_SESSION['partenaireActuel'] != ''){
      require_once(dirname(__FILE__,2).'/vues/bureauCalendar-admin.php');
    } else {
      require_once(dirname(__FILE__,2).'/vues/bureauCalendar.php');
    }


    //echo $container;


}

/* ************** PARTIE CALENDAR ADMIN ***************** */

if(isset($_GET['page']) && 'reserveradmin' === $_GET['page'] && isset($_GET['idpartenaire'])) {
  $_SESSION['partenaireActuel'] = $_GET['idpartenaire'];
  $_SESSION['partenaireActuelNom'] = $_GET['namepartenaire'];
  $controleur4->listeCalendarsAdmin($_GET['idpartenaire']);
}

// Mise à jour d'un créneau horaire
if(isset($_POST['admin']) && 'yes' === $_POST['admin'] && isset($_POST['action']) && ('add' === $_POST['action'] || 'remove' === $_POST['action'])) {
  
  $partenaireId = $_POST['partenaireId'] ?? '';
  $bureauId = $_POST['bureauId'] ?? '';
  $jour = $_POST['jour'] ?? '';
  $heure = $_POST['heure'] ?? '';
  $action = $_POST['action'] ?? '';
  $isHeureSup = 1;

  if (isset($_POST['partenaireId']) && isset($_POST['bureauId'])) {
    if($action === 'add'){

      $reponse = $controleur4->addCreneauHoraire($partenaireId,$bureauId,$jour,$heure,$isHeureSup);
      
      if($reponse){
        $res["status"] = "200";
        $res["data"] = "Créneau horaire réservé avec succès.";
        $res["requeteok"] = "true";
      }
      else {
        $res['status'] = "404";
        $res["data"] ="Erreur lors de la réservation du créneau horaire";
        $res["requeteok"] = "false";
      }

    } elseif($action === 'remove') {

      $reponse = $controleur4->removeCreneauHoraire($partenaireId,$bureauId,$jour,$heure);
      
      if($reponse){
        $res["status"] = "200";
        $res["data"] = "Créneau horaire supprimé avec succès.";
        $res["requeteok"] = "true";
      }
      else {
        $res['status'] = "404";
        $res["data"] ="Erreur lors de la suppression du créneau horaire";
        $res["requeteok"] = "false";
      }
    }

    //$res["heures-restantes"] = $controleur4->reloadRemainingHours($partenaireId,$jour);

    echo json_encode($res);

    /* else {
      var_dump("ERREUR lors de la récupération des données PROSPECT et/ou PARTENAIRE.");
    } */
  
  }
}