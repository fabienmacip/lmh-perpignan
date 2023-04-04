<?php

class StatPartenaire
{
    use Modele;

    private $id;
    private $date;
    private $partenaire;
    private $total;

    public function afficherUn($id)
    {
        if (!is_null($this->pdo)) {
            $stmt = $this->pdo->prepare('SELECT * FROM statpartenaire WHERE id = ?');
        }
        $tuple = null;
        if ($stmt->execute([$id])) {
            $tuple = $stmt->fetchObject('StatPartenaire',[$this->pdo]);
            if (!is_object($tuple)) {
                $tuple = null;
            }
        }
        $stmt->closeCursor();
        return $tuple;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getPartenaire()
    {
        return $this->partenaire;
    }

    public function getTotal()
    {
        return $this->total;
    }

    private function jourSemaine($jour){
        switch($jour) {
            case 0:
                return "dimanche";
                break;
            case 1:
                return "lundi";
                break;
            case 2:
                return "mardi";
                break;
            case 3:
                return "mercredi";
                break;
            case 4:
                return "jeudi";
                break;
            case 5:
                return "vendredi";
                break;
            case 6:
                return "samedi";
                break;
            default:
                return "";
        }
    }

    private function moisLettres($mois) {
        switch($mois) {
            case "01":
                return "janvier";
                break;
            case "02":
                return "février";
                break;
            case "03":
                return "mars";
                break;
            case "04":
                return "avril";
                break;
            case "05":
                return "mai";
                break;
            case "06":
                return "juin";
                break;
            case "07":
                return "juillet";
                break;
            case "08":
                return "août";
                break;
            case "09":
                return "septembre";
                break;
            case "10":
                return "octobre";
                break;
            case "11":
                return "novembre";
                break;
            case "12":
                return "décembre";
                break;                

            default:
                return "";
        }       
    }

    public function getDateLong()
    {
            $dt = DateTime::createFromFormat('Y-m-d', $this->date);
            $jour = $dt->format('d');
            $mois = $this->moisLettres($dt->format('m'));
            $an = $dt->format('Y');
            $jourSemaine = $this->jourSemaine($dt->format('w'));
    
            $dateLong = $jourSemaine." ".$jour." ".$mois." ".$an;
    
            return $dateLong;
    }


}