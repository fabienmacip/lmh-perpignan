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


    // CREATE
    public function create($partenaire) {
        if (!is_null($this->pdo)) {
            $date = date('Y-m-d');

            try {

                

                // Requête mysql pour insérer des données
                $sql = "INSERT INTO statpartenaire (date, partenaire) VALUES (:date, :partenaire)";
                $res = $this->pdo->prepare($sql);
                $exec = $res->execute(array("date"=>$date, "partenaire"=>$partenaire));
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
    public function update($id,$date,$partenaire) {
        if (!is_null($this->pdo)) {
            try {
                // Requête mysql pour insérer des données
                $sql = "UPDATE statpartenaire SET date = (:date) WHERE id = (:id)";
                $res = $this->pdo->prepare($sql);
                $exec = $res->execute(array(":date"=>$date, ":id"=>$id));
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