<?php
$titre = 'La R&eacute;f&eacuterence - Nos r&eacute;f&eacute;rences';
//$univToDisplay
ob_start();
?>


<div class="container m-0 mt-3 max-width-100vw">
  <div class="row max-width-100percent">
    
    <div 
      id="partenaire-detail" 
      class="col-12 p-1"
      
    > 
    <div id="partenaire-detail-texte"></div>
    <span id="croix-close-partenaire" onclick=closePartenaireDetail()>--X--</span>    
    </div>



    <?php foreach ($universs as $univers): 
      // On n'affiche qu'un univers sur cette page.
      if($univers->getId() == $univToDisplay){
      
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
      

<?php foreach($universEnfants as $univEnf): ?>
<div>
  Coucou : <?= $univEnf->getId() ?>

</div>
<?php endforeach; ?>


          <?php
            $universActuelId = $univers->getId();
            $partenairesDeLUnivers = array_filter($partenaires, function($el) use ($universActuelId) {
              return in_array($universActuelId,$el->getUniversArray());
            });
            
            foreach ($partenairesDeLUnivers as $partenaire): 
          ?>
          <div 
            id="partenaire-<?= $partenaire->getId() ?>"
            class="show-partenaires-<?= $universActuelId ?> hide-partenaires col-12 col-sm-6 col-lg-4"
            onclick='window.location.href="index.php?page=partenaire&id=<?= $partenaire->getId() ?>&univers=<?= $univers->getId() ?>"'
            <?php
              if($backToUnivers != 0 && $backToUnivers == $universActuelId){ ?>
                style="display: block"
              <?php }
            ?>
            >
            <div 
              class="partenaire-sticker p-1"
              style="background-image: url(img/partenaire/<?= $partenaire->getImage() ?>)"
            >
              <div>
                <h3>
                    <?= $partenaire->getNom() ?>
                  </h3>
                  <div>
                    <?= $partenaire->getDescriptionBreve() ?>
                  </div>
              </div>  
            </div>
          </div>
          
          <?php endforeach; ?>
      <?php 
      }
    endforeach; ?>

  </div>
</div>

<?php
$contenu = ob_get_clean();
require_once('layout.php');