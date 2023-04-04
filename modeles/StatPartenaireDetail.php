<?php

class StatPartenaireDetail
{
    use Modele;

    private $id;
    private $nom;
    private $date;
    private $total;

    public function getId()
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getDate()
    {
        return $this->date;
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

    private function jourSemaineCourt($jour){
        switch($jour) {
            case 0:
                return "di";
                break;
            case 1:
                return "lu";
                break;
            case 2:
                return "ma";
                break;
            case 3:
                return "me";
                break;
            case 4:
                return "je";
                break;
            case 5:
                return "ve";
                break;
            case 6:
                return "sa";
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

    private function moisLettresCourt($mois) {
        switch($mois) {
            case "01":
                return "jan";
                break;
            case "02":
                return "fév";
                break;
            case "03":
                return "mar";
                break;
            case "04":
                return "avr";
                break;
            case "05":
                return "mai";
                break;
            case "06":
                return "jui";
                break;
            case "07":
                return "jul";
                break;
            case "08":
                return "aoû";
                break;
            case "09":
                return "sep";
                break;
            case "10":
                return "oct";
                break;
            case "11":
                return "nov";
                break;
            case "12":
                return "déc";
                break;                

            default:
                return "";
        }       
    }


    public function getDateCourt()
    {
            $dt = DateTime::createFromFormat('Y-m-d', $this->date);
            $jour = $dt->format('d');
            $mois = $this->moisLettresCourt($dt->format('m'));
            $an = $dt->format('y');
            $jourSemaine = $this->jourSemaineCourt($dt->format('w'));
    
            $dateLong = $jourSemaine." ".$jour." ".$mois." ".$an;
    
            return $dateLong;
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