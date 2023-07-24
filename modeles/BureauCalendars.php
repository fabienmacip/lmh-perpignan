<?php

class BureauCalendars
{
    use Modele;

    // READ
    public function readAll()
    {
        $today = new DateTime();
        $currentYear = date_format($today,'Y');
        $nextYear = (int)$currentYear + 1;
        
        if (!is_null($this->pdo)) {
            $stmt = $this->pdo->query('SELECT * FROM bureaucalendar WHERE (date LIKE "%'.$currentYear.'%") OR (date LIKE "%'.$nextYear.'%")');
        }
        $tuples = [];
        while ($tuple = $stmt->fetchObject('BureauCalendar', [$this->pdo])) {
            $tuples[] = $tuple;
        }
        $stmt->closeCursor();
        return $tuples;
    }

    public function isJourReserve($idBureau,$date) {

        if (!is_null($this->pdo)) {
            $sql = 'SELECT * FROM bureaucalendar WHERE idBureau = :idBureau AND date = :date';
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([":idBureau"=>$idBureau, ":date"=>$date]);
        }
        $tuples = [];
        while ($tuple = $stmt->fetchObject('BureauCalendar', [$this->pdo])) {
            $tuples[] = $tuple;
        }

        $stmt->closeCursor();

        return count($tuples) > 0;

    }

    public function listHoursReservedByPartenaire($dateSQL,$idPpartenaire){
        return "10:00:00and10:30:00and11:00:00and11:30:00and15:00:00and15:30:00";
    }

    public function listHoursReservedByAnotherPartenaire($dateSQL,$idPartenaire) {
        return "08:00:00and08:03:00and09:00:00and09:30:00and16:30:00and17:00:00and17:30:00and18:00:00and18:30:00";
    }

    public function getRemainingMinutesPartenaire($idPartenaire, $datePartenaire) {
        
        $idPartenaire = intval($idPartenaire);
        
        if (!is_null($this->pdo)) {
            $stmt = $this->pdo->prepare('SELECT * FROM bureaucalendar WHERE idPartenaire = :idPartenaire');
            $stmt->execute([":idPartenaire"=>$idPartenaire]);
        }
        $tuples = [];
        while ($tuple = $stmt->fetchObject('BureauCalendar', [$this->pdo])) {
            $tuples[] = $tuple;
        }
        $stmt->closeCursor();

        // Calcul durée déjà utilisé (en minutes)
        $duree = 0; // Durée déjà utilisée
        foreach($tuples as $line):
            $duree += intval($line->getDureeEnMinutes());
        endforeach;

        // Calcul duréé autorisée depuis création partenaire
        $start_year = substr($datePartenaire,0,4);
        $start_month = substr($datePartenaire,5,2);
        $end_year = date('Y');
        $end_month = date('m');
        
        $DROITS_EN_HEURES_PAR_MOIS = 10;

        $nbmois = 0;
        if($end_year == $start_year){
            if($end_month < $start_month){
            } else {
                $nbmois = $end_month - $start_month + 1;
            }
        } else if($end_year < $start_year) {
        } else { 
            $nbYears = ($end_year - $start_year);
            $nbMonths = $end_month - $start_month + 1;
            $nbmois = ($nbYears * 12) + $nbMonths;
        }

        $droits = $nbmois * $DROITS_EN_HEURES_PAR_MOIS * 60;

        // TOTAL
        $droitsRestants = $droits - $duree;

/*         if($droitsRestants < 0) {
            $droitsRestants = 0;
        } */

        return $droitsRestants;


        //$dureeTotaleAutorisee = $_SESSION['datepartenaire'];

        //return 100;


        //return $tuples;
        //return $tuples[0]->getDureeEnHeures();
    }
    
    function getRemainingHoursPartenaire($idPartenaire, $datePartenaire) {
        $duree = $this->getRemainingMinutesPartenaire($idPartenaire, $datePartenaire);
        $dureeMn = $duree % 60;
        $dureeH = ($duree - $dureeMn) / 60;
        if($dureeMn < 10 && $dureeMn >= 0) {
            $dureeMn = "0".$dureeMn;
        } elseif($dureeMn < 0 && $dureeMn > -10) {
            $dureeMn = substr($dureeMn,0,1)."0".substr($dureeMn,1,1);
        }
        return $dureeH."h".$dureeMn;
    }

}