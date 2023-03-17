<?php
$titre = 'La Maison de l\'Habitat by La Centrale de Financement - Détails d\un partenaire';
ob_start();
?>
<div class="container">
  <div class="row">
    <div class="col-0 col-lg-1 col-xl-2">
        <?= $partenaire->getId() ?><br><br>
        <?= $partenaire->getNom() ?><br><br>
        <?= $partenaire->getDescriptionBreve() ?><br><br>
        <?= $partenaire->getImage() ?><br><br>
        <?= $univers ?>
    </div>
  </div>
</div>



<?php
$contenu = ob_get_clean();
require_once('layout.php');