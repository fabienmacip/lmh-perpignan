<?php

require_once(dirname(__FILE__,2).'/modeles/Modele.php');
class Controleur4 {
     use Modele; 

    public function addCreneauHoraire($partenaireId,$bureauId,$jour,$heure)
    {
        
        //$pdo = $this->pdo;
        $tuples = new BureauCalendars($this->pdo);
        $dernierTupleConnu = $tuples->listerDernier()[0]->getId();
        
        $tupleToCreate = $tuples->create($partenaireId,$bureauId,$jour,$heure);
        $newTuple = $tuples->listerDernier()[0]->getId();
        
        if($newTuple > $dernierTupleConnu) {
            return true;
        } else {
            return false;
        }
    }

    public function removeCreneauHoraire($partenaireId,$bureauId,$jour,$heure)
    {
        $tuples = new BureauCalendars($this->pdo);
        $tupleASupprimer = $tuples->deleteWithoutId($partenaireId,$bureauId,$jour,$heure);
        
        return $tupleASupprimer == 1;
    }

    public function reloadRemainingHours($idPartenaire)
    {
        $calendarsObject = new BureauCalendars($this->pdo);
        //$remainingMinutes = $calendarsObject->getRemainingMinutesPartenaire(intval($_SESSION["partenaire"]),$_SESSION["datepartenaire"]);
        $remainingHours = $calendarsObject->getRemainingHoursPartenaireSansDate(intval($idPartenaire));
        return $remainingHours;
    }

    public function getBureauById($id) {
        $bureau = new Bureau($this->pdo);
        $bureau = $bureau->read($id);
        return $bureau;
    }

    public function getMonthFromBureau($moisan, $id) {
        $calendarsObject = new BureauCalendars($this->pdo);
        //$remainingMinutes = $calendarsObject->getRemainingMinutesPartenaire(intval($_SESSION["partenaire"]),$_SESSION["datepartenaire"]);
        //$remainingHours = $calendarsObject->getRemainingHoursPartenaire(intval($_SESSION["partenaire"]),$_SESSION["datepartenaire"]);
        $calendars = $calendarsObject->readAllForOneBureau($moisan, $id);
    
    }
}