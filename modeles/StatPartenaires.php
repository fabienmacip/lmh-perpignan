<?php

class StatPartenaires
{
    use Modele;

    // READ
    public function lister()
    {
        if (!is_null($this->pdo)) {
            $stmt = $this->pdo->query('SELECT * FROM statpartenaire');
        }
        $dates = [];
        while ($date = $stmt->fetchObject('StatPartenaire', [$this->pdo])) {
            $dates[] = $date;
        }
        $stmt->closeCursor();
        return $dates;
    }

    // READ pour listes déroulantes
    public function listerJson()
    {
        if (!is_null($this->pdo)) {
            $stmt = $this->pdo->query('SELECT * FROM statpartenaire ORDER BY date');
        }
        
        while ($date = $stmt->fetchObject('StatPartenaire', [$this->pdo])) {
            $dates[] = [$date->getId(), $date->getDate()];
        }

        return $dates;
    }


    // READ
    public function listerTout()
    {
        if (!is_null($this->pdo)) {
            $stmt = $this->pdo->query('SELECT PART.id as id, PART.nom as nom, STAT.date as date, STAT.total as total 
                                       FROM `statpartenaire` as STAT, `partenaire` as PART 
                                       WHERE STAT.partenaire = PART.id 
                                       ORDER BY PART.nom, STAT.date DESC');
        }
        $dates = [];
        while ($date = $stmt->fetchObject('StatPartenaireDetail', [$this->pdo])) {
            $dates[] = $date;
        }
        $stmt->closeCursor();
        return $dates;
    }



    // CREATE
    public function create($partenaire) {
        if (!is_null($this->pdo)) {
            $date = date('Y-m-d');

            try {

                $stmt = $this->pdo->prepare('SELECT * FROM statpartenaire WHERE partenaire = ? AND date= ?');
                $tuple = null;
                if ($stmt->execute([$partenaire, $date])) {
                    $tuple = $stmt->fetchObject('StatPartenaire',[$this->pdo]);
                    // Si pas encore de ligne pour cette DATE et ce PARTENAIRE => CREATE
                    if (!is_object($tuple)) {
                        $tuple = null;
                        $sql = "INSERT INTO statpartenaire (date, partenaire, total) VALUES (:date, :partenaire, 1)";
                        $res = $this->pdo->prepare($sql);
                        $exec = $res->execute(array("date"=>$date, "partenaire"=>$partenaire));
                    }
                    // Sinon, UPDATE
                    else {
                        $nbClics = $tuple->getTotal();
                        $id = $tuple->getId();
                        $nbClics++;
                        $sql = "UPDATE statpartenaire SET total = (:total) WHERE id = (:id)";
                        $res = $this->pdo->prepare($sql);
                        $exec = $res->execute(array("total"=>$nbClics, ":id"=>$id));
                    }
                }
                $stmt->closeCursor();
                // Si une ligne existe déjà pour cette date et ce partenaire, on UPDATE
/*                 if(!is_null($tuple)) {
                } 
 */                // Sinon, on CREATE
/*                 else {
 */                    // Requête mysql pour insérer des données
/*                 }
 */               

                if($exec){
                    $tupleCreated = "La stat <b>".strtoupper($date)."</b> du partenaire <b>".$partenaire."</b> a bien été ajoutée.";
                }
            }
            catch(Exception $e) {
                $tupleCreated = "La stat <b>".$date."</b> du partenaire <b>".$partenaire."</b> n'a pas pu être ajoutée.<br/><br/>".$e;
            }
        }
        
        return $tupleCreated;
    }

    // UPDATE
    public function update($id,$date,$partenaire,$total) {
        if (!is_null($this->pdo)) {
            try {
                // Requête mysql pour insérer des données
                $sql = "UPDATE statpartenaire SET date = (:date), total = (:total) WHERE id = (:id)";
                $res = $this->pdo->prepare($sql);
                $exec = $res->execute(array(":date"=>$date, "total"=>$total, ":id"=>$id));
                if($exec){
                    $tupleUpdated = "La stat <b>".strtoupper($date)."</b> du partenaire <b>".$partenaire."</b> a bien été modifiée.";
                }
            }
            catch(Exception $e) {
                $tupleUpdated = "La stat <b>".$date."</b> du partenaire <b>".$partenaire."</b> n'a pas pu être modifiée.<br/><br/>".$e;
            }
        }
        
        return $tupleUpdated;
    }


    // DELETE
    //Supprime 1 pays de la BDD.
    public function delete($id, $date, $partenaire)
    {
        if (!is_null($this->pdo)) {
            try{
                $this->pdo->query('DELETE FROM statpartenaire WHERE id = '.$id.'');
                $tupleDeleted = "La stat <b>".$date."</b> du partenaire <b>".$partenaire."</b> a bien été supprimée.";
            }
            catch(Exception $e) {
                $tupleDeleted = "La stat <b>".$date."</b> du partenaire <b>".$partenaire."</b> n'a pas pu être supprimée.<br/><br/>";
            }
        }
        
        return $tupleDeleted;
    }

    // ****************** FIN du CRUD *****************

}