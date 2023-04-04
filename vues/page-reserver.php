<?php
$titre = 'La Maison de l\'Habitat by La Centrale de Financement - Réserver';
ob_start();
?>
<div class="container">
  <div class="row">
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

<h2>PAGE des Réservations</h2>
<div class="reservation-main">
    <p>Contenu à déterminer...</p>
    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Veritatis sunt deserunt beatae dolorum minima rerum quidem eos sapiente optio harum incidunt enim delectus ab, cupiditate maiores porro dolores sequi autem.</p>
    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Veritatis sunt deserunt beatae dolorum minima rerum quidem eos sapiente optio harum incidunt enim delectus ab, cupiditate maiores porro dolores sequi autem.</p>
    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Veritatis sunt deserunt beatae dolorum minima rerum quidem eos sapiente optio harum incidunt enim delectus ab, cupiditate maiores porro dolores sequi autem.</p>
    
</div>

<!-- Ancien emplacement du formulaire AJOUT ANIMAL -->
    </div>
  </div>
</div>



<?php
$contenu = ob_get_clean();
require_once('layout.php');