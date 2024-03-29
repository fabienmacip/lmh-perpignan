<?php

//var_dump($calendrierDuBureau);

?>

<table id="table-calendar-<?= $bureau->getId() ?>" class="table-calendar">
  <thead>
  <th><button id="btn-last-month-<?= $bureau->getId() ?>" class="btn-last-month" onClick="bureauLastMonth('<?=$currentMonth?>','<?=$currentYear?>','<?=$bureau->getId()?>')">
        <img src="img/icones/left-arrow-black.png" alt="left arrow black">
      </button></th>
    <th colspan="6"><?= $moisFrancais ?> <?= $currentYear ?></th>
    <th><button id="btn-next-month-<?= $bureau->getId() ?>" class="btn-next-month" onClick="bureauNextMonth('<?=$currentMonth?>','<?=$currentYear?>','<?=$bureau->getId()?>')">
          <img src="img/icones/right-arrow-black.png" alt="right arrow black">
        </button></th>
  </thead>
  <tbody>
    <tr>
      <td>L</td>
      <td>M</td>
      <td>Me</td>
      <td>J</td>
      <td>V</td>
      <td>S</td>
      <td>D</td>
      <td class="vos-heures-dispos-title">Vos heures disponibles</td>
    </tr>
    <tr>
      <?php 
      
      // Jours vides.
      $dayNumber = 1;
      $firstDayOfCurrentMonth = $firstDayOfCurrentMonth == 0 ? 7 : $firstDayOfCurrentMonth;
             
      // Si le premier jour n'est pas un lundi, alors on affiche des jours vides.
      for ($i = 1; $i <= 7; $i++) {
        
        if($i < $firstDayOfCurrentMonth || $firstDayOfCurrentMonth == 0){
          echo "<td></td>";
        }
        else {
          // Affichage du jour sur 2 caractères
          if($dayNumber < 10) {
            $dayNumberString = "0".$dayNumber;
          } else { $dayNumberString = $dayNumber; }

          // est-ce que ce jour du mois est réservé ?
          $dateSQL = $currentYear."-".$currentMonth."-".$dayNumberString;
          $heuresReserveesParLePartenaire = $calendarsObject->listHoursReservedByPartenaire($dateSQL,$_SESSION['partenaire'],$bureau->getId());
          $heuresReserveesPourLePartenaire = $calendarsObject->listHoursReservedForPartenaire($dateSQL,$_SESSION['partenaire'],$bureau->getId());
          $heuresReserveesParUnAutrePartenaire = $calendarsObject->listHoursReservedByAnotherPartenaire($dateSQL,$_SESSION['partenaire'],$bureau->getId());


          // Est-ce que ce partenaire a réservé des créneaux sur ce jour du mois ?
          strlen($heuresReserveesParLePartenaire.$heuresReserveesPourLePartenaire) > 0 ? $hasCreneauPartenaire = ' has-creneau-partenaire' : $hasCreneauPartenaire = '';

          $nbCreneauxReserves = $calendarsObject->nbCreneauJourReserve($bureau->getId(),$dateSQL);
          $reservedClass = $nbCreneauxReserves == 0 ? 'bureau-non-reserve' : ($nbCreneauxReserves < 6 ? 'bureau-reserve' : ($nbCreneauxReserves < 11 ? 'bureau-reserve-much' : 'bureau-reserve-full'));

          $toggleDay = ' onClick="displayCalendarBureauDay(\''.$dateSQL.'\',\''.$bureau->getId().'\',\''.$_SESSION["partenaire"].'\',\''.$heuresReserveesParLePartenaire.'\',\''.$heuresReserveesPourLePartenaire.'\',\''.$heuresReserveesParUnAutrePartenaire.'\',\''.$calendarsObject->getRemainingHoursPartenaire($_SESSION['partenaire'],$dateSQL).'\')" id=\'bureau'.$bureau->getId().'-day'.$dayNumber.'\'"';
          
          if($i == 7){
            echo "<td class='bureau-non-reservable'>".$dayNumber."</td>";
            echo "<td id='".$dayNumber."/".$bureau->getId()."' class='bureau-heures-restantes bureau-heures-restantes-".$dateSQL."'>".$calendarsObject->getRemainingHoursPartenaire($_SESSION['partenaire'],$dateSQL)."</td>";
          } else {
            echo "<td".$toggleDay." class='".$reservedClass.$hasCreneauPartenaire." pointer'>".$dayNumber."</td>";
          }
          
          $dayNumber++;
        }
      }
      
      
      ?>
    </tr>
    <?php 
    // 4 ou 5 lignes suivantes ?
    $numberOfDaysOfCurrentMonth = (new DateTime($currentYear."-".$currentMonth))->format('t');
    $nb_lignes_a_ajouter = ceil(($numberOfDaysOfCurrentMonth - $dayNumber + 1) / 7);

    for($tr = 1 ; $tr <= $nb_lignes_a_ajouter; $tr++){
      ?>
      <tr>
        <?php
          for($day = 1; $day <= 7; $day++){
            if($dayNumber <= $numberOfDaysOfCurrentMonth){
              if($dayNumber < 10) {
                $dayNumberString = "0".$dayNumber;
              } else { $dayNumberString = $dayNumber; }
              $dateSQL = $currentYear."-".$currentMonth."-".$dayNumberString;
              $heuresReserveesParLePartenaire = $calendarsObject->listHoursReservedByPartenaire($dateSQL,$_SESSION['partenaire'],$bureau->getId());
              $heuresReserveesPourLePartenaire = $calendarsObject->listHoursReservedForPartenaire($dateSQL,$_SESSION['partenaire'],$bureau->getId());
              $heuresReserveesParUnAutrePartenaire = $calendarsObject->listHoursReservedByAnotherPartenaire($dateSQL,$_SESSION['partenaire'],$bureau->getId());

              // Est-ce que ce partenaire a réservé des créneaux sur ce jour du mois ?
              strlen($heuresReserveesParLePartenaire.$heuresReserveesPourLePartenaire) > 0 ? $hasCreneauPartenaire = ' has-creneau-partenaire' : $hasCreneauPartenaire = '';

              //$reservedClass = $calendarsObject->isJourReserve($bureau->getId(),$dateSQL) ? 'bureau-reserve' : 'bureau-non-reserve';
              $nbCreneauxReserves = $calendarsObject->nbCreneauJourReserve($bureau->getId(),$dateSQL);
              $reservedClass = $nbCreneauxReserves == 0 ? 'bureau-non-reserve' : ($nbCreneauxReserves < 6 ? 'bureau-reserve' : ($nbCreneauxReserves < 11 ? 'bureau-reserve-much' : 'bureau-reserve-full'));

              $toggleDay = ' onClick="displayCalendarBureauDay(\''.$dateSQL.'\',\''.$bureau->getId().'\',\''.$_SESSION["partenaire"].'\',\''.$heuresReserveesParLePartenaire.'\',\''.$heuresReserveesPourLePartenaire.'\',\''.$heuresReserveesParUnAutrePartenaire.'\',\''.$calendarsObject->getRemainingHoursPartenaire($_SESSION['partenaire'],$dateSQL).'\')" id=\'bureau'.$bureau->getId().'-day'.$dayNumber.'\'"';
              if($day == 7){
                echo "<td class='bureau-non-reservable'>".$dayNumber."</td>";
                
              } else {
                echo "<td".$toggleDay." class='".$reservedClass.$hasCreneauPartenaire." pointer'>".$dayNumber."</td>";
              }
              $dayNumber++;
            }
            else {
              // Incrémenter $dateSQL pour avoir la date du dimanche en fin de ligne, pour AJAX.
              $dateSQL = date('Y-m-d', strtotime($dateSQL.' + 1 day'));
              echo "<td></td>";
            }
          }
          echo "<td id='".$dayNumber."/".$bureau->getId()."' class='bureau-heures-restantes bureau-heures-restantes-".$dateSQL."'>".$calendarsObject->getRemainingHoursPartenaire($_SESSION['partenaire'],$dateSQL)."</td>";
        ?>
      </tr>
      <?php
    }
    ?>



  </tbody>
</table>

<table id="table-calendar-skeleton-<?= $bureau->getId() ?>" class="invisible table-calendar-skeleton">
  <thead>
    <th></th>
    <th colspan="5"></th>
    <th></th>
  </thead>
  <tbody>
    <tr>
      <td>L</td>
      <td>M</td>
      <td>Me</td>
      <td>J</td>
      <td>V</td>
      <td>S</td>
      <td>D</td>
    </tr>
    <tr><td colspan='7'>Attendre 2</td></tr>
    <tr><td colspan='7'>secondes</td></tr>
    <tr><td colspan='7'>avant</td></tr>
    <tr><td colspan='7'>mise &agrave; jour</td></tr>
    <tr><td colspan='7'>de la</td></tr>
    <tr><td colspan='7'>page</td></tr>
  </tbody>
</table>
