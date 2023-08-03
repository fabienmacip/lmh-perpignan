<?php
 
session_start();

 require_once(dirname(__FILE__,2).'/modeles/ConnectMe.php');
 require_once(dirname(__FILE__,2).'/modeles/Modele.php');
 
 require_once(dirname(__FILE__).'/controleur4.php');
 
 require_once(dirname(__FILE__,2).'/modeles/Partenaire.php');
 require_once(dirname(__FILE__,2).'/modeles/Partenaires.php');
 require_once(dirname(__FILE__,2).'/modeles/Bureau.php');
 require_once(dirname(__FILE__,2).'/modeles/BureauCalendar.php');
 require_once(dirname(__FILE__,2).'/modeles/BureauCalendars.php');

 //require_once(dirname(__FILE__,2).'/services/sendMail.php');

 $controleur4 = new Controleur4($pdo);

if(isset($_POST['action']) && ('add' === $_POST['action'] || 'remove' === $_POST['action'])) {
  
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

    function moisFrancais($mois = "01"){
      $moisEnFrancais = "Janvier";
      switch($mois){
          case "01": $moisEnFrancais = "Janvier";
                      break;
          case "02": $moisEnFrancais = "F&eacute;vrier";
                      break;
          case "03": $moisEnFrancais = "Mars";
                      break;
          case "04": $moisEnFrancais = "Avril";
                      break;
          case "05": $moisEnFrancais = "Mai";
                      break;
          case "06": $moisEnFrancais = "Juin";
                      break;
          case "07": $moisEnFrancais = "Juillet";
                      break;
          case "08": $moisEnFrancais = "Ao&ucirc;t";
                      break;
          case "09": $moisEnFrancais = "Septembre";
                      break;
          case "10": $moisEnFrancais = "Octobre";
                      break;
          case "11": $moisEnFrancais = "Novembre";
                      break;
          case "12": $moisEnFrancais = "D&eacute;cembre";
                      break;
          default: $moisEnFrancais = "Janvier";
                      break;
      }
      return $moisEnFrancais;
      }

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

    require_once(dirname(__FILE__,2).'/vues/BureauCalendar.php');

    //echo $container;


}