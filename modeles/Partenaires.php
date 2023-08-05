<?php

class Partenaires
{
    use Modele;

    // READ
    public function lister($actif = 1)
    {
        if($actif == 2){
            $actif = '';
        }
        else {
            $actif = 'WHERE actif ='.$actif.' ';
        }
        if (!is_null($this->pdo)) {
            $stmt = $this->pdo->query('SELECT * FROM partenaire '.$actif.' ORDER BY nom');
        }
        $tuples = [];
        while ($tuple = $stmt->fetchObject('Partenaire', [$this->pdo])) {
            $tuples[] = $tuple;
        }
        $stmt->closeCursor();
        return $tuples;
    }

    public function listerUn($id = 0)
    {

        $tupleId = intval($id);

        if (!is_null($this->pdo)) {
            $sql = 'SELECT * FROM partenaire WHERE id = :id';
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([":id"=>$tupleId]);
        }
        $tuples = [];
        while ($tuple = $stmt->fetchObject('Partenaire', [$this->pdo])) {
            $tuples[] = $tuple;
        }

        $stmt->closeCursor();

        return $tuples;

    }

    public function listerOrderByUniversEnfantId($actif = 1) 
    {
        if($actif == 2){
            $actif = '';
        }
        else {
            $actif = 'WHERE actif ='.$actif.' ';
        }
        if (!is_null($this->pdo)) {
            $stmt = $this->pdo->query('SELECT * FROM partenaire '.$actif.' ORDER BY univers, universenfant, nom');
        }
        $tuples = [];

        $tuplesUnivers = [];
        $indexUnivers = 1;
        
        while ($tuple = $stmt->fetchObject('Partenaire', [$this->pdo])) {
            if($tuple->getUnivers() == $indexUnivers) {
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

    // READ
    public function listerFromUnivers($univers = 0)
    {
        
        $universId = intval($univers);

        if($universId == 0){
            $whereUnivers = '';
        }
        else {
            $whereUnivers = $universId;
        }


        if (!is_null($this->pdo)) {
            $sql = 'SELECT * FROM partenaire WHERE univers LIKE "%'.$whereUnivers.'%" ORDER BY nom';
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
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
    public function create($nom, $univers, $actif = 1, $mail = '', $telephone = '', $universenfant = '', $nomContact = '', $activiteEntreprise = '') {
        
        //ICI, utiliser $nomEntreprise, $activiteEntreprise
        
        if (!is_null($this->pdo)) {
            try {
                $dateCreation = date("Y-m-d");
                $univers = str_replace(' ', '', $univers);
                $universenfant = str_replace(' ', '', $universenfant);
                // Requête mysql pour insérer des données
                $aInserer = array(
                                    ":nom"=>$nom, 
                                    ":nomcontact"=>$nomContact,
                                    ":activiteentreprise"=>$activiteEntreprise,
                                    ":mail"=>$mail, 
                                    ":telephone"=>$telephone, 
                                    ":univers"=>$univers, 
                                    ":universenfant"=>$universenfant, 
                                    ":date"=>$dateCreation, 
                                    ":actif"=>$actif
                                );
                if($actif != 1) { $actif = 0; }
                $sql = "INSERT INTO partenaire (nom, nomcontact, activiteentreprise, mail, telephone, univers, universenfant, date, actif) VALUES 
                        (:nom, :nomcontact, :activiteentreprise, :mail, :telephone, :univers, :universenfant, :date, :actif)";
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
    public function update($id,$nom,$univers, $mail = '', $telephone = '', $actif = '', $universenfant = '', $nomContact = '', $activiteEntreprise = '') {
        if (!is_null($this->pdo)) {
            try {
                $univers = str_replace(' ', '', $univers);
                $universenfant = str_replace(' ', '', $universenfant);
                // Requête mysql pour insérer des données
                $aInserer = array(":nom"=>$nom, ":nomcontact"=>$nomContact, ":activiteentreprise"=>$activiteEntreprise, ":mail"=>$mail, "telephone"=>$telephone, ":univers"=>$univers, "universenfant"=>$universenfant, ":id"=>$id);
                if($actif == 1 || $actif != '') {
                    array_push($aInserer, $actif);
                    $sql = "UPDATE partenaire SET nom = (:nom), nomcontact = (:nomcontact), activiteentreprise = (:activiteentreprise), mail = (:mail), telephone = (:telephone), univers = (:univers), universenfant = (:universenfant), actif = (:actif) WHERE id = (:id)";
                } else {
                    $sql = "UPDATE partenaire SET nom = (:nom), nomcontact = (:nomcontact), activiteentreprise = (:activiteentreprise), mail = (:mail), telephone = (:telephone), univers = (:univers), universenfant = (:universenfant) WHERE id = (:id)";
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


    public function toggleActif($id,$nom,$actif)
    {
        if (!is_null($this->pdo)) {
            try {
                if($actif == 0){
                    $actif = 1;
                } else {
                    $actif = 0;
                }
                // Requête mysql pour insérer des données
                $aInserer = array(":actif"=>$actif, ":id"=>$id);
                    $sql = "UPDATE partenaire SET actif = (:actif) WHERE id = (:id)";
                
                $res = $this->pdo->prepare($sql);
                $exec = $res->execute($aInserer);
                if($exec){
                    $msgActif = $actif == 0 ? 'désactivé' : 'activé';
                    $tupleUpdated = "Le partenaire <b>".strtoupper($nom)."</b> a bien été ".$msgActif.".";
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