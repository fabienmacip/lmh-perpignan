<?php

class MyDates
{
    use Modele;

    // READ
    public function listerDate()
    {
        if (!is_null($this->pdo)) {
            $stmt = $this->pdo->query('SELECT * FROM dates');
        }
        $dates = [];
        while ($date = $stmt->fetchObject('MyDate', [$this->pdo])) {
            $dates[] = $date;
        }
        $stmt->closeCursor();
        return $dates;
    }

    // READ pour listes déroulantes
    public function listerDateJson()
    {
        if (!is_null($this->pdo)) {
            $stmt = $this->pdo->query('SELECT * FROM dates ORDER BY date');
        }
        
        while ($date = $stmt->fetchObject('MyDate', [$this->pdo])) {
            $dates[] = [$date->getId(), $date->getDate()];
        }

/*         $json = '{';
        foreach ($payss as $pays):
            $json .= "{\"id\" : \"".$pays[0]."\",\"nom\" : \"".$pays[1]."\"},";
        endforeach;
        $json = substr($json,0,-1);
        $json .= '}'; */
        
        /* $json = '[';
            foreach ($payss as $pays):
                $json .= '['.$pays[0].',"'.$pays[1].'"],';
            endforeach;
            $json = substr($json,0,-1);
            $json .= ']'; */
            
        //$payssForJson = (object) json_decode(json_encode($payss));

        return $dates;
    }


    // CREATE
    public function createDate($date) {
        if (!is_null($this->pdo)) {
            try {
                // Requête mysql pour insérer des données
                $sql = "INSERT INTO dates (date) VALUES (:date)";
                $res = $this->pdo->prepare($sql);
                $exec = $res->execute(array(":date"=>$date));
                if($exec){
                    $tupleCreated = "La date <b>".strtoupper($date)."</b> a bien été ajoutée.";
                }
            }
            catch(Exception $e) {
                $tupleCreated = "La date <b>".$date."</b> n'a pas pu être ajoutée.<br/><br/>".$e;
            }
        }
        
        return $tupleCreated;
    }

    // UPDATE
    public function updateDate($id,$date) {
        if (!is_null($this->pdo)) {
            try {
                // Requête mysql pour insérer des données
                $sql = "UPDATE dates SET date = (:date) WHERE id = (:id)";
                $res = $this->pdo->prepare($sql);
                $exec = $res->execute(array(":date"=>$date, ":id"=>$id));
                if($exec){
                    $tupleUpdated = "La date <b>".strtoupper($date)."</b> a bien été modifiée.";
                }
            }
            catch(Exception $e) {
                $tupleUpdated = "La date <b>".$date."</b> n'a pas pu être modifiée.<br/><br/>".$e;
            }
        }
        
        return $tupleUpdated;
    }


    // DELETE
    //Supprime 1 pays de la BDD.
    public function deleteDate($id, $date)
    {
        if (!is_null($this->pdo)) {
            try{
                $this->pdo->query('DELETE FROM dates WHERE id = '.$id.'');
                $tupleDeleted = "La date <b>".$date."</b> a bien été supprimée.";
            }
            catch(Exception $e) {
                $tupleDeleted = "La date <b>".$date."</b> n'a pas pu être supprimée.<br/><br/>";
            }
        }
        
        return $tupleDeleted;
    }

    // ****************** FIN du CRUD *****************

}