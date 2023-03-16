<?php
$titre = 'Liste des dates';
ob_start();
?>
<div class="container">
  <div class="row">
    <div class="col-0 col-lg-1 col-xl-2">
    </div>
    <div class="col-12 col-lg-10 col-xl-8">

    <?php
        if(isset($dateToDelete)) {?>
        <div class="date-deleted"><?= $dateToDelete ?></div>
        <?php
        }
    ?>

    <?php
        if(isset($dateToCreate)) {?>
        <div class="date-created"><?= $dateToCreate ?></div>
        <?php
        }
    ?>

    <?php
        if(isset($dateToUpdate)) {?>
        <div class="date-updated"><?= $dateToUpdate ?></div>
        <?php
        }
    ?>

<!--     <div class="mt-2">
        <a href="#form-create-date" class="add-link">Ajouter une date</a>
    </div> -->

        <!-- ######################## DEBUT FORM AJOUT DATE #################### -->
        
        <form method="post" action="index.php" id="form-create-date" class="mt-3 rounded py-3 px-1 bg-info">
            <h4>Ajouter une date</h4>    
            <div class="row">
                <!-- <div class="col-12 col-md-12"> -->
                <div class="form-group mb-2">
                    <!-- <label for="nom">Nom du pays</label> -->
                    <!-- <label for="nom">Nom de famille</label> -->
                    <input type="date" name="date" class="form-control" maxlength="50" id="date" min="2023-01-01" max="2050-12-31" placeholder="Saisissez la date">
                </div>
                <div class="form-group mb-2">
                <!-- <div class="col-12 col-md-4 mt-3 mt-md-0"> -->
                    <input type="hidden" name="action" id="action" value="createDate">
                    <input type="hidden" name="page" id="page" value="dates">
                    <button type="reset" class="btn btn-primary">Reset</button>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </div>
                <!-- <div class="col-0 col-md-2"></div> -->
            </div>
            </form>
        
        <!-- ******************** FIN FORM AJOUT DATE ************************* -->


    <div class="table-responsive">
        
        <table class="table table-striped table-bordered table-sm caption-top table-responsive-lg text-center">
            <caption class="text-center fs-3 text-primary">Liste des dates</caption>
            <thead class="table-dark">
                  <tr>
                      <th width="10%">N°</th>
                      <th width="50%">Date</th>
                      <th width="20%"></th>
                      <th width="20%"></th>
                    </tr>
                </thead>
              
                <tbody>
                    
                    <?php
                     $cpt1 = 0;
                     foreach ($dates as $date): 
                     $cpt1++;
                    ?>
                        <tr id="tr<?= $date->getId() ?>">
                            <td>
                                <?= $cpt1 ?>
                            </td>
                            <td>
                                <?= $date->getDateLong() ?>
                                <!-- strftime("%a %d %b %G",strtotime($date->getDate())) -->
                            </td>
                            <td>
                                <!--<a href="pays.php?action=edit&id=--><?php //$pays->getId() ?><!--" class="link-secondary">-->
                                <button type="button" id="updateDate<?= $date->getId() ?>" class="updateDate btn-primary" 
                                    onclick=displayUpdateDate(<?php echo $date->getId().",'".str_replace(" ","&nbsp;",$date->getDate())."'" ?>)
                                    >
                                    Modifier
                                </button>
                            </td>
                            <td>
                                <button type="submit" class="btn-primary" onclick=confirmeSuppressionDate(<?php echo $date->getId().',"'.str_replace(" ","&nbsp;",$date->getDate()).'"' ?>)>
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