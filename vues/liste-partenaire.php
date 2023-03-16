<?php
$titre = 'Liste des partenaires';
ob_start();
?>
<div class="container">
  <div class="row">
    <div class="col-0 col-lg-1 col-xl-2">
    </div>
    <div class="col-12 col-lg-10 col-xl-8">

    <?php
        if(isset($partenaireToDelete)) {?>
        <div class="partenaire-deleted"><?= $partenaireToDelete ?></div>
        <?php
        }
    ?>

    <?php
        if(isset($partenaireToCreate)) {?>
        <div class="partenaire-created"><?= $partenaireToCreate ?></div>
        <?php
        }
    ?>

    <?php
        if(isset($partenaireToUpdate)) {?>
        <div class="partenaire-updated"><?= $partenaireToUpdate ?></div>
        <?php
        }
    ?>

<!--     <div class="mt-2">
        <a href="#form-create-animal" class="add-link">Ajouter un animal</a>
    </div> -->

        <!-- ######################## DEBUT FORM AJOUT PARTENAIRE #################### -->
        
        <form method="post" action="index.php" id="form-create-partenaire" class="mt-3 rounded py-3 px-1 bg-info">
            <h4>Ajouter un partenaire</h4>    
            <div class="row">
                <!-- <div class="col-12 col-md-12"> -->
                <div class="form-group mb-2">
                    <!-- <label for="nom">Nom du pays</label> -->
                    <!-- <label for="nom">Nom de famille</label> -->
                    <input type="text" name="nom" class="form-control" maxlength="40" id="nom" placeholder="Saisissez le nom du partenaire">
                </div>
                <div class="form-group mb-2">
                <!-- <div class="col-12 col-md-4 mt-3 mt-md-0"> -->
                    <input type="hidden" name="action" id="action" value="createPartenaire">
                    <input type="hidden" name="page" id="page" value="partenaires">
                    <button type="reset" class="btn btn-primary">Reset</button>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </div>
                <!-- <div class="col-0 col-md-2"></div> -->
            </div>
            </form>
        
        <!-- ******************** FIN FORM AJOUT PARTENAIRE ************************* -->


    <div class="table-responsive">
        
        <table class="table table-striped table-bordered table-sm caption-top table-responsive-lg text-center">
            <caption class="text-center fs-3 text-primary">Liste des partenaires</caption>
            <thead class="table-dark">
                  <tr>
                      <th width="10%">N°</th>
                      <th width="35%">Nom</th>
                      <th width="15%">Univers</th>
                      <th width="20%"></th>
                      <th width="20%"></th>
                    </tr>
                </thead>
              
                <tbody>
                    
                    <?php 
                        $cpt2 = 0;
                        foreach ($partenaires as $partenaire): 
                        $cpt2++;
                    ?>
                        <tr id="tr<?= $partenaire->getId() ?>">
                            <td>
                                <?= $cpt2 ?>
                            </td>
                            <td>
                                <?= $partenaire->getNom() ?>
                            </td>
                            <td>
                                <?= $partenaire->getUnivers() ?>
                            </td>
                            <td>
                                <!--<a href="pays.php?action=edit&id=--><?php //$pays->getId() ?><!--" class="link-secondary">-->
                                <button type="button" id="updatePartenaire<?= $partenaire->getId() ?>" class="updatePartenaire btn-primary" 
                                    onclick=displayUpdatePartenaire(<?php echo $partenaire->getId().",'"
                                    .str_replace(" ","&nbsp;",$partenaire->getNom())."','"
                                    .str_replace(" ","&nbsp;",$partenaire->getUnivers()).
                                    "'" ?>)
                                    >
                                    Modifier
                                </button>
                            </td>
                            <td>
                                <button type="submit" class="btn-primary" onclick=confirmeSuppressionPartenaire(<?php echo $partenaire->getId().',"'.str_replace(" ","&nbsp;",$partenaire->getNom()).'"' ?>)>
                                    Supprimer
                                </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        
              </tbody>
            </table>
    </div>
        
<!-- Ancien emplacement du formulaire AJOUT ANIMAL -->
    </div>
    <div class="col-0 col-lg-1 col-xl-2">
        </div>
    </div>
</div>



<?php
$contenu = ob_get_clean();
require_once('layout.php');