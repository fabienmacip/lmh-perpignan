<?php
$titre = 'LA REFERENCE - Réserver';
ob_start();
?>
<div class="container">
  <div class="row">
    <div class="col-12 col-md-10 mx-auto">

<?php
    require(dirname(__FILE__,2).'/services/moisFrancaisEtDateActuelle.php');
?>

        <h1 id="reservations-h1">Gestion des r&eacute;servations de bureaux</h1>
        <div class="reservation-main" id="reservation-main">

            <?php
                 /* foreach ($_SESSION as $k=>$v) {
                    echo "$k => $v <br />\n";
                }  */
            ?>
            <p>Chaque "Partenaire-R&eacute;f&eacute;renc&eacute;" a 6 heures de disponibilit&eacute; par semaine, non-cumulables.</p>
            <p>En tant qu'administrateur, vous pouvez r&eacute;server des cr&eacute;neaux horaires suppl&eacute;mentaires pour un partenaire qui a d&eacute;pass&eacute; son quota d'heures.</p>
            <p>Les bureaux et la salle de r&eacute;union sont r&eacute;servables de 8h à 20h, du LUNDI au SAMEDI.</p>
            <br>
            <div id="div-select-abonne-for-calendar">

            <!-- $_SESSION["partenaireActuel"] -->

            <?php 
                /* echo "<pre>",var_dump($partenaireAllArray),"</pre>"; */
            ?>
                <select id="select-abonne-for-calendar" onchange="updateCalendarAdmin()">
                    <option value="<?= $partenaireActif[0]->getId() ?>" class="option-abonne-for-calendar"><?= $partenaireActif[0]->getNom() ?></option>
                <?php
                    foreach($partenaireAllArray as $onePartenaire):
                        
                        if($partenaireActif[0]->getId() != $onePartenaire->getId()){
                ?>
                        <option value="<?= $onePartenaire->getId() ?>" class="option-abonne-for-calendar"><?= $onePartenaire->getNom() ?></option>
                <?php
                        }
                    endforeach;
                ?>
                </select>


            </div>

            <div id="liste-calendriers-admin">
            
            <?php
                require_once(dirname(__FILE__,2).'/vues/liste-calendriers-admin.php');
            ?>
            </div>  <!-- FIN <div id="liste-calendriers-admin"> -->

        </div>
    </div>
  </div>
</div>



<?php
$contenu = ob_get_clean();
require_once('layout.php');