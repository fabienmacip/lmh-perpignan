<?php
$titre = 'La Maison de l\'Habitat by La Centrale de Financement - Détails d\un partenaire';
ob_start();
?>
<div class="container">
  <div class="row">
    <div class="col-0 col-lg-1 col-xl-2">
    <a href="index.php?page=accueil&backtounivers=<?= $univers ?>" class="nav-link"><<< Accueil</a><br><br>
    </div>

    <div>
      <img 
        src="img/partenaire/<?= $partenaire->getImage() ?>" 
        alt="<?= $partenaire->getImage() ?>"
        class="partenaire-logo"
      /><br><br>
    </div>
    <div>
      <b>Identifiant :</b> <?= $partenaire->getId() ?><br><br>
      <b>Nom :</b> <?= $partenaire->getNom() ?><br><br>
      <b>Description courte :</b> <?= $partenaire->getDescriptionBreve() ?><br><br>
      <b>Description complète :</b> <?= $partenaire->getDescription() ?><br><br>
    </div>
  </div>
</div>



<?php
$contenu = ob_get_clean();
require_once('layout.php');