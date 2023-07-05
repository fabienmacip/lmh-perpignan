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
      foreach ($universsSlider as $univers):
    ?>
      <img src="img/univers/<?= $univers->getImage() ?>" alt="<?= $univers->getNom() ?>">
    <?php endforeach; ?>
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