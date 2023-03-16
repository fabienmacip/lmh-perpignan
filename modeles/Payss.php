<?php

class Payss
{
    use Modele;

    // READ
    public function listerPays()
    {
        if (!is_null($this->pdo)) {
            $stmt = $this->pdo->query('SELECT * FROM chasseurs ORDER BY nom, prenom');
        }
        $payss = [];
        while ($pays = $stmt->fetchObject('Pays', [$this->pdo])) {
            $payss[] = $pays;
        }
        $stmt->closeCursor();
        return $payss;
    }

    // READ pour listes déroulantes
    public function listerPaysJson()
    {
        if (!is_null($this->pdo)) {
            $stmt = $this->pdo->query('SELECT * FROM chasseurs ORDER BY nom');
        }
        
        while ($pays = $stmt->fetchObject('Pays', [$this->pdo])) {
            $payss[] = [$pays->getId(), $pays->getNom(), $pays->getPrenom()];
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

        return $payss;
    }


    // CREATE
    public function createPays($nom, $prenom) {
        if (!is_null($this->pdo)) {
            try {
                // Requête mysql pour insérer des données
                $sql = "INSERT INTO chasseurs (nom, prenom) VALUES (:nom, :prenom)";
                $res = $this->pdo->prepare($sql);
                $exec = $res->execute(array(":nom"=>$nom, ":prenom"=>$prenom));
                if($exec){
                    $tupleCreated = "Le chasseur <b>".strtoupper($nom)." ".$prenom."</b> a bien été ajouté.";
                }
            }
            catch(Exception $e) {
                $tupleCreated = "Le chasseur <b>".$nom."</b> n'a pas pu être ajouté.<br/><br/>".$e;
            }
        }
        
        return $tupleCreated;
    }

    // UPDATE
    public function updatePays($id,$nom,$prenom) {
        if (!is_null($this->pdo)) {
            try {
                // Requête mysql pour insérer des données
                $sql = "UPDATE chasseurs SET nom = (:nom), prenom = (:prenom) WHERE id = (:id)";
                $res = $this->pdo->prepare($sql);
                $exec = $res->execute(array(":nom"=>$nom, "prenom"=>$prenom, ":id"=>$id));
                if($exec){
                    $tupleUpdated = "Le chasseur <b>".strtoupper($nom)." ".$prenom."</b> a bien été modifié.";
                }
            }
            catch(Exception $e) {
                $tupleUpdated = "Le chasseur <b>".$nom."</b> n'a pas pu être modifié.<br/><br/>".$e;
            }
        }
        
        return $tupleUpdated;
    }


    // DELETE
    //Supprime 1 pays de la BDD.
    public function deletePays($id, $nom)
    {
        if (!is_null($this->pdo)) {
            try{
                $this->pdo->query('DELETE FROM chasseurs WHERE id = '.$id.'');
                $tupleDeleted = "Le chasseur <b>".$nom."</b> a bien été supprimé.";
            }
            catch(Exception $e) {
                $tupleDeleted = "Le chasseur <b>".$nom."</b> n'a pas pu être supprimé.<br/><br/>";
            }
        }
        
        return $tupleDeleted;
    }

    // ****************** FIN du CRUD *****************

}