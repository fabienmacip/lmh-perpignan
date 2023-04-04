<?php
$titre = 'La Maison de l\'Habitat by La Centrale de Financement - Statistiques';
ob_start();
?>
<div class="container">
  <div class="row">
    <h2>Statistiques</h2>
    <div>
      
    <?php 
      if(isset($statPartenaires)) {
        var_dump($statPartenaires);
      }
    ?>

    </div>
  </div>
</div>



<?php
$contenu = ob_get_clean();
require_once('layout.php');