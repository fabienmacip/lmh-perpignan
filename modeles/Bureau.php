<?php 

class Bureau
{
    use Modele;

    private $id;
    private $titre;
    private $description;
    private $img;

    public function read($id = '')
    {
        if (!is_null($this->pdo)) {
            $stmt = $this->pdo->prepare('SELECT * FROM bureau WHERE id = ?');
        }
        $tuple = [];//null;
        
        if ($stmt->execute([$id])) {
            $tuple = $stmt->fetchObject('Bureau',[$this->pdo]);
            if (!is_object($tuple)) {
                $tuple = []; //null;
            }
        }
        $stmt->closeCursor();
        return $tuple;
    }

    public function getId()
    {
      return $this->id;
    }

    public function getTitre() {
      return $this->titre;
    }

    public function getDescription() {
      return $this->description;
    }

    public function getImg() {
      return $this->img;
    }

}

