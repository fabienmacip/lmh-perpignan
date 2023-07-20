<?php 
// -------------------------------------------------
// ATTENTION !!! Utiliser la bonne adresse FROM pour
// que le serveur LWS envoie bien le mail.
// Ici : mail_php@pcf-lcf.fr
// -------------------------------------------------

function sendMail($objectToUse) {
  
  //var_dump($objectToUse);

  //$objectToUse["nomProspect"];
  //$objectToUse["prenomProspect"];
  //$objectToUse["mailProspect"];
  //$objectToUse["telProspect"];

  //$objectToUse["nomPartenaire"];
  //$objectToUse["mailPartenaire"];

  //$objectToUse["sujet"];
  //$objectToUse["corps"];

  $dest = $objectToUse["mailPartenaire"];
  $sujet = $objectToUse["sujet"];
  $corps = $objectToUse["corps"];

  /* ************************************** */
  /* ******** décommenter pour test ******* */
      /* $dest = "fabien.macip@gmail.com"; */
  /* ************************************** */

  $mail2 = $objectToUse["mailProspect"];
  
  //Mail3 = copie cachée
  $mail3 = 'fabien.macip@gmail.com';
  $mail4 = 'richard.durin@neuf.fr';
  //$mail4 = 'fatabien@gmail.com';

  
  ini_set( 'display_errors', 1);
  //@ini_set('sendmail_from',$mail2);
  error_reporting( E_ALL );

  $fromOK = 'mail_php@pcf-lcf.fr';
  //$fromOK = $objectToUse["prenomProspect"].' '.$objectToUse["nomProspect"].' <'.$mail2.'>';


  $headers  = array(
    
    'MIME-Version' => '1.0',
    'From' => $fromOK,
    'Reply-To' => ''.$mail2,
    'Bcc' => $mail3.','.$mail4,
    'Content-Type' => ' text/html; charset="charset=utf-8"; DelSp="Yes"; format=flowed ; ',
    'Content-Disposition' => ' inline',
    'Content-Transfer-Encoding' => ' 7bit',
    'X-Envelope-From' => ' <'.$mail2.'>',
    'X-Priority' => '3',
    'X-MSMail-Priority' => 'Normal',
    'X-Unsent' => '1',
    'X-Originating-IP' => '[0.0.0.0]',
    'X-Mailer' => 'PHP/'.phpversion()
  );
  
  //'Content-Type' => ' text/plain; charset="utf-8"; DelSp="Yes"; format=flowed ; ',
  //'Content-transfer-encoding' => 'base64',
  
  // Si on souhaite garder une trace en BDD
  // $corps2 = htmlspecialchars($corps,ENT_QUOTES);
  // registerMailProspectToPartenaire($sujet, $corps2);

  //if(mail($dest, $sujet, chunk_split(base64_encode($corps)), $headers)) {
  if(mail($dest, $sujet, $corps, $headers)) {     
    //var_dump($headers);
    setcookie('okmail', 'mail ok', time()+60*60*24*30, '/');
    return true;
  } else {
    setcookie('okmail', 'mail PAS ok', time()+60*60*24*30, '/');
    return false;
  }


}

function registerMailProspectToPartenaire($sujet, $message)
{
    global $con;

    $today = date("Y-m-d");

    $query = "insert into mailprospecttopartenaire(date, sujet, message) values('$today','$sujet','$message')";
    mysqli_query($con, $query);
    return true;
}

?>