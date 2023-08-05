<?php
    // PREPARATION pour les mois en français et la date actuelle
    
        $today = date("m.d.Y");

        //echo $today;

        function moisFrancais($mois = "01"){
        $moisEnFrancais = "Janvier";
        switch($mois){
            case "01": $moisEnFrancais = "Janvier";
                        break;
            case "02": $moisEnFrancais = "F&eacute;vrier";
                        break;
            case "03": $moisEnFrancais = "Mars";
                        break;
            case "04": $moisEnFrancais = "Avril";
                        break;
            case "05": $moisEnFrancais = "Mai";
                        break;
            case "06": $moisEnFrancais = "Juin";
                        break;
            case "07": $moisEnFrancais = "Juillet";
                        break;
            case "08": $moisEnFrancais = "Ao&ucirc;t";
                        break;
            case "09": $moisEnFrancais = "Septembre";
                        break;
            case "10": $moisEnFrancais = "Octobre";
                        break;
            case "11": $moisEnFrancais = "Novembre";
                        break;
            case "12": $moisEnFrancais = "D&eacute;cembre";
                        break;
            default: $moisEnFrancais = "Janvier";
                        break;
        }
        return $moisEnFrancais;
        }

        $currentMonth = date("m");
        $currentDay = date("d");
        $currentYear = date("Y");
        
        $premierjourdumois = $currentYear."-".$currentMonth."-01";
        $premierjourdumois = strtotime($premierjourdumois);
        $firstDayOfCurrentMonth = date('w',$premierjourdumois); 

        $numberOfDaysOfCurrentMonth = date("t");

        $moisFrancais = moisFrancais($currentMonth);


    ?>