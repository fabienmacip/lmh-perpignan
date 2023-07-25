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

    public function reloadRemainingHours($idPartenaire)
    {
        $calendarsObject = new BureauCalendars($this->pdo);
        //$remainingMinutes = $calendarsObject->getRemainingMinutesPartenaire(intval($_SESSION["partenaire"]),$_SESSION["datepartenaire"]);
        $remainingHours = $calendarsObject->getRemainingHoursPartenaireSansDate(intval($idPartenaire));
        return $remainingHours;
    }
}