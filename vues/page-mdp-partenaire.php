<?php
$titre = 'La Maison de l\'Habitat by La Centrale de Financement - Changer mon mot de passe';
ob_start();
?>
<div class="container">
  <div class="row">
    <div class="col-0 col-md-1">
    </div>
    <div class="col-12 col-md-10">

    <?php
        if(isset($partenairesToggle)) {?>
        <div class="partenaire-updated"><?= $partenairesToggle ?></div>
        <?php
        }
    ?>

    <?php
        if(isset($partenaireToDelete)) {?>
        <div class="partenaire-deleted"><?= $partenaireToDelete ?></div>
        <?php
        }
    ?>

    <?php
        if(isset($partenaireToCreate)) {?>
        <div class="partenaire-created"><?= $partenaireToCreate ?></div>
        <?php
        }
    ?>

    <?php
        if(isset($partenaireToUpdate)) {?>
        <div class="partenaire-updated"><?= $partenaireToUpdate ?></div>
        <?php
        }
    ?>

<h2>CHANGER de mot de passe</h2>


<!-- Ancien emplacement du formulaire AJOUT ANIMAL -->
    </div>
    <div class="col-0 col-md-1">
        </div>
    </div>
</div>



<?php
$contenu = ob_get_clean();
require_once('layout.php');