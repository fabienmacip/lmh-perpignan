<?php
$titre = 'Liste des animaux';
ob_start();
?>
<div class="container">
  <div class="row">
    <div class="col-0 col-lg-1 col-xl-2">
    </div>
    <div class="col-12 col-lg-10 col-xl-8">

    <?php
        if(isset($animalToDelete)) {?>
        <div class="animal-deleted"><?= $animalToDelete ?></div>
        <?php
        }
    ?>

    <?php
        if(isset($animalToCreate)) {?>
        <div class="animal-created"><?= $animalToCreate ?></div>
        <?php
        }
    ?>

    <?php
        if(isset($animalToUpdate)) {?>
        <div class="animal-updated"><?= $animalToUpdate ?></div>
        <?php
        }
    ?>

<!--     <div class="mt-2">
        <a href="#form-create-animal" class="add-link">Ajouter un animal</a>
    </div> -->

        <!-- ######################## DEBUT FORM AJOUT ANIMAL #################### -->
        
        <form method="post" action="index.php" id="form-create-animal" class="mt-3 rounded py-3 px-1 bg-info">
            <h4>Ajouter un animal</h4>    
            <div class="row">
                <!-- <div class="col-12 col-md-12"> -->
                <div class="form-group mb-2">
                    <!-- <label for="nom">Nom du pays</label> -->
                    <!-- <label for="nom">Nom de famille</label> -->
                    <input type="text" name="nom" class="form-control" maxlength="50" id="nom" placeholder="Saisissez le nom de l'animal">
                </div>
                <div class="form-group mb-2">
                <!-- <div class="col-12 col-md-4 mt-3 mt-md-0"> -->
                    <input type="hidden" name="action" id="action" value="createAnimal">
                    <input type="hidden" name="page" id="page" value="animals">
                    <button type="reset" class="btn btn-primary">Reset</button>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </div>
                <!-- <div class="col-0 col-md-2"></div> -->
            </div>
            </form>
        
        <!-- ******************** FIN FORM AJOUT ANIMAL ************************* -->


    <div class="table-responsive">
        
        <table class="table table-striped table-bordered table-sm caption-top table-responsive-lg text-center">
            <caption class="text-center fs-3 text-primary">Liste des animaux</caption>
            <thead class="table-dark">
                  <tr>
                      <th width="10%">N°</th>
                      <th width="50%">Nom</th>
                      <th width="20%"></th>
                      <th width="20%"></th>
                    </tr>
                </thead>
              
                <tbody>
                    
                    <?php 
                        $cpt2 = 0;
                        foreach ($animals as $animal): 
                        $cpt2++;
                    ?>
                        <tr id="tr<?= $animal->getId() ?>">
                            <td>
                                <?= $cpt2 ?>
                            </td>
                            <td>
                                <?= $animal->getNom() ?>
                            </td>
                            <td>
                                <!--<a href="pays.php?action=edit&id=--><?php //$pays->getId() ?><!--" class="link-secondary">-->
                                <button type="button" id="updateAnimal<?= $animal->getId() ?>" class="updateAnimal btn-primary inactif-force" 
                                    onclick=displayUpdateAnimal(<?php echo $animal->getId().",'".str_replace(" ","&nbsp;",$animal->getNom())."'" ?>)
                                    >
                                    Modifier
                                </button>
                            </td>
                            <td>
                                <button type="submit" class="btn-primary inactif-force" onclick=confirmeSuppressionAnimal(<?php echo $animal->getId().',"'.str_replace(" ","&nbsp;",$animal->getNom()).'"' ?>)>
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