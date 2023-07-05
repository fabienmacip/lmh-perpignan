<?php
$titre = 'La Maison de l\'Habitat by La Centrale de Financement - Accueil';

ob_start();
?>

<div id="slider-back">
  <div id="slider">
    <figure>
    <?php 
      $universsSlider = $universs;
      array_unshift($universsSlider,end($universsSlider));
      $cptSlider = 0;
      foreach ($universsSlider as $univers):
    ?>

        <div class="slider-divs absolute" style="left:calc((<?= $cptSlider ?> * (100% / 7)) + 10px);" onclick="showUnivers('<?= $univers->getId() ?>')">
          <span><?= $univers->getNom() ?></span>
        </div>

        <img src="img/univers/<?= $univers->getImage() ?>" alt="<?= $univers->getNom() ?>" alt="<?= $univers->getNom() ?>" onclick="showUnivers('<?= $univers->getId() ?>')">
        
    <?php 
      $cptSlider++;
      endforeach; 
    ?>
    </figure>
  </div>
</div>


<?php 
      foreach ($universs as $univers):
    ?>
<?= $univers->getNom() ?>
<br>
<?php endforeach; ?>








<?php
$contenu = ob_get_clean();
require_once('layout.php');