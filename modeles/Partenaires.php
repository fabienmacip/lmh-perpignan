<?php

class Partenaires
{
    use Modele;

    // READ
    public function lister()
    {
        if (!is_null($this->pdo)) {
            $stmt = $this->pdo->query('SELECT * FROM partenaire ORDER BY nom');
        }
        $tuples = [];
        while ($tuple = $stmt->fetchObject('Partenaire', [$this->pdo])) {
            $tuples[] = $tuple;
        }
        $stmt->closeCursor();
        return $tuples;
    }

    // READ pour listes déroulantes
    public function listerJson()
    {
        if (!is_null($this->pdo)) {
            $stmt = $this->pdo->query('SELECT * FROM partenaire ORDER BY nom');
        }
        
        while ($tuple = $stmt->fetchObject('Partenaire', [$this->pdo])) {
            $tuples[] = [$tuple->getId(), $tuple->getNom()];
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
    public function create($nom, $univers, $actif = 1, $mail = '', $telephone = '') {
        if (!is_null($this->pdo)) {
            try {
                // Requête mysql pour insérer des données
                $aInserer = array(":nom"=>$nom, "mail"=>$mail, "telephone"=>$telephone, "univers"=>$univers, "actif"=>$actif);
                if($actif != 1) { $actif = 0; }
                $sql = "INSERT INTO partenaire (nom, mail, telephone, univers, actif) VALUES (:nom, :mail, :telephone, :univers, :actif)";
                $res = $this->pdo->prepare($sql);
                $exec = $res->execute($aInserer);
                if($exec){
                    $tupleCreated = "Le partenaire <b>".strtoupper($nom)."</b> a bien été ajouté.";
                }
            }
            catch(Exception $e) {
                $tupleCreated = "Le partenaire <b>".$nom."</b> n'a pas pu être ajouté.<br/><br/>".$e;
            }
        }
        
        return $tupleCreated;
    }

    // UPDATE
    public function update($id,$nom,$univers, $mail = '', $telephone = '', $actif = '') {
        if (!is_null($this->pdo)) {
            try {
                // Requête mysql pour insérer des données
                $aInserer = array(":nom"=>$nom, ":mail"=>$mail, "telephone"=>$telephone, ":univers"=>$univers, ":id"=>$id);
                if($actif == 1 || $actif != '') {
                    array_push($aInserer, $actif);
                    $sql = "UPDATE partenaire SET nom = (:nom), mail = (:mail), telephone = (:telephone), univers = (:univers), actif = (:actif) WHERE id = (:id)";
                } else {
                    $sql = "UPDATE partenaire SET nom = (:nom), mail = (:mail), telephone = (:telephone), univers = (:univers) WHERE id = (:id)";
                }
                $res = $this->pdo->prepare($sql);
                $exec = $res->execute($aInserer);
                if($exec){
                    $tupleUpdated = "Le partenaire <b>".strtoupper($nom)."</b> a bien été modifié.";
                }
            }
            catch(Exception $e) {
                $tupleUpdated = "Le partenaire <b>".$nom."</b> n'a pas pu être modifié.<br/><br/>".$e;
            }
        }
        
        return $tupleUpdated;
    }


    // DELETE2
    //Supprime 1 pays de la BDD.
    public function delete($id, $nom)
    {
        if (!is_null($this->pdo)) {
            try{
                $this->pdo->query('DELETE FROM partenaire WHERE id = '.$id.'');
                $tupleDeleted = "Le partenaire <b>".$nom."</b> a bien été supprimé.";
            }
            catch(Exception $e) {
                $tupleDeleted = "Le partenaire <b>".$nom."</b> n'a pas pu être supprimé.<br/><br/>";
            }
        }
        
        return $tupleDeleted;
    }

    // ****************** FIN du CRUD *****************

}