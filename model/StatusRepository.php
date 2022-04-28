<?php

require_once ('Model.php');

class StatusRepository
{
    use Model;

    public function getAllStatus()
    {
        $req = $this->pdo->query('
            SELECT * FROM missionStatus;
        ');

        $status = [];
        while($donnee = $req->fetch(PDO::FETCH_ASSOC)) {
            $status[] = $donnee;
        }

        return $status;
    }
}