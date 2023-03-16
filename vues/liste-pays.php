<?php
$titre = 'Liste des chasseurs';
ob_start();
?>
<div class="container">
  <div class="row">
    <div class="col-0 col-lg-1 col-xl-2">
    </div>
    <div class="col-12 col-lg-10 col-xl-8">

    <?php
        if(isset($paysToDelete)) {?>
        <div class="pays-deleted"><?= $paysToDelete ?></div>
        <?php
        }
    ?>

    <?php
        if(isset($paysToCreate)) {?>
        <div class="pays-created"><?= $paysToCreate ?></div>
        <?php
        }
    ?>

    <?php
        if(isset($paysToUpdate)) {?>
        <div class="pays-updated"><?= $paysToUpdate ?></div>
        <?php
        }
    ?>

<!--     <div class="mt-2">
        <a href="#form-create-pays" class="add-link">Ajouter un chasseur</a>
    </div> -->
    <div class="confidentiel my-5">
      Pour des raisons de confidentialit&eacute;, vous devez être connecté pour voir la liste des chasseurs.
    </div>

        <!-- ######################## DEBUT FORM AJOUT PAYS #################### -->
        
        <form method="post" action="index.php" id="form-create-pays" class="mt-3 rounded py-3 px-1 bg-info">
            <h4>Ajouter un chasseur</h4>    
            <div class="row">
                <!-- <div class="col-12 col-md-12"> -->
                <div class="form-group mb-2">
                    <!-- <label for="nom">Nom du pays</label> -->
                    <label for="nom">Nom de famille</label>
                    <input type="text" name="nom" class="form-control" maxlength="50" id="nom" placeholder="Saisissez le nom du chasseur">
                    <label for="prenom">Pr&eacute;nom</label>
                    <input type="text" name="prenom" class="form-control" maxlength="50" id="prenom" placeholder="Saisissez le prénom du chasseur">
                </div>
                <div class="form-group mb-2">
                <!-- <div class="col-12 col-md-4 mt-3 mt-md-0"> -->
                    <input type="hidden" name="action" id="action" value="createPays">
                    <input type="hidden" name="page" id="page" value="payss">
                    <button type="reset" class="btn btn-primary">Reset</button>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </div>
                <!-- <div class="col-0 col-md-2"></div> -->
            </div>
            </form>
        
        <!-- ******************** FIN FORM AJOUT PAYS************************* -->


    <div class="table-responsive" id="tableau-chasseurs">
        
        <table class="table table-striped table-bordered table-sm caption-top table-responsive-lg text-center">
            <caption class="text-center fs-3 text-primary">Liste des chasseurs (<?= count($payss) ?>)</caption>
            <thead class="table-dark">
                  <tr>
                      <th width="6%">N°</th>
                      <th width="27%">Nom</th>
                      <th width="27%">Pr&eacute;nom</th>
                      <th width="20%"></th>
                      <th width="20%"></th>
                    </tr>
                </thead>
              
                <tbody>
                    
                    <?php 
                        $cpt = 0;
                        foreach ($payss as $pays):
                        $cpt++;
                    ?>
                        <tr id="tr<?= $pays->getId() ?>">
                            <td>
                                <?= $cpt ?>
                            </td>
                            <td>
                                <?= $pays->getNom() ?>
                            </td>
                            <td>
                                <?= $pays->getPrenom() ?>
                            </td>
                            <td>
                                <!--<a href="pays.php?action=edit&id=--><?php //$pays->getId() ?><!--" class="link-secondary">-->
                                <button type="button" id="updatePays<?= $pays->getId() ?>" class="updatePays btn-primary" 
                                    onclick=displayUpdatePays(<?php echo $pays->getId().",'".str_replace(" ","&nbsp;",$pays->getNom())."','".str_replace(" ","&nbsp;",$pays->getPrenom())."'" ?>)
                                    >
                                    Modifier
                                </button>
                            </td>
                            <td>
                                <button type="submit" class="btn-primary" onclick=confirmeSuppressionPays(<?php echo $pays->getId().',"'.str_replace(" ","&nbsp;",$pays->getNom()).'"' ?>)>
                                    Supprimer
                                </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        
              </tbody>
            </table>
    </div>
        
<!-- Ancien emplacement du formulaire AJOUT PAYS/CHASSEUR -->
    <div class="mt-2">
        <a href="#form-create-pays" class="add-link">Ajouter un chasseur</a>
    </div>

    </div>
    <div class="col-0 col-lg-1 col-xl-2">
        </div>
    </div>
</div>



<?php
$contenu = ob_get_clean();
require_once('layout.php');