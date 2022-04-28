<?php

require_once ('Model.php');

class TypeRepository
{
    use Model;

    public function getAllTypes()
    {
        $req = $this->pdo->query('
            SELECT * FROM typeMission;
        ');

        $types = [];
        while($donnee = $req->fetch(PDO::FETCH_ASSOC)) {
            $types[] = $donnee;
        }

        return $types;
    }
}