<?php
$titre = 'Liste des administrateurs';
ob_start();
?>
<div class="container">
  <div class="row">
    <div class="col-0 col-lg-1">
    </div>
    <div class="col-12 col-lg-10">

    <?php
        if(isset($administrateurToDelete)) {?>
        <div class="administrateur-deleted"><?= $administrateurToDelete ?></div>
        <?php
        }
    ?>

    <?php
        if(isset($administrateurToCreate)) {?>
        <div class="administrateur-created"><?= $administrateurToCreate ?></div>
        <?php
        }
    ?>

    <?php
        if(isset($administrateurToUpdate)) {?>
        <div class="administrateur-updated"><?= $administrateurToUpdate ?></div>
        <?php
        }
    ?>

<!--     <div class="mt-2">
        <a href="#form-create-admin">Ajouter un administrateur</a>
    </div> -->

        <div class="table-responsive-md">
            
            <table class="table table-striped table-bordered table-sm caption-top table-responsive-lg text-center">
            <caption class="text-center fs-3 text-primary">Liste des administrateurs</caption>
                <thead class="table-dark">
                    <tr>
                        <th width="6%">Id</th>
                        <th width="20%">Nom</th>
                        <th width="20%">Pr&eacute;nom</th>
                        <th width="20%">Mail</th>
                        <th width="10%">Cr&eacute;&eacute; le</th>
                        <!-- <th width="15%">Mot de passe</th> -->
                        <th width="12%"></th>
                        <th width="12%"></th>
                    </tr>
                </thead>
                
                <tbody id="les-admins">
          
                    <?php foreach ($administrateurs as $administrateur): ?>
                      <tr id="tr<?= $administrateur->getId() ?>">
                            <td>
                                <?= $administrateur->getId() ?>
                            </td>
                            <td>
                                <?= $administrateur->getNom() ?>
                            </td>
                            <td>
                                <?= $administrateur->getPrenom() ?>
                            </td>
                            <td>
                                <?= $administrateur->getMail() ?>
                            </td>
                            <td>
                                <?= $administrateur->getDateCreation() ?>
                            </td>
                            <!-- <td> -->
                                <?php //$administrateur->getMotDePasse() ?>
                            <!-- </td> -->
                            <td>
                                <button type="button" id="updateAdministrateur<?= $administrateur->getId() ?>" class="updateAdministrateur btn-primary" 
                                onclick=displayUpdateAdministrateur(<?php echo $administrateur->getId().",'".str_replace(" ","&nbsp;",$administrateur->getNom())."','".str_replace(" ","&nbsp;",$administrateur->getPrenom())."','".str_replace(" ","&nbsp;",$administrateur->getMail())."'" ?>)
                                >
                                  Modifier
                                </button>
                            </td>
                            <td>
                                 <button type="button" class="btn-primary" 
                                         onclick=confirmeSuppressionAdministrateur(<?php echo $administrateur->getId().",'".str_replace(" ","&nbsp;",$administrateur->getNom())."','".str_replace(" ","&nbsp;",$administrateur->getPrenom())."'" ?>)>
                                   Supprimer
                                 </button>
                            </td>                      
                        </tr>
                    <?php endforeach; ?>
          
                </tbody>
            </table>
        </div>

<!-- ######################## DEBUT FORM AJOUT ADMINISTRATEUR #################### -->

<form method="post" action="index.php" id="form-create-admin" class="mt-3 rounded py-3 px-1 bg-info">
        <h4>Ajouter un administrateur</h4>    
        <div class="form-group mb-2">
            <label for="nom">Nom de famille</label>
            <input type="text" name="nom" maxlength="40" id="nom" placeholder="Nom de famille" class="form-control">
            <label for="prenom">Pr&eacute;nom</label>
            <input type="text" name="prenom" maxlength="30" id="prenom" placeholder="Prénom" class="form-control">
        </div>

        <div class="form-group mb-2">
            <label for="mail">Adresse mail</label>
            <input type="mail" name="mail" maxlength="50" id="mail" placeholder="Mail" class="form-control">
            <label for="mot_de_passe">Mot de passe</label>
            <input type="text" name="mot_de_passe" minlength="8" maxlength="40" id="mot_de_passe" placeholder="Mot de passe" class="form-control">        
        </div>

        <input type="hidden" name="action" id="action" value="create">
        <input type="hidden" name="page" id="page" value="administrateurs" >

        <div class="form-group mb-2">
            <button type="reset" class="btn btn-primary">Reset</button>
            <button type="submit"class="btn btn-primary">Envoyer</button>
        </div>
    </form>

<!-- ******************** FIN FORM AJOUT ADMINISTRATEUR ************************* -->


    </div>
    <div class="col-0 col-lg-1">
    </div>
  </div>
</div>


		
<?php
$contenu = ob_get_clean();
require_once('layout.php');