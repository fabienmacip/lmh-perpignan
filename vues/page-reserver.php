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

        <h1>PAGE des Réservations</h1>
        <div class="reservation-main">
            <p>Vous avez 10 heures de disponibilit&eacute; par mois, cumulables.</p>
            <p>A ce jour, vous avez droit à XXX heures.</p>
            <p>Les bureaux et la salle de r&eacute;union sont r&eacute;servables de 8h à 20h, du LUNDI au SAMEDI.</p>

            <div id="bureau1" class="bureau-card">
                <div class="bureau-entete">
                    <div class="bureau-title">
                        <h2>Bureau n°1</h2>
                        <p>3 m², 1er sur la gauche en entrant dans nos locaux.</p>
                    </div>    
                    <div class="bureau-img1">
                        <img src="img/reserver/bureau1.jpg" onclick="displayBigImg('reserver/bureau1.jpg')">
                    </div>
                </div>    
                <div class="bureau-corps">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate fugit rem est qui temporibus, nesciunt, labore amet asperiores ullam corporis vel! Voluptate ex ducimus et dolor, assumenda debitis molestias perferendis quod libero omnis consequuntur, natus voluptatem? Saepe dolores necessitatibus modi. Ut illo porro corrupti nobis quam necessitatibus? Consequuntur nulla, doloribus eligendi rem beatae commodi itaque voluptate eum, sit veritatis vitae velit, veniam dolor ipsa laudantium sequi perspiciatis soluta pariatur iure inventore praesentium at repudiandae saepe voluptatum? Itaque aut, nihil quibusdam a aspernatur repellat inventore natus ipsum error, reiciendis dolores mollitia quidem quasi deserunt iure deleniti accusantium suscipit obcaecati quis amet?<br>
                    
                    <br>Nombre de bureaux : <?= $tempo[0]["total"] ?><br><br>

                    <?php 
                        foreach($calendars as $calendar) :
                    ?>

                        Ligne <?= $calendar->getId() ?><br>
                        Partenaire n°<?= $calendar->getIdPartenaire() ?><br>
                        Bureau n°<?= $calendar->getIdBureau() ?><br>
                        Jour : <?= $calendar->getDate() ?><br>
                        Heure début : <?= $calendar->getHeureDebut() ?><br>
                        Heure fin : <?= $calendar->getHeureFin() ?><br>
                        Durée : <?= $calendar->getDureeEnMinutes() ?> mn

                        <hr>

                    <?php endforeach; ?>
                </div>
            </div>


        </div>
    </div>
  </div>
</div>



<?php
$contenu = ob_get_clean();
require_once('layout.php');