<?php
$titre = 'Liste des univers';
ob_start();
?>
<div class="container">
  <div class="row">
    <div class="col-0 col-lg-1 col-xl-2">
    </div>
    <div class="col-12 col-lg-10 col-xl-8">

    <?php
        if(isset($universToDelete)) {?>
        <div class="univers-deleted"><?= $universToDelete ?></div>
        <?php
        }
    ?>

    <?php
        if(isset($universToCreate)) {?>
        <div class="univers-created"><?= $universToCreate ?></div>
        <?php
        }
    ?>

    <?php
        if(isset($universToUpdate)) {?>
        <div class="univers-updated"><?= $universToUpdate ?></div>
        <?php
        }
    ?>

<!--     <div class="mt-2">
        <a href="#form-create-pays" class="add-link">Ajouter un chasseur</a>
    </div> -->
    <div class="confidentiel my-5">
      Pour des raisons de confidentialit&eacute;, vous devez être connecté pour voir la liste des UNIVERS.
    </div>

        <!-- ######################## DEBUT FORM AJOUT UNIVERS #################### -->
        
        <form method="post" action="index.php" id="form-create-univers" class="mt-3 rounded py-3 px-1 bg-info">
            <h4>Ajouter un univers</h4>    
            <div class="row">
                <!-- <div class="col-12 col-md-12"> -->
                <div class="form-group mb-2">
                    <!-- <label for="nom">Nom du pays</label> -->
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" class="form-control" maxlength="40" id="nom" placeholder="Saisissez le nom de l'univers">
                    <label for="surnom">Surnom</label>
                    <input type="text" name="surnom" class="form-control" maxlength="40" id="surnom" placeholder="Saisissez le surnom de l'univers">
                </div>
                <div class="form-group mb-2">
                <!-- <div class="col-12 col-md-4 mt-3 mt-md-0"> -->
                    <input type="hidden" name="action" id="action" value="createUnivers">
                    <input type="hidden" name="page" id="page" value="universs">
                    <button type="reset" class="btn btn-primary">Reset</button>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </div>
                <!-- <div class="col-0 col-md-2"></div> -->
            </div>
            </form>
        
        <!-- ******************** FIN FORM AJOUT UNIVERS ************************* -->


    <div class="table-responsive" id="tableau-chasseurs">
        
        <table class="table table-striped table-bordered table-sm caption-top table-responsive-lg text-center">
            <caption class="text-center fs-3 text-primary">Liste des univers (<?= count($universs) ?>)</caption>
            <thead class="table-dark">
                  <tr>
                      <th width="6%">N°</th>
                      <th width="27%">Nom</th>
                      <th width="27%">Surnom</th>
                      <th width="20%"></th>
                      <th width="20%"></th>
                    </tr>
                </thead>
              
                <tbody>
                    
                    <?php 
                        $cpt = 0;
                        foreach ($universs as $univers):
                        $cpt++;
                    ?>
                        <tr id="tr<?= $univers->getId() ?>">
                            <td>
                                <?= $cpt ?>
                            </td>
                            <td>
                                <?= $univers->getNom() ?>
                            </td>
                            <td>
                                <?= $univers->getSurnom() ?>
                            </td>
                            <td>
                                <!--<a href="pays.php?action=edit&id=--><?php //$pays->getId() ?><!--" class="link-secondary">-->
                                <button type="button" id="updateUnivers<?= $univers->getId() ?>" class="updateUnivers btn-primary" 
                                    onclick=displayUpdateUnivers(<?php echo $univers->getId().",'".str_replace(" ","&nbsp;",$univers->getNom())."','".str_replace(" ","&nbsp;",$univers->getSurnom())."'" ?>)
                                    >
                                    Modifier
                                </button>
                            </td>
                            <td>
                                <button type="submit" class="btn-primary" onclick=confirmeSuppressionUnivers(<?php echo $univers->getId().',"'.str_replace(" ","&nbsp;",$univers->getNom()).'"' ?>)>
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
        <a href="#form-create-pays" class="add-link">Ajouter un univers</a>
    </div>

    </div>
    <div class="col-0 col-lg-1 col-xl-2">
        </div>
    </div>
</div>



<?php
$contenu = ob_get_clean();
require_once('layout.php');