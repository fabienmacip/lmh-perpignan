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

    public function getRemainingHoursPartenaire($idPartenaire) {
        
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



        //return $tuples;
        return 100;
    }
    // READ pour listes déroulantes
/*     public function listerPaysJson()
    {
        if (!is_null($this->pdo)) {
            $stmt = $this->pdo->query('SELECT * FROM pays ORDER BY nom');
        }
        
        while ($pays = $stmt->fetchObject('Pays', [$this->pdo])) {
            $payss[] = [$pays->getId(), $pays->getNom()];
        }

        return $payss;
    }
 */

}