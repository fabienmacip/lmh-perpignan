<?php 

class BureauCalendar
{
    use Modele;

    private $id;
    private $idPartenaire;
    private $idBureau;
    private $date;
    private $heuredebut;
    private $heurefin;

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

    public function getHeureFin() {
      return $this->heurefin;
    }

    public function getDureeEnMinutes() {
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
    }

}
