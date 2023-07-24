<?php

//var_dump($calendrierDuBureau);

?>

<table id="table-calendar" class="table-calendar">
  <thead>
    <th>&nbsp;</th>
    <th colspan="5"><?= $moisFrancais ?> <?= $currentYear ?></th>
    <th><button id="btn-last-month" onClick="mustangNextMonth('<?=$currentMonth?>','<?=$currentYear?>')">></button></th>
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
    <tr>
      <?php 
      
      // Jours vides.
      $dayNumber = 1;
      for ($i = 0; $i < 7; $i++) {
        if($i < $firstDayOfCurrentMonth){
          echo "<td></td>";
        }
        else {
          // est-ce que ce jour du mois est réservé ?
          if($dayNumber < 10) {
            $dayNumberString = "0".$dayNumber;
          } else { $dayNumberString = $dayNumber; }
          $dateSQL = $currentYear."-".$currentMonth."-".$dayNumberString;
          $reservedClass = $calendarsObject->isJourReserve($bureau->getId(),$dateSQL) ? 'bureau-reserve' : 'bureau-non-reserve';
          $toggleDay = ' onClick="alert(\'coucou\')" id=\'mustangDay'.$dayNumber.'\'"';
          
          if($i == 6){
            echo "<td class='bureau-non-reservable'>".$dayNumber."</td>";
          } else {
            echo "<td".$toggleDay." class='".$reservedClass." pointer'>".$dayNumber."</td>";
          }
          
          $dayNumber++;
        }
      }
      ?>
    </tr>
    <?php 
    // 4 lignes suivantes
    for($tr = 1 ; $tr <= 5; $tr++){
      ?>
      <tr>
        <?php
          for($day = 1; $day <= 7; $day++){
            if($dayNumber <= $numberOfDaysOfCurrentMonth){
              if($dayNumber < 10) {
                $dayNumberString = "0".$dayNumber;
              } else { $dayNumberString = $dayNumber; }
              $dateSQL = $currentYear."-".$currentMonth."-".$dayNumberString;
              $reservedClass = $calendarsObject->isJourReserve($bureau->getId(),$dateSQL) ? 'bureau-reserve' : 'bureau-non-reserve';
              $toggleDay = ' onClick="alert(\'coucou\')" id=\'mustangDay'.$dayNumber.'\'"';
              if($day == 7){
                echo "<td class='bureau-non-reservable'>".$dayNumber."</td>";
              } else {
                echo "<td".$toggleDay." class='".$reservedClass." pointer'>".$dayNumber."</td>";
              }
              $dayNumber++;
            }
            else {
              echo "<td></td>";
            }
          }
        ?>
      </tr>
      <?php
    }
    ?>



  </tbody>
</table>

<table id="table-calendar-skeleton" class="invisible">
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
