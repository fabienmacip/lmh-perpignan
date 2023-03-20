<?php

class Universs
{
    use Modele;

    // READ
    public function lister()
    {
        if (!is_null($this->pdo)) {
            $stmt = $this->pdo->query('SELECT * FROM univers ORDER BY nom');
        }
        $tuples = [];
        while ($tuple = $stmt->fetchObject('Univers', [$this->pdo])) {
            $tuples[] = $tuple;
        }
        $stmt->closeCursor();

        return $tuples;
    }

    public function listerOrderById()
    {
        if (!is_null($this->pdo)) {
            $stmt = $this->pdo->query('SELECT * FROM univers ORDER BY id');
        }
        $tuples = [];
        while ($tuple = $stmt->fetchObject('Univers', [$this->pdo])) {
            $tuples[] = $tuple;
        }
        $stmt->closeCursor();

        return $tuples;
    }
    // READ pour listes déroulantes
    public function listerJson()
    {
        if (!is_null($this->pdo)) {
            $stmt = $this->pdo->query('SELECT * FROM univers ORDER BY nom');
        }
        
        while ($tuple = $stmt->fetchObject('Univers', [$this->pdo])) {
            $tuples[] = [$tuple->getId(), $tuple->getNom(), $tuple->getSurnom()];
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

        return $tuples;
    }


    // CREATE
    public function create($nom, $surnom) {
        if (!is_null($this->pdo)) {
            try {
                // Requête mysql pour insérer des données
                $sql = "INSERT INTO univers (nom, surnom) VALUES (:nom, :surnom)";
                $res = $this->pdo->prepare($sql);
                $exec = $res->execute(array(":nom"=>$nom, ":surnom"=>$surnom));
                if($exec){
                    $tupleCreated = "L univers <b>".strtoupper($nom)." ".$surnom."</b> a bien été ajouté.";
                }
            }
            catch(Exception $e) {
                $tupleCreated = "L univers <b>".$nom."</b> n'a pas pu être ajouté.<br/><br/>".$e;
            }
        }
        
        return $tupleCreated;
    }

    // UPDATE
    public function update($id,$nom,$surnom) {
        if (!is_null($this->pdo)) {
            try {
                // Requête mysql pour insérer des données
                $sql = "UPDATE univers SET nom = (:nom), surnom = (:surnom) WHERE id = (:id)";
                $res = $this->pdo->prepare($sql);
                $exec = $res->execute(array(":nom"=>$nom, "surnom"=>$surnom, ":id"=>$id));
                if($exec){
                    $tupleUpdated = "L univers <b>".strtoupper($nom)." ".$surnom."</b> a bien été modifié.";
                }
            }
            catch(Exception $e) {
                $tupleUpdated = "L univers <b>".$nom."</b> n'a pas pu être modifié.<br/><br/>".$e;
            }
        }
        
        return $tupleUpdated;
    }


    // DELETE
    //Supprime 1 tuple de la BDD.
    public function delete($id, $nom)
    {
        if (!is_null($this->pdo)) {
            try{
                $this->pdo->query('DELETE FROM univers WHERE id = '.$id.'');
                $tupleDeleted = "L univers <b>".$nom."</b> a bien été supprimé.";
            }
            catch(Exception $e) {
                $tupleDeleted = "L univers <b>".$nom."</b> n'a pas pu être supprimé.<br/><br/>";
            }
        }
        
        return $tupleDeleted;
    }

    // ****************** FIN du CRUD *****************

}