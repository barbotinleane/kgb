<?php

trait Model
{
    private $pdo = null;

    public function __construct()
    {
        try {
            $this->pdo = new PDO('mysql:host=sql588.main-hosting.eu;dbname=u504868350_kgb', 'u504868350_kgb', 'OpU8Chdcx93iCXxUAoMz');
        } catch(PDOException $e) {
            exit('Erreur : '.$e->getMessage());
        }
    }
}