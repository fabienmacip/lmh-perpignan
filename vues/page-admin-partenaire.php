<?php
$titre = 'La Maison de l\'Habitat by La Centrale de Financement - Changer mon mot de passe';
ob_start();
?>
<div class="container">
  <div class="row">
    <div class="col-0 col-md-1">
    </div>
    <div class="col-12 col-md-10">

    <?php
        if(isset($partenaireAdminToUpdate)) {?>
        <div class="partenaire-updated"><?= $partenaireAdminToUpdate ?></div>
        <?php
        }
    ?>

<h2>Modifier mes données administratives et de connexion.</h2>


<!-- ######################## DEBUT FORM Modifier Mot de passe PARTENAIRE #################### -->

<form method="post" action="index.php" id="form-modif-admin-partenaire" class="mt-3 rounded py-3 px-1 bg-info">
        <h4>Modifier mes donn&eacute;es de connexion. </h4>    
        <div class="form-group mb-2">
            <label for="nom">Nom de famille</label>
            <input type="text" name="nom" maxlength="40" id="nom" placeholder="Nom de famille" class="form-control" value="<?= $administrateurs[0]->getNom() ?>">
            <label for="prenom">Pr&eacute;nom</label>
            <input type="text" name="prenom" maxlength="30" id="prenom" placeholder="Prénom" class="form-control" value="<?= $administrateurs[0]->getPrenom() ?>">
        </div>

        <div class="form-group mb-2">
            <label for="mail">Adresse mail</label>
            <input type="mail" name="mail" maxlength="50" id="mail" placeholder="Mail" class="form-control" value="<?= $administrateurs[0]->getMail() ?>">
            <label for="mot_de_passe">Mot de passe</label>
            <input type="text" name="mot_de_passe" minlength="8" maxlength="40" id="mot_de_passe" placeholder="Mot de passe" class="form-control">
            <span style="font-size: 0.7rem;">(laisser vide si vous ne souhaitez pas modifier le mot de passe)</span>        
        </div>

        <input type="hidden" name="idpartenaireadmintoupdate" id="idpartenaireadmintoupdate" value="<?= $administrateurs[0]->getId() ?>">
        <input type="hidden" name="action" id="action" value="update">
        <input type="hidden" name="page" id="page" value="admin-partenaire" >

        <div id="form-modif-admin-partenaire-btn" class="form-group mb-2">
            <button type="reset" class="btn btn-primary">Reset</button>
            <button type="submit"class="btn btn-primary">Envoyer</button>
        </div>
    </form>

<!-- ******************** FIN FORM Modifier Mot de passe PARTENAIRE ************************* -->




    </div>
    <div class="col-0 col-md-1">
        </div>
    </div>
</div>



<?php
$contenu = ob_get_clean();
require_once('layout.php');