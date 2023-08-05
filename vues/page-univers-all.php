<?php
$titre = 'La R&eacute;f&eacuterence - Nos r&eacute;f&eacute;rences';
//$univToDisplay
ob_start();
?>

<div class="container m-0 max-width-100vw univers-back">
  <div class="row max-width-100percent flex-column">
    
<!--     <div 
      id="partenaire-detail" 
      class="col-12 p-1"
      
    > 
    <div id="partenaire-detail-texte"></div>
    <span id="croix-close-partenaire" onclick=closePartenaireDetail()>--X--</span>    
    </div> -->
    
    
    
    <?php 
      $univToDisplayInt = 0;
      foreach ($universs as $univers): 

        //$univToDisplay = strval($univToDisplayInt);
        $univToDisplay = $univToDisplayInt;
        $universEnfants = $universEnfantsArray[$univToDisplay];
        $partenaires = $partenairesArray[$univToDisplay];

/*         $universEnfants = $universEnfantsArray[$indexUnivers];
        $partenaires = $partenairesArray[$indexUnivers];
 */
        $univToDisplayInt++;
        $backToUnivers = 0;
    ?>


      <!-- DEBUT UNIVERS -->
      <div 
        id="univers-<?= $univers->getId() ?>"
        class="col-12 col-sm-10 col-lg-8 univers-to-switch mx-auto" 
        onclick=switchUnivers(<?= $univers->getId() ?>) 
        <?php
          if($backToUnivers != 0 && $backToUnivers != $univers->getId()){ ?>
            style="display: none"
        <?php } ?>
      >
        
      
        <div class="univers-sticker p-1" style="background-image: url(img/univers/<?= $univers->getImage() ?>)">
          <div>
            <h2><?= $univers->getNom() ?></h2>
            <div>
              <?= $univers->getSurnom() ?>
            </div>
          </div>
        </div>
      </div>
      <!--FIN UNIVERS -->




      <!-- DEBUT UNIVERS ENFANTS -->
      <?php foreach($universEnfants as $univEnf): ?>
        <div id="univers-enfant-div-<?=$univEnf->getId()?>" class="flex wrap mt-4 mx-auto col-12 col-sm-10 col-lg-8 univers-enfant-div">
          <!-- TOUJOURS AFFICHE -->
          <div class="univers-enfant flex-1 box">
            <p class="mb-0">
              <b><?= $univEnf->getNom() ?> :</b> <?= $univEnf->getSurnom() ?>
            </p>  
            <p class="tr px-15 mb-0">
              <img id="down-arrow-univers-enfant-<?= $univEnf->getId() ?>" rel="flèche vers le bas" src="img/icones/down-arrow.png" class="down-arrow-univers-enfant" onclick="checkVisiteurRegistered(<?= $univEnf->getId() ?>)">
            </p>
          </div>
          <!-- FIN TOUJOURS AFFICHE -->


          <!-- DEBUT PARTENAIRE (dévoilé ou non) -->
          <?php 
            $universEnfantActuelId = $univEnf->getId();

          //echo "universEnfantActuelId -> ";
          //var_dump($partenaires);
          

            $partenairesDeLUniversEnfant = array_filter($partenaires, function($el) use ($universEnfantActuelId) {
              return in_array($universEnfantActuelId,$el->getUniversEnfantArray());
            });

            foreach ($partenairesDeLUniversEnfant as $partenaire): 
          ?>
            <!-- DEBUT 1 PARTENAIRE -->
            <div 
              id="partenaire-<?= $partenaire->getId() ?>"
              class="show-partenaires-<?= $universEnfantActuelId ?> flex-1 flex inaccessible entete-partenaire-sticker univers-enfant-to-display-<?= $univEnf->getId() ?>"
              
              >
              <!-- onclick='window.location.href="index.php?page=partenaire&id=A?= $partenaire->getId() ?B&univers=A?= $univEnf->getId() ?B"' -->
              <div 
                class="partenaire-sticker p-1 flex-1"
                style="background-image: url(img/partenaire/<?= $partenaire->getImage() ?>)"
              >
              </div>
              <div class="partenaire-sticker-right flex-1 flex flex-column jcse p-4">
                <div>
                  <h3>
                    <?= $partenaire->getNom() ?>
                  </h3>
                </div>
                <div>
                  <?= $partenaire->getDescriptionBreve() ?>
                </div>
                <div id="link-show-partenaire-detail-<?= $partenaire->getId() ?>" class="pointer pt-4 tr link-show-partenaire-detail" onclick="showPartenaireDetail(<?= $partenaire->getId() ?>)">
                  Voir la description...
                </div>
                <div id="link-hide-partenaire-detail-<?= $partenaire->getId() ?>" class="pointer pt-4 tr link-hide-partenaire-detail" onclick="hidePartenaireDetail(<?= $partenaire->getId() ?>)">
                  Masquer la description...
                </div>
              </div>   
          </div>

          <div id="partenaire-detail-<?= $partenaire->getId() ?>" class="inaccessible univers-enfant-detail-to-display-<?= $univEnf->getId() ?>">
              <p>
                <b>Avantages :</b> <?= $partenaire->getDescriptionBreve() ?><br><br>
              </p>
              <p>
                <b>Description complète :</b> <?= $partenaire->getDescription() ?><br><br>
              </p>
              <p class="tc">
                <button class="btn-toujours-affiche btn-mis-en-relation" onclick="confirmDemandeRelation(`<?= $partenaire->getId() ?>`, `<?= $partenaire->getNom() ?>`)">Etre mis en relation</button>
              </p>
          </div>
          <!-- FIN 1 PARTENAIRE -->

          <?php endforeach; ?>
          <!-- FIN PARTENAIRE (dévoilé ou non) -->

      </div>
      <!-- FIN UNIVERS ENFANTS -->
          <?php endforeach; ?>
      <?php 
    endforeach; ?>

  </div>
</div>

<div class="hidden-popup-mentions-legales">
  <?php require_once('page-mentions-legales.php'); ?>
</div>

<?php
$contenu = ob_get_clean();
require_once('layout.php');