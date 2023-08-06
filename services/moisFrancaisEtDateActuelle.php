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