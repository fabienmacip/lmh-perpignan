<?php
$titre = 'Accueil';

$diane = "<div class='et-diane'>DIANE LESPIGNANAISE</div>";





ob_start();
?>
<div class="container m-0 mt-3 max-width-100vw">
  <div class="row max-width-100percent">
    
    <?php foreach ($universs as $univers): ?>
      <div 
      id="univers-<?= $univers->getId() ?>"
      class="col-12 col-sm-6 col-lg-4 univers-to-switch" 
      onclick=switchUnivers(<?= $univers->getId() ?>) 
      >
        <div class="univers-sticker p-1" style="background-image: url(img/univers/<?= $univers->getImage() ?>)">
          <h2><?= $univers->getNom() ?></h2>
          <div>
            <?= $univers->getSurnom() ?>
          </div>
        </div>
          <?php
            $universActuelId = $univers->getId();
            $partenairesDeLUnivers = array_filter($partenaires, function($el) use ($universActuelId) {
              return in_array($universActuelId,$el->getUniversArray());
            });
  
            foreach ($partenairesDeLUnivers as $partenaire): 
          ?>
          <div class="show-partenaires-<?= $universActuelId ?> hide-partenaires">
            <?= $univers->getNom() ?> -> <?= $partenaire->getNom() ?>
          </div>
          
          <?php endforeach; ?>
        </div>
      <?php endforeach; ?>

  </div>
</div>



<?php
$contenu = ob_get_clean();
require_once('layout.php');