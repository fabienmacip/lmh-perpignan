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

    public function readNbTuples() {
      //$stmt = $this->pdo->query('SELECT COUNT(*) FROM bureaucalendar');
      $req = $this->pdo->prepare('SELECT COUNT(*) as total FROM bureau');
      $req->execute();
      $data=$req->fetchAll(PDO::FETCH_ASSOC);
      return $data;
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