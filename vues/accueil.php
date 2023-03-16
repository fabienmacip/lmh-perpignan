<?php
$titre = 'Accueil';

$diane = "<div class='et-diane'>DIANE LESPIGNANAISE</div>";





ob_start();
?>
<div class="container">
  <div class="row">
    <div class="col-0 col-lg-1 col-xl-2">
    </div>
    <div class="col-12 col-lg-10 col-xl-8">

    <div class="confidentiel my-5">
      Pour des raisons de confidentialit&eacute;, vous devez être connecté pour voir la liste des chasseurs.
    </div>

    <!-- GENERATION TABLEAU -->
    <!-- <button type="button" name="genereliste" id="genereliste" onclick="genereListe()">Générer liste</button> -->
    <button type="button" name="printbutton" id="printbutton" onclick="handleClickPrint()" class="inutile et-button">Imprimer</button>
    <table id="tableEtiquettes" class="et-table">
    <tbody>
      <!-- Rappel : pays = chasseur -->
      <?php foreach ($payss as $pays): ?>
        <?php
           foreach ($animals as $animal): 
        
            if($animal->getNom() !== "LIEVRE") {
              foreach ($dates as $date): ?>
              
              <tr>
                <td>
                  <?= $diane ?>
                  <div class='et-nom'><?= $pays->getNom() ?> <?= $pays->getPrenom() ?></div>
                  <div class='et-animal'><?= $animal->getNom() ?></div>
                  <div class='et-date <?= $animal->getPolice() ?>'><?= $date->getDateLong() ?></div>
                </td>
                <td>
                  <?= $diane ?>
                  <div class='et-nom'><?= $pays->getNom() ?> <?= $pays->getPrenom() ?></div>
                  <div class='et-animal'><?= $animal->getNom() ?></div>
                  <div class='et-date <?= $animal->getPolice() ?>'><?= $date->getDateLong() ?></div>
                </td>
              </tr>

              <?php endforeach; 
              } elseif($animal->getNom() === "LIEVRE") {

              for($i = 0 ; $i < 4 ; $i++) { ?>
              <tr>
                <td>
                  <?= $diane ?>
                  <div class='et-nom'><?= $pays->getNom() ?> <?= $pays->getPrenom() ?></div>
                  <div class='et-animal'>LIEVRE</div>
                  <div class='et-date police-blanche'>X</div>
                </td>
                <td>
                  <?= $diane ?>
                  <div class='et-nom'><?= $pays->getNom() ?> <?= $pays->getPrenom() ?></div>
                  <div class='et-animal'>LIEVRE</div>
                  <div class='et-date police-blanche'>X</div>
                </td>
              </tr>

            <?php
               }// end for
              } // end if
             ?>
          

            
          <?php endforeach; ?>
      <?php endforeach; ?>

    </tbody>
    </table>
    <!-- FIN GENERATION TABLEAU -->


</div>



<?php
$contenu = ob_get_clean();
require_once('layout.php');