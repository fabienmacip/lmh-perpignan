<?php

$headers = array(

  'MIME-Version' => '1.0',
  'From' => $prenom. ' '.$nom.' <'.$mail.'>',
  'Reply-To' => ''.$mail,
  'Bcc' => $DESTINATAIRE_BCC.",".$mail,
  'Content-Type' => ' text/plain; charset="utf-8"; DelSp="Yes"; format=flowed ; ',
  'Content-Disposition' => ' inline',
  'Content-Transfer-Encoding' => ' 7bit',
  'X-Envelope-From' => ' <'.$mail.'>',
  'X-Mailer' => 'PHP/'.phpversion()

)