<?php

trait Modele
{
    private $pdo = null;

    public function __construct(PDO $pdo)
    {
        try {
            //$this->pdo = new PDO('mysql:host=localhost;dbname=spy;charset=utf8', 'root', '');
            $this->pdo = $pdo;
            //$this->pdo = new PDO('mysql:host=91.216.107.161;dbname=fatab195806_9ectvj;charset=utf8', 'fatab195806', '!Angular20');
        } catch (PDOException $e) {
            exit('Erreur : '.$e->getMessage());
        }
    }
}