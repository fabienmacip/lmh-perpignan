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

    // READ
    // $currentYearMonth de type : 202307 (juillet 2023)
    public function readAllForOneBureau($currentYear, $currentMonth, $bureauId)
    {
        if (!is_null($this->pdo)) {
            $stmt = $this->pdo->query('SELECT * FROM bureaucalendar WHERE (date LIKE "%'.$currentYear.'-'.$currentMonth.'%") AND (idBureau = '.$bureauId.')');
        }
        
        $tuples = [];
        
        while ($tuple = $stmt->fetchObject('BureauCalendar', [$this->pdo])) {
            $tuples[] = $tuple;
        }
        $stmt->closeCursor();

        return $tuples;
    }

    // READ
    public function listerDernier()
    {

        if (!is_null($this->pdo)) {
            $stmt = $this->pdo->query('SELECT * FROM bureaucalendar ORDER BY id DESC LIMIT 1');
        }
        $tuples = [];
        while ($tuple = $stmt->fetchObject('BureauCalendar', [$this->pdo])) {
            $tuples[] = $tuple;
        }
        $stmt->closeCursor();
        return $tuples;
    }

    public function findPartenaireDate($idPartenaire)
    {
        $idPartenaire = intval($idPartenaire);
        if (!is_null($this->pdo)) {
            $req = $this->pdo->prepare('SELECT date_creation FROM administrateur WHERE partenaire = '.$idPartenaire);
            $req->execute();
            $data=$req->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data[0]["date_creation"];
    }


    // CREATE
    public function create($partenaireId,$bureauId,$jour,$heure,$isHeureSup = 0) {
        $tupleCreated = false;
        
        if (!is_null($this->pdo)) {
            try {
                // Requête mysql pour insérer des données
                $aInserer = array(":partenaireId"=>$partenaireId, ":bureauId"=>$bureauId, ":jour"=>$jour, ":heure"=>$heure, "isheuresup"=>$isHeureSup);
                $sql = "INSERT INTO bureaucalendar (idPartenaire, idBureau, date, heuredebut, isheuresup) VALUES (:partenaireId, :bureauId, :jour, :heure, :isheuresup)";
                $res = $this->pdo->prepare($sql);
                $exec = $res->execute($aInserer);
                if($exec){
                    $tupleCreated = true; //"Le créneau <b>".strtoupper($heure)."</b> a bien été ajouté.";
                }
            }
            catch(Exception $e) {
                $tupleCreated = false;//"Le créneau <b>".$heure."</b> n'a pas pu être ajouté.<br/><br/>".$e;
            }
        }
        
        return $tupleCreated;
    }

    public function deleteWithoutId($partenaireId,$bureauId,$jour,$heure){

        if (!is_null($this->pdo)) {
            try{
                $sql = 'DELETE FROM bureaucalendar WHERE idPartenaire = :idPartenaire AND idBureau = :idBureau AND date = :date AND heuredebut = :heuredebut';
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute(['idPartenaire' => $partenaireId, 'idBureau'=>$bureauId, 'date'=>$jour, 'heuredebut'=>$heure]);
                if($stmt->rowCount() == 1) {
                    $tupleDeleted = "Le créneau <b>".$heure."</b> a bien été supprimé.";
                }
            }
            catch(Exception $e) {
                $tupleDeleted = "Le créneau <b>".$heure."</b> n'a pas pu être supprimé.<br/><br/>".$e;
            }
        }

        return $stmt->rowCount();
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

    public function nbCreneauJourReserve($idBureau, $date) {

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

        return count($tuples);

    }

    // Liste des créneaux horaires pour UN jour donnée
    public function listHoursReservedByPartenaire($dateSQL,$idPartenaire,$idBureau){
        
        if (!is_null($this->pdo)) {
            $sql = 'SELECT * FROM bureaucalendar WHERE idBureau = :idBureau AND date = :date AND idPartenaire = :idPartenaire AND isheuresup = 0';
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([":idBureau"=>$idBureau, ":date"=>$dateSQL, ":idPartenaire"=>$idPartenaire]);
        }
        $tuples = '';
        while ($tuple = $stmt->fetchObject('BureauCalendar', [$this->pdo])) {
            $tuples .= $tuple->getHeureDebut()."/";
        }
        
        $stmt->closeCursor();

        if(strlen($tuples) > 0) {
            $tuples = substr($tuples,0,-1);
        }
        
        return $tuples;

    }

    // Liste des créneaux horaires pour UN jour donnée, pour LE partenaire, en heures sups
    public function listHoursReservedForPartenaire($dateSQL,$idPartenaire,$idBureau){
        
        if (!is_null($this->pdo)) {
            $sql = 'SELECT * FROM bureaucalendar WHERE idBureau = :idBureau AND date = :date AND idPartenaire = :idPartenaire AND isheuresup = 1';
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([":idBureau"=>$idBureau, ":date"=>$dateSQL, ":idPartenaire"=>$idPartenaire]);
        }
        $tuples = '';
        while ($tuple = $stmt->fetchObject('BureauCalendar', [$this->pdo])) {
            $tuples .= $tuple->getHeureDebut()."/";
        }
        
        $stmt->closeCursor();

        if(strlen($tuples) > 0) {
            $tuples = substr($tuples,0,-1);
        }
        
        return $tuples;

    }

    // Liste des créneaux horaires pour UN jour donnée
    public function listHoursReservedByAnotherPartenaire($dateSQL,$idPartenaire,$idBureau) {
        if (!is_null($this->pdo)) {
            $sql = 'SELECT * FROM bureaucalendar WHERE idBureau = :idBureau AND date = :date AND idPartenaire <> :idPartenaire';
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([":idBureau"=>$idBureau, ":date"=>$dateSQL, ":idPartenaire"=>$idPartenaire]);
        }
        $tuples = '';
        while ($tuple = $stmt->fetchObject('BureauCalendar', [$this->pdo])) {
            $tuples .= $tuple->getHeureDebut()."/";
        }
        
        $stmt->closeCursor();

        if(strlen($tuples) > 0) {
            $tuples = substr($tuples,0,-1);
        }
        
        return $tuples;

    }

    // Liste des créneaux horaires pour UN jour donnée, avec idPartenaire, pour calendrier en mode ADMIN
    public function listHoursReservedByAnotherPartenaireAndIdPartenaire($dateSQL,$idPartenaire,$idBureau) {
        if (!is_null($this->pdo)) {
            $sql = 'SELECT * FROM bureaucalendar WHERE idBureau = :idBureau AND date = :date AND idPartenaire <> :idPartenaire';
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([":idBureau"=>$idBureau, ":date"=>$dateSQL, ":idPartenaire"=>$idPartenaire]);
        }
        $tuples = '';
        while ($tuple = $stmt->fetchObject('BureauCalendar', [$this->pdo])) {

            $tuples .= $tuple->getHeureDebut()."&-&".$tuple->getIdPartenaire()."&-&".$tuple->getPartenaireNom($tuple->getIdPartenaire())."/";
        }
        
        $stmt->closeCursor();

        if(strlen($tuples) > 0) {
            $tuples = substr($tuples,0,-1);
        }
        
        return $tuples;

    }
    
    // $day au format YYYY-MM-JJ
    function getWeekStartDay($day) {
        $day2array = explode("-",$day);
        $day2 = $day2array[2]."-".$day2array[1]."-".$day2array[0];
        $custom_date = strtotime( date('d-m-Y', strtotime($day2)) ); 
        return date('Y-m-d', strtotime('this week monday', $custom_date));
    }

    function getWeekEndDay($day) {
        $day2array = explode("-",$day);
        $day2 = $day2array[2]."-".$day2array[1]."-".$day2array[0];
        $custom_date = strtotime( date('d-m-Y', strtotime($day2)) ); 
        return date('Y-m-d', strtotime('this week sunday', $custom_date));
    }

    // Un partenaire a droit à 6 heures de réservation par semaine, non cumulable.
    // $day au format : YYYY-MM-DD
    function getRemainingWeekHoursPartenaire($idPartenaire, $day) {
                
        // Etablissement de la liste des dates de la même semaine que $day.
        $dayCalculable = strtotime($day);
        $year = date('Y',$dayCalculable);
        $week = date('W',$dayCalculable);
        //$days = $this->week2str($year, $week);

        $week_start = $this->getWeekStartDay($day);
        $week_end = $this->getWeekEndDay($day);

        $idPartenaire = intval($idPartenaire);
        
        if (!is_null($this->pdo)) {
            $stmt = $this->pdo->prepare('SELECT * FROM bureaucalendar WHERE idPartenaire = :idPartenaire AND isheuresup = 0 AND date BETWEEN :week_start AND :week_end');
            $stmt->execute([":idPartenaire"=>$idPartenaire, ":week_start"=> $week_start, ":week_end"=>$week_end]);
        }
        $tuples = [];
        while ($tuple = $stmt->fetchObject('BureauCalendar', [$this->pdo])) {
            $tuples[] = $tuple;
        }
        $stmt->closeCursor();

        // Calcul durée déjà utilisé (en minutes)
        $duree = 0; // Durée déjà utilisée

        // DUREE : une ligne = 1 heure
        $duree = count($tuples);

        $DROITS_EN_HEURES_PAR_SEMAINE = 6;

        // TOTAL
        $droitsRestants = $DROITS_EN_HEURES_PAR_SEMAINE - $duree;

        return $droitsRestants;

    }

    function getRemainingHoursPartenairePerWeek($idPartenaire, $currentMonth){
        var_dump($currentMonth);
    }
    
    function getRemainingHoursPartenaire($idPartenaire, $day) {
        $duree = $this->getRemainingWeekHoursPartenaire($idPartenaire, $day);
        return $duree;
    }
    























    // Cette fonction n'est plus utilisée. Elle était utile lorsque on était en créneaux de 30mn.
    function getRemainingMinutesPartenaire($idPartenaire, $datePartenaire) {
                
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
        
                // DUREE = nombre de tuples x 30mn
                $duree = count($tuples) * 30;
        
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
        
        
                return $droitsRestants;
        
    }

    function anciengetRemainingHoursPartenaire($idPartenaire, $datePartenaire) {
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
    
    function anciengetRemainingHoursPartenaireSansDate($idPartenaire) {
        
        $datePartenaire = $this->findPartenaireDate($idPartenaire);
        //var_dump($datePartenaire[0]["date_creation"]);
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

