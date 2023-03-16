<?php
$titre = 'Accueil';

$diane = "<div class='et-diane'>DIANE LESPIGNANAISE</div>";





ob_start();
?>
<div class="container">
  <div class="row">
    
    <?php foreach ($universs as $univers): ?>
      <div class="col-12 col-lg-6 col-xl-4">
          <?php
            $universActuelId = $univers->getId();
            $partenairesDeLUnivers = array_filter($partenaires, function($el) use ($universActuelId) {
              return $el->getUnivers() == $universActuelId;
            });
  
            foreach ($partenairesDeLUnivers as $partenaire): 
          ?>
          <div>
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