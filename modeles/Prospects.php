<?php

class Prospects
{
    use Modele;

    // READ
    public function lister()
    {

        if (!is_null($this->pdo)) {
            $stmt = $this->pdo->query('SELECT * FROM prospect ORDER BY nom');
        }
        $tuples = [];
        while ($tuple = $stmt->fetchObject('Prospect', [$this->pdo])) {
            $tuples[] = $tuple;
        }
        $stmt->closeCursor();
        return $tuples;
    }

    // READ
    public function listerDernier()
    {

        if (!is_null($this->pdo)) {
            $stmt = $this->pdo->query('SELECT * FROM prospect ORDER BY id DESC LIMIT 1');
        }
        $tuples = [];
        while ($tuple = $stmt->fetchObject('Prospect', [$this->pdo])) {
            $tuples[] = $tuple;
        }
        $stmt->closeCursor();
        return $tuples;
    }


    // READ
    public function listerUn($prospectId = 0)
    {
        
        $prospectId = intval($prospectId);

        if (!is_null($this->pdo)) {
            $sql = 'SELECT * FROM prospect WHERE id = :id';
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([":id"=>$prospectId]);
        }
        $tuples = [];
        while ($tuple = $stmt->fetchObject('Prospect', [$this->pdo])) {
            $tuples[] = $tuple;
        }

        $stmt->closeCursor();

        return $tuples;
    }


    // READ pour listes déroulantes
    public function listerJson()
    {
        if (!is_null($this->pdo)) {
            $stmt = $this->pdo->query('SELECT * FROM prospect ORDER BY nom');
        }
        
        while ($tuple = $stmt->fetchObject('Prospect', [$this->pdo])) {
            $tuples[] = [$tuple->getId(), $tuple->getNom()];
        }

        return $tuples;
    }


    // CREATE
    public function create($nom, $prenom, $mail = '', $telephone = '', $dateokcookie = '') {
        if (!is_null($this->pdo)) {
            try {
                // Requête mysql pour insérer des données
                $aInserer = array(":nom"=>$nom, "prenom"=>$prenom, "mail"=>$mail, "telephone"=>$telephone, "dateokcookie"=>$dateokcookie);
                $sql = "INSERT INTO prospect (nom, prenom, mail, telephone, dateokcookie) VALUES (:nom, :prenom, :mail, :telephone, :dateokcookie)";
                $res = $this->pdo->prepare($sql);
                $exec = $res->execute($aInserer);
                if($exec){
                    $tupleCreated = "Le prospect <b>".strtoupper($nom)."</b> a bien été ajouté.";
                }
            }
            catch(Exception $e) {
                $tupleCreated = "Le prospect <b>".$nom."</b> n'a pas pu être ajouté.<br/><br/>".$e;
            }
        }
        
        return $tupleCreated;
    }

    // UPDATE
    public function update($id,$nom,$prenom, $mail = '', $telephone = '', $dateokcookie = '') {
        if (!is_null($this->pdo)) {
            try {
                // Requête mysql pour insérer des données
                $aInserer = array(":nom"=>$nom, ":prenom"=>$prenom, ":mail"=>$mail, "telephone"=>$telephone, ":dateokcookie"=>$dateokcookie, ":id"=>$id);
                $sql = "UPDATE prospect SET nom = (:nom), prenom = (:prenom), mail = (:mail), telephone = (:telephone), dateokcookie = (:dateokcookie) WHERE id = (:id)";
                $res = $this->pdo->prepare($sql);
                $exec = $res->execute($aInserer);
                if($exec){
                    $tupleUpdated = "Le prospect <b>".strtoupper($nom)."</b> a bien été modifié.";
                }
            }
            catch(Exception $e) {
                $tupleUpdated = "Le prospect <b>".$nom."</b> n'a pas pu être modifié.<br/><br/>".$e;
            }
        }
        
        return $tupleUpdated;
    }



    //Supprime 1 pays de la BDD.
    public function delete($id, $nom)
    {
        if($id != 0) {
            if (!is_null($this->pdo)) {
                try{
                    $this->pdo->query('DELETE FROM prospect WHERE id = '.$id.'');
                    $tupleDeleted = "Le prospect <b>".$nom."</b> a bien été supprimé.";
                }
                catch(Exception $e) {
                    $tupleDeleted = "Le prospect <b>".$nom."</b> n'a pas pu être supprimé.<br/><br/>";
                }
            }
            

        }
        return $tupleDeleted;
    }

    // ****************** FIN du CRUD *****************

}