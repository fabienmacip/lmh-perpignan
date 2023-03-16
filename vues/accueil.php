<?php
$titre = 'Accueil';

$diane = "<div class='et-diane'>DIANE LESPIGNANAISE</div>";





ob_start();
?>
<div class="container m-1 max-width-100vw">
  <div class="row max-width-100percent">
    
    <?php foreach ($universs as $univers): ?>
      <div class="col-12 col-sm-6 col-lg-4">
        <div class="univers-sticker p-1">
          <?php
            $universActuelId = $univers->getId();
            $partenairesDeLUnivers = array_filter($partenaires, function($el) use ($universActuelId) {
              return in_array($universActuelId,$el->getUniversArray());
            });
  
            foreach ($partenairesDeLUnivers as $partenaire): 
          ?>
          <div>
            <?= $univers->getNom() ?> -> <?= $partenaire->getNom() ?>
          </div>
          
          <?php endforeach; ?>
            </div>
        </div>
      <?php endforeach; ?>

  </div>
</div>



<?php
$contenu = ob_get_clean();
require_once('layout.php');