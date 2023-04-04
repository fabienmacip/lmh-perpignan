<?php
$titre = 'La Maison de l\'Habitat by La Centrale de Financement - Statistiques';
ob_start();
?>
<div class="container">
  <div class="row">
    <h2>Statistiques</h2>
    <div id="statspartenaires">
      
    <?php 
      if(isset($statPartenaires)) {
    ?>

          <div class="statrow statrowfirst">
            <div class="statid">ID</div>
            <div class="statnom">PARTENAIRE</div>
            <div class="statdate">DATE</div>
            <div class="stattotal">NB Clics</div>
          </div>


    <?php
        foreach ($statPartenaires as $stat):
    ?>

          <div class="statrow">
            <div class="statid"><?= $stat->getId() ?></div>
            <div class="statnom"><?= $stat->getNom() ?></div>
            <div class="statdate"><pre><?= $stat->getDateCourt() ?></pre></div>
            <div class="stattotal"><?= $stat->getTotal() ?></div>
          </div>


      
    <?php
        endforeach;
      }
    ?>

    </div>
  </div>
</div>



<?php
$contenu = ob_get_clean();
require_once('layout.php');