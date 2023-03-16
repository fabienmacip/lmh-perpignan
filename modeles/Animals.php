<?php

class Animals
{
    use Modele;

    // READ
    public function listerAnimal()
    {
        if (!is_null($this->pdo)) {
            $stmt = $this->pdo->query('SELECT * FROM animaux ORDER BY nom');
        }
        $animals = [];
        while ($animal = $stmt->fetchObject('Animal', [$this->pdo])) {
            $animals[] = $animal;
        }
        $stmt->closeCursor();
        return $animals;
    }

    // READ pour listes déroulantes
    public function listerAnimalJson()
    {
        if (!is_null($this->pdo)) {
            $stmt = $this->pdo->query('SELECT * FROM animaux ORDER BY nom');
        }
        
        while ($animal = $stmt->fetchObject('Animal', [$this->pdo])) {
            $animals[] = [$animal->getId(), $animal->getNom()];
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

        return $animals;
    }


    // CREATE
    public function createAnimal($nom) {
        if (!is_null($this->pdo)) {
            try {
                // Requête mysql pour insérer des données
                $sql = "INSERT INTO animaux (nom) VALUES (:nom)";
                $res = $this->pdo->prepare($sql);
                $exec = $res->execute(array(":nom"=>$nom));
                if($exec){
                    $tupleCreated = "L'animal <b>".strtoupper($nom)."</b> a bien été ajouté.";
                }
            }
            catch(Exception $e) {
                $tupleCreated = "L'animal <b>".$nom."</b> n'a pas pu être ajouté.<br/><br/>".$e;
            }
        }
        
        return $tupleCreated;
    }

    // UPDATE
    public function updateAnimal($id,$nom) {
        if (!is_null($this->pdo)) {
            try {
                // Requête mysql pour insérer des données
                $sql = "UPDATE animaux SET nom = (:nom) WHERE id = (:id)";
                $res = $this->pdo->prepare($sql);
                $exec = $res->execute(array(":nom"=>$nom, ":id"=>$id));
                if($exec){
                    $tupleUpdated = "L'animal <b>".strtoupper($nom)."</b> a bien été modifié.";
                }
            }
            catch(Exception $e) {
                $tupleUpdated = "L'animal <b>".$nom."</b> n'a pas pu être modifié.<br/><br/>".$e;
            }
        }
        
        return $tupleUpdated;
    }


    // DELETE
    //Supprime 1 pays de la BDD.
    public function deleteAnimal($id, $nom)
    {
        if (!is_null($this->pdo)) {
            try{
                $this->pdo->query('DELETE FROM animaux WHERE id = '.$id.'');
                $tupleDeleted = "L'animal <b>".$nom."</b> a bien été supprimé.";
            }
            catch(Exception $e) {
                $tupleDeleted = "L'animal <b>".$nom."</b> n'a pas pu être supprimé.<br/><br/>";
            }
        }
        
        return $tupleDeleted;
    }

    // ****************** FIN du CRUD *****************

}