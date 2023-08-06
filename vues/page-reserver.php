<?php
$titre = 'La Maison de l\'Habitat by La Centrale de Financement - Réserver';
ob_start();
?>
<div class="container">
  <div class="row">
    <div class="col-12 col-md-10 mx-auto">

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

    <?php
    // PREPARATION pour les mois en français et la date actuelle
    
        $today = date("m.d.Y");

        //echo $today;

        require_once(dirname(__FILE__,2).'/services/functionMoisFrancais.php');
        
        $currentMonth = date("m");
        $currentDay = date("d");
        $currentYear = date("Y");
        
        $premierjourdumois = $currentYear."-".$currentMonth."-01";
        $premierjourdumois = strtotime($premierjourdumois);
        $firstDayOfCurrentMonth = date('w',$premierjourdumois); 

        $numberOfDaysOfCurrentMonth = date("t");

        $moisFrancais = moisFrancais($currentMonth);


    ?>

        <h1 id="reservations-h1">Réservations de bureaux</h1>
        <div class="reservation-main" id="reservation-main">

            <?php
                 /* foreach ($_SESSION as $k=>$v) {
                    echo "$k => $v <br />\n";
                }  */
            ?>
            <p>Vous avez 6 heures de disponibilit&eacute; par semaine, non-cumulables.</p>
            <!-- <p>A ce jour, vous avez droit à <span id="span-remaining-hours">>?= /*$remainingHours*/ ?<</span>.</p> -->
            <p>Les bureaux et la salle de r&eacute;union sont r&eacute;servables de 8h à 20h, du LUNDI au SAMEDI.</p>

            <?php
                // On affecte un tableau (array) par bureau pour avoir un tableau de réservations par bureau
                $buros = [];
                $nbBuros = intval($nbBureaux[0]["total"]);
                for($i = 0; $i < $nbBuros; $i++){
                    $buros[$i] = array_filter($calendars, function($c) use ($i) {
                        return $c->getIdBureau() == (intval($i)+1);
                    });
                }

                // DEBUT liste DES CARDS
                $index = 0;
                foreach($bureaux as $bureau):
            ?>



            <div id="bureau-<?= $bureau->getId() ?>" class="bureau-card">
                <div class="bureau-entete">
                    <div class="bureau-title">
                        <h2><?= $bureau->getTitre() ?></h2>
                        <p><?= $bureau->getDescription() ?></p>
                    </div>    
                    <div class="bureau-img1">
                        <img src="<?= $bureau->getImg() ?>" onclick="displayBigImg('<?= $bureau->getImg() ?>','bureau-img1-<?= $bureau->getId() ?>')" id="bureau-img1-<?= $bureau->getId() ?>">
                    </div>
                </div>    
                <div class="bureau-corps" id="bureau-corps-<?= $bureau->getId() ?>">
                    <?php
                         $calendrierDuBureau = $buros[$index];
                         require(dirname(__FILE__,2).'/vues/bureauCalendar.php'); 
                    ?>
                </div>
                <div class="bureau-footer tr">
                    <img 
                        class="logo-bureau-footer box" 
                        src="img/logo/logo-la-reference-350x311-transparent.png"
                        alt="La maison de l'habitat (by La Centrale de Financement) - Perpignan"
                    >
                </div>
            </div>

            <?php   $index++;
                    endforeach; 
                  // FIN liste des CARDS      
            ?>

        </div>
    </div>
  </div>
</div>



<?php
$contenu = ob_get_clean();
require_once('layout.php');