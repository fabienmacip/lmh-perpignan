<?php

require_once(dirname(__FILE__,2).'/modeles/Modele.php');
class Controleur4 {
     use Modele; 

    public function addCreneauHoraire($partenaireId,$bureauId,$jour,$heure,$isHeureSup = 0)
    {
        
        //$pdo = $this->pdo;
        $tuples = new BureauCalendars($this->pdo);
        $dernierTupleConnu = $tuples->listerDernier()[0]->getId();
        
        $tupleToCreate = $tuples->create($partenaireId,$bureauId,$jour,$heure,$isHeureSup);
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

    public function reloadRemainingHours($idPartenaire, $day)
    {
        $calendarsObject = new BureauCalendars($this->pdo);
        //$remainingMinutes = $calendarsObject->getRemainingMinutesPartenaire(intval($_SESSION["partenaire"]),$_SESSION["datepartenaire"]);
        $remainingHours = $calendarsObject->getRemainingHoursPartenaire(intval($idPartenaire), $day);
        return $remainingHours;
    }

    public function getBureauById($id) {
        $bureau = new Bureau($this->pdo);
        $bureau = $bureau->read($id);
        return $bureau;
    }

    public function getMonthFromBureau($an, $mois, $id) {
        $calendarsObject = new BureauCalendars($this->pdo);
        return $calendarsObject;
    }


/* ****************** CALENDAR ADMIN ****************** */

    public function listeCalendarsAdmin()
    {

        require(dirname(__FILE__,2).'/services/moisFrancaisEtDateActuelle.php'); 
        $bureaux = new Bureaus($this->pdo);
        $nbBureaux = $bureaux->readNbTuples();
        $bureaux = $bureaux->lister();
    
        $calendarsObject = new BureauCalendars($this->pdo);
        //$currentMonth = date('Y-m');
        $calendars = $calendarsObject->readAll();
    
        $partenaireActif = new Partenaires($this->pdo);
        $partenaireActif = $partenaireActif->listerUn($_SESSION["partenaireActuel"]);

        //var_dump($_SESSION['partenaireActuel']);

        require(dirname(__FILE__,2).'/vues/liste-calendriers-admin.php');
    }
    

}