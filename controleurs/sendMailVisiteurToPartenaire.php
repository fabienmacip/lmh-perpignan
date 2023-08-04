<?php
 
 require_once(dirname(__FILE__,2).'/modeles/ConnectMe.php');
 require_once(dirname(__FILE__,2).'/modeles/Modele.php');
 
 require_once(dirname(__FILE__).'/controleur.php');
 
 require_once(dirname(__FILE__,2).'/modeles/Prospect.php');
 require_once(dirname(__FILE__,2).'/modeles/Prospects.php');
 require_once(dirname(__FILE__,2).'/modeles/Partenaire.php');
 require_once(dirname(__FILE__,2).'/modeles/Partenaires.php');

 require_once(dirname(__FILE__,2).'/services/sendMail.php');

 $controleur3 = new Controleur($pdo);

if (isset($_POST['partenaireId']) && isset($_POST['visiteurId'])) {
  
        
  $partenaireId = $_POST['partenaireId'] ?? '';
  $prospectId = $_POST['visiteurId'] ?? '';
  
  $today = date("Y-m-d H:i:s");
  
  // On récupère les données du PROSPECT et le Nom + Mail du PARTENAIRE à contacter
  $reponseProspect = $controleur3->readOneProspect($prospectId)[0];
  $reponsePartenaire = $controleur3->readOnePartenaire($partenaireId)[0];
  
/*   var_dump($reponseProspect);
  var_dump($reponseProspect->getNom());
  var_dump($reponsePartenaire);
  var_dump($reponsePartenaire->getMail());
 */

  // Quand on a récupéré les données, on "fabrique" le mail à envoyer au PARTENAIRE
  if(isset($reponseProspect) && '' != $reponseProspect->getId() && isset($reponsePartenaire) && '' != $reponsePartenaire->getId()) {
    
    $objectToUse["nomProspect"] = $reponseProspect->getNom();
    $objectToUse["prenomProspect"] = $reponseProspect->getPrenom();
    $objectToUse["mailProspect"] = $reponseProspect->getMail();
    $objectToUse["telProspect"] = $reponseProspect->getTelephone();

    $objectToUse["nomPartenaire"] = $reponsePartenaire->getNom();
    $objectToUse["mailPartenaire"] = $reponsePartenaire->getMail();
    
    $objectToUse["sujet"] = 'Demande de mise en relation d\'un prospect via le site LA-REFERENCE.fr, pour le partenaire '.strtoupper($objectToUse["nomPartenaire"]).'.';
    $objectToUse["corps"] = 'Bonjour,<br/><br/>voici une demande de mise en relation en provenance du site 
                             LA REFERENCE :<br/>
                             NOM : '.$reponseProspect->getNom().'<br/>
                             PRENOM : '.$reponseProspect->getPrenom().'<br/>
                             MAIL : '.$reponseProspect->getMail().'<br/>
                             TELEPHONE : '.$reponseProspect->getTelephone().'<br/>';

    $reponse = sendMail($objectToUse);


    // ***********************************************************
    if($reponse){
      $res["status"] = "200";
      $res["data"] = "Mise en relation envoyée avec succès. Notre partenaire vous recontactera dans les meilleurs délais.";
      $res["requeteok"] = "true";
      $res["partenairenom"] = $objectToUse["nomPartenaire"];
    }
    else {
      $res['status'] = "404";
      $res["data"] ="Erreur lors de la mise en relation";
      $res["requeteok"] = "false";
    }
    echo json_encode($res);
    // ***********************************************************
  } else {
    var_dump("ERREUR lors de la récupération des données PROSPECT et/ou PARTENAIRE.");
  }

}
    
    
  
