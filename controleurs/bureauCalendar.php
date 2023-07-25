<?php
 
 require_once(dirname(__FILE__,2).'/modeles/ConnectMe.php');
 require_once(dirname(__FILE__,2).'/modeles/Modele.php');
 
 require_once(dirname(__FILE__).'/controleur4.php');
 
 require_once(dirname(__FILE__,2).'/modeles/Partenaire.php');
 require_once(dirname(__FILE__,2).'/modeles/Partenaires.php');
 require_once(dirname(__FILE__,2).'/modeles/BureauCalendar.php');
 require_once(dirname(__FILE__,2).'/modeles/BureauCalendars.php');

 //require_once(dirname(__FILE__,2).'/services/sendMail.php');

 $controleur4 = new Controleur4($pdo);

if(isset($_POST['action']) && 'add' === $_POST['action']) {
  
  $partenaireId = $_POST['partenaireId'] ?? '';
  $bureauId = $_POST['bureauId'] ?? '';
  $jour = $_POST['jour'] ?? '';
  $heure = $_POST['heure'] ?? '';

  if (isset($_POST['partenaireId']) && isset($_POST['bureauId'])) {
    
    $reponse = $controleur4->addCreneauHoraire($partenaireId,$bureauId,$jour,$heure);
    
    // ***********************************************************
    if($reponse){
      $res["status"] = "200";
      $res["data"] = "Créneau horaire réservé avec succès.";
      $res["requeteok"] = "true";
      //ici, mettre à jour le nombre d'heures restantes pour le partenaire
    }
    else {
      $res['status'] = "404";
      $res["data"] ="Erreur lors de la réservation du créneau horaire";
      $res["requeteok"] = "false";
    }
    echo json_encode($res);
    // ***********************************************************
    /* else {
      var_dump("ERREUR lors de la récupération des données PROSPECT et/ou PARTENAIRE.");
    } */
  
  }
}

if(isset($_POST['action']) && 'reloadRemaningHours' === $_POST['action']) {

  $reponse = $controleur4->reloadRemainingHours($_POST['partenaireId'],$_POST['partenaireDate']);
    
  // ***********************************************************
  if($reponse){
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
  
