<?php
 
 require_once(dirname(__FILE__,2).'/modeles/ConnectMe.php');
 require_once(dirname(__FILE__,2).'/modeles/Modele.php');
 
 require_once(dirname(__FILE__).'/controleur.php');
 
 require_once(dirname(__FILE__,2).'/modeles/Prospect.php');
 require_once(dirname(__FILE__,2).'/modeles/Prospects.php');

 $controleur2 = new Controleur($pdo);

if (isset($_POST['nom'])) {
  
        
  $nom = $_POST['nom'] ?? '';
  $prenom = $_POST['prenom'] ?? '';
  $mail = $_POST['mail'] ?? '';
  $telephone = $_POST['telephone'] ?? '';
  
  $today = date("Y-m-d H:i:s");
  
  $reponse = $controleur2->createVisiteur($nom, $prenom, $mail, $telephone, $today);
  
  if($reponse > 0){
    $res["status"] = "200";
    $res["data"] = "Prospect ajouté avec succès";
    $res["prospectok"] = "true";
    $res["id"] = $reponse;
    $res["nom"] = $nom;
    $res["prenom"] = $prenom;
    $res["mail"] = $mail;
    $res["telephone"] = $telephone;
    $res["date"] = $today;
  }
  else {
    $res['status'] = "404";
    $res["data"] ="Erreur lors de l'ajout du prospect";
    $res["prospectok"] = "false";
  }
  echo json_encode($res);
          

          //ICI, AJOUTER fonction dans services/mailEngine.php pour createMail
          
        /* $dest = "fabien.macip@gmail.com"; */
/*         if($titre === "mustang") {
          $dest = "custhomeloc34@gmail.com";
          $sujet = "Demande information : LOCATION MUSTANG";
          $corps = "Message reçu depuis la page LOCATION MUSTANG du site MSR34\n";
    
        } else if ($alma === "alma") {
          $dest = "motorsservicerapide34@gmail.com";
          $sujet = "Demande information (ALMA - paiement en plusieurs fois) : ".trim($titre)." - ".trim($km)." km - ".trim($prix)." €.";
          $corp = "Message reçu depuis une annonce du site MSR34\nALMA - paiement en plusieurs fois\n";
          $corp .= trim($titre)." (".trim($couleur).") - ".trim($km)." km - ".trim($prix)." €.\n\n";
        } else {
          $dest = "motorsservicerapide34@gmail.com";
          $sujet = "Demande information : ".trim($titre)." (".trim($couleur).") - ".trim($km)." km - ".trim($prix)." €.";
          $corp = "Message reçu depuis une annonce du site MSR34\n";
          $corp .= trim($titre)." (".trim($couleur).") - ".trim($km)." km - ".trim($prix)." €.\n\n";
        }
        
        $corp .= "MAIL : ".$mail."\nTEL : ".$tel."\n\n";
        $corp .= "MESSAGE\n".$message."\n";
 */    
    /* ************************************** */
    /* ******** décommenter pour test ******* */
        /* $dest = "fabien.macip@gmail.com"; */
    /* ************************************** */
    
/*     $headers  = array(
    
      'MIME-Version' => '1.0',
      'From' => $mail2,
      'Reply-To' => ''.$mail2,
      'Bcc' => 'fabien.macip@gmail.com',
      'Content-Type' => ' text/plain; charset="utf-8"; DelSp="Yes"; format=flowed ; ',
      'Content-Disposition' => ' inline',
      'Content-Transfer-Encoding' => ' 7bit',
      'X-Envelope-From' => $mail2,
      'X-Mailer' => 'PHP/'.phpversion()
    );
 */    
    /* setcookie('dest', $dest, time()+60*60*24*30, '/');
    setcookie('sujet', $sujet, time()+60*60*24*30, '/');
    setcookie('corp', $corp, time()+60*60*24*30, '/');
    setcookie('headers', implode(',',$headers), time()+60*60*24*30, '/'); */
    //setcookie('coucou', 'new5', time()+60*60*24*30, '/'); 
    
//      $corp2 = htmlspecialchars($corp,ENT_QUOTES);
      //createShortMail($sujet, $corp2);
    
  //      if(mail($dest, $sujet, $corp, $headers)) {
           //setcookie('okmail', 'mail ok', time()+60*60*24*30, '/');
    //      $ok = "Email envoyé avec succès à ".$dest."...";
      //  } else {
          //setcookie('okmail', 'mail PAS ok', time()+60*60*24*30, '/');
        //  $ok = "Échec de l'envoi de l'email...";
        //}
     
    //setcookie('coucou2', 'apres mail', time()+60*60*24*30, '/');     
    

}
    
    
  
