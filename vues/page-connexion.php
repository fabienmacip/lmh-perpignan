<?php
////////////////////////////////////////////////////////////////
/* $pdo = null;

try {
    //$pdo = new PDO('mysql:host=localhost;dbname=spy;charset=utf8', 'root', '');
    $pdo = new PDO('mysql:host=91.216.107.161;dbname=fatab195806_9ectvj;charset=utf8', 'fatab195806', '!Angular20');
    } catch (PDOException $e) {
        exit('Erreur : '.$e->getMessage());
    } */


require_once('modeles/ConnectMe.php');

////////////////////////////////////////////////////////////////

$titre = 'La Maison de l\'Habitat by La Centrale de Financement - Liste des types de planques';
ob_start();
?>
 <!-- col-sm-10 col-md-6 col-xl-4  -->
<div class="mx-auto col-12 text-center">
  <?php 
  if(isset($messageConnexion) && $messageConnexion !== '') {?>
    <div class="text-danger"><?= $messageConnexion ?></div> 
  <?php 
  }
  ?>
  <h4 id="title-se-connecter">Se connecter</h4>    

  <form method="post" id="form-connexion" action="index.php" class="mt-3 py-4 bg-info box col-12 col-sm-10 col-md-6 col-xl-4 mx-auto">

    <div class="mb-3 col-10 mx-auto">
      <label for="mail" class="form-label">Login</label>
      <input type="email" name="mail" maxlength="50" id="mail" placeholder="Saisissez votre adresse mail" class="form-control">
      <span id="emailHelpInline" class="form-text">Adresse mail, maximum 50 caract&egrave;res.</span>
    </div>

    <div class="mb3 pb-4 col-10 mx-auto" id="connexion-pass">
      <label for="password" class="form-label">Mot de passe</label>
      <input type="password" name="password" minlength="8" maxlength="40" id="password" placeholder="Saisissez votre mot de passe" class="form-control">
      <i id="seepass" onclick="seepass()" class="fa-solid fa-eye"></i>
      <span id="passwordHelpInline" class="form-text">Entre 8 et 40 caract&egrave;res.</span>
    </div>

        <input type="hidden" name="action" id="action" value="connexion">
        <button type="reset" class="btn-connexion">Reset</button>
        <button type="submit" class="btn-connexion">Envoyer</button>

    </form>

</div>

<?php
$contenu = ob_get_clean();
require_once('layout.php');