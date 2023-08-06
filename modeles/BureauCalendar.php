<?php 

class BureauCalendar
{
    use Modele;

    private $id;
    private $idPartenaire;
    private $idBureau;
    private $date;
    private $heuredebut;
    private $isheuresup; // Heure saisie par un ADMIN, car le Partenaire n'avait plus de crédit d'heures.
    /* private $heurefin;
    private $duree; */ 

    public function read($id = '')
    {
        if (!is_null($this->pdo)) {
            $stmt = $this->pdo->prepare('SELECT * FROM bureaucalendar WHERE id = ?');
        }
        $tuple = [];//null;
        
        if ($stmt->execute([$id])) {
            $tuple = $stmt->fetchObject('BureauCalendar',[$this->pdo]);
            if (!is_object($tuple)) {
                $tuple = []; //null;
            }
        }
        $stmt->closeCursor();
        return $tuple;
    }

    public function getPartenaireNom($partenaireId)
    {
        if (!is_null($this->pdo)) {
            $stmt = $this->pdo->prepare('SELECT nom FROM partenaire WHERE id = ?');
        }
        $tuple = [];//null;
        
        if ($stmt->execute([$partenaireId])) {
            $tuple = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!is_array($tuple)) {
                $tuple = []; //null;
                return '';
            }
        }
        $stmt->closeCursor();
        return $tuple[0]["nom"];
    }

    public function getId()
    {
      return $this->id;
    }

    public function getIdPartenaire() {
      return $this->idPartenaire;
    }

    public function getIdBureau() {
      return $this->idBureau;
    }

    public function getDate() {
      return $this->date;
    }

    public function getHeureDebut() {
      return $this->heuredebut;
    }

    public function getIsHeureSup() {
      return $this->isheuresup;
    }


/*     public function getHeureFin() {
      return $this->heurefin;
    }

    public function getDuree() {
      return $this->duree;
    }
 */
    /* public function getDureeEnMinutes() {
      $hDeb = intval(substr($this->heuredebut,0,2));
      $mDeb = intval(substr($this->heuredebut,3,2));
      $hFin = intval(substr($this->heurefin,0,2));
      $mFin = intval(substr($this->heurefin,3,2));

      if($mDeb <= $mFin) {
        $duree = (($hFin - $hDeb) * 60) + ($mFin - $mDeb);
      } else {
        $duree = (($hFin - $hDeb) * 60) - 60 + ($mFin + 60 - $mDeb);
      }
      return $duree;
    } */

    /* public function getDureeEnHeures() {
      $duree = $this->getDureeEnMinutes();
      $dureeMn = $duree % 60;
      $dureeH = ($duree - $dureeMn) / 60;
      if($dureeMn < 10) {
        $dureeMn = "0".$dureeMn;
      }
      return $dureeH."h".$dureeMn;
    } */

}

