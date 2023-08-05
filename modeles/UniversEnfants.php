<?php

class UniversEnfants
{
    use Modele;

    // READ
    public function lister()
    {
        if (!is_null($this->pdo)) {
            $stmt = $this->pdo->query('SELECT * FROM universenfant ORDER BY nom');
        }
        $tuples = [];
        while ($tuple = $stmt->fetchObject('UniversEnfant', [$this->pdo])) {
            $tuples[] = $tuple;
        }
        $stmt->closeCursor();

        return $tuples;
    }

    // READ tous les UniversEnfants d'un Univers donné.
    public function listerFromUnivers($univers = 0)
    {
        if($univers >= 1 && $univers < 7){
            $universId = substr($univers,0,1);
            $where = 'WHERE univers = '.$universId.' ';
        }
        else {
            $where = '';
        }
        if (!is_null($this->pdo)) {
            $stmt = $this->pdo->query('SELECT * FROM universenfant '.$where.' ORDER BY nom');
        }
        $tuples = [];
        while ($tuple = $stmt->fetchObject('UniversEnfant', [$this->pdo])) {
            $tuples[] = $tuple;
        }
        $stmt->closeCursor();
        return $tuples;
    }

    public function listerOrderById()
    {
        if (!is_null($this->pdo)) {
            $stmt = $this->pdo->query('SELECT * FROM universenfant ORDER BY id');
        }
        $tuples = [];
        while ($tuple = $stmt->fetchObject('UniversEnfant', [$this->pdo])) {
            $tuples[] = $tuple;
        }
        $stmt->closeCursor();

        return $tuples;
    }

    public function listerOrderByUniversIdUniversEnfantId() {
        if (!is_null($this->pdo)) {
            $stmt = $this->pdo->query('SELECT * FROM universenfant ORDER BY univers, nom');
        }
        $tuples = [];
        
        $tuplesUnivers = [];
        $indexUnivers = 1;
        
        while ($tuple = $stmt->fetchObject('UniversEnfant', [$this->pdo])) {
            
            if($tuple->getUniversId() == $indexUnivers) {
                $tuplesUnivers[] = $tuple;
            } else {
                $indexUnivers++;
                $tuples[] = $tuplesUnivers;
                $tuplesUnivers = [];
                $tuplesUnivers[] = $tuple;
            }
        }

        $tuples[] = $tuplesUnivers;

        $stmt->closeCursor();

        return $tuples;
    }


    // READ pour listes déroulantes
    public function listerJson()
    {
        if (!is_null($this->pdo)) {
            $stmt = $this->pdo->query('SELECT * FROM universenfant ORDER BY nom');
        }
        
        while ($tuple = $stmt->fetchObject('UniversEnfant', [$this->pdo])) {
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
    public function create($nom, $univers, $surnom = '') {
        if (!is_null($this->pdo)) {
            try {
                // Requête mysql pour insérer des données
                $sql = "INSERT INTO universenfant (nom, surnom, univers) VALUES (:nom, :surnom, :univers)";
                $res = $this->pdo->prepare($sql);
                $exec = $res->execute(array(":nom"=>$nom, ":surnom"=>$surnom, "univers"=>$univers));
                if($exec){
                    $tupleCreated = "L univers enfant <b>".strtoupper($nom)." ".$nom."</b> a bien été ajouté.";
                }
            }
            catch(Exception $e) {
                $tupleCreated = "L univers enfant <b>".$nom."</b> n'a pas pu être ajouté.<br/><br/>".$e;
            }
        }
        
        return $tupleCreated;
    }

    // UPDATE
    public function update($id,$nom,$surnom,$univers) {
        if (!is_null($this->pdo)) {
            try {
                // Requête mysql pour insérer des données
                $sql = "UPDATE universenfant SET nom = (:nom), surnom = (:surnom), univers = (:univers) WHERE id = (:id)";
                $res = $this->pdo->prepare($sql);
                $exec = $res->execute(array(":nom"=>$nom, "surnom"=>$surnom, "univers"=>$univers, ":id"=>$id));
                if($exec){
                    $tupleUpdated = "L univers enfant <b>".strtoupper($nom)." ".$surnom."</b> a bien été modifié.";
                }
            }
            catch(Exception $e) {
                $tupleUpdated = "L univers enfant <b>".$nom."</b> n'a pas pu être modifié.<br/><br/>".$e;
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
                $this->pdo->query('DELETE FROM universenfant WHERE id = '.$id.'');
                $tupleDeleted = "L univers enfant <b>".$nom."</b> a bien été supprimé.";
            }
            catch(Exception $e) {
                $tupleDeleted = "L univers enfant <b>".$nom."</b> n'a pas pu être supprimé.<br/><br/>";
            }
        }
        
        return $tupleDeleted;
    }

    // ****************** FIN du CRUD *****************

}