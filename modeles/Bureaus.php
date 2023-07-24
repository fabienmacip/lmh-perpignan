<?php

class Bureaus
{
    use Modele;

    // READ
    public function lister()
    {
        if (!is_null($this->pdo)) {
            $stmt = $this->pdo->query('SELECT * FROM bureau ORDER BY id');
        }
        $tuples = [];
        while ($tuple = $stmt->fetchObject('Bureau', [$this->pdo])) {
            $tuples[] = $tuple;
        }
        $stmt->closeCursor();

        return $tuples;
    }

    public function readNbTuples() {
        //$stmt = $this->pdo->query('SELECT COUNT(*) FROM bureaucalendar');
        $req = $this->pdo->prepare('SELECT COUNT(*) as total FROM bureau');
        $req->execute();
        $data=$req->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}