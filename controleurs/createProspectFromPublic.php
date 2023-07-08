<?php
    // Création prospect directement par un visiteur
/*     public function createProspectFromPublic($nom, $prenom, $mail, $telephone)
    {
        $prospects = new Prospects($this->pdo);
        $prospectToCreate = $prospects->create($nom, $prenom, $mail, $telephone);
        $prospects = $prospects->lister();

    }
 */

 require_once('../modeles/Modele.php');
 //use Modele; 
require_once('../modeles/Prospect.php');
require_once('../modeles/Prospects.php');




// include_once dirname(__FILE__) . '/../services/shortMailEngine.php';

if (isset($_POST['nom'])) {
  
        // Cette fonction sert à nettoyer et enregistrer un texte
        function cleanText($text,$br = true)
        {
          $text = htmlspecialchars(trim($text), ENT_QUOTES);
            $text = stripslashes($text);
            if($br){
              $text = nl2br($text);
            }
            return $text;
          }
          
          $nom = $_POST['nom'] ?? '';
          $prenom = $_POST['prenom'] ?? '';
          $mail = $_POST['mail'] ?? '';
          $telephone = $_POST['telephone'] ?? '';
          
          
          
          $today = date("Y-m-d");


          
          
          $pdo2 = new PDO('mysql:host=localhost;dbname=lmhperpignan;charset=utf8', 'root', '');
          
          

          $prospects = new Prospects($pdo2);
          $prospectToCreate = $prospects->create($nom, $prenom, $mail, $telephone, $today);
          $prospects = $prospects->lister();
          //require_once('vues/liste-prospect.p
          
          /*          global $con;
          */     
          
          /*             $query = "insert into prospect(nom, prenom, mail, telephone) values('$nom','$prenom','$mail','$telephone')";
          mysqli_query($con, $query);
          return true;
          */







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
    
        $res["status"] = 200;
        $res["data"] = "Vous avez bien été enregistré";
        echo json_encode($res);
    
    } else {
        $res['status'] = 404;
        echo json_encode($res);
    }
    
    
  
