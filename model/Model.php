<?php

trait Model
{
    private $pdo = null;

    public function __construct()
    {
        try {
            $this->pdo = new PDO('mysql:host=localhost;dbname=kgb', 'root', 'root');
        } catch(PDOException $e) {
            exit('Erreur : '.$e->getMessage());
        }
    }
}
