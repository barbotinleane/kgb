<?php

require_once ('Model.php');

class SpecialityRepository
{
    use Model;

    public function getAllSpecialities()
    {
        $req = $this->pdo->query('
            SELECT * FROM speciality;
        ');

        $specialities = [];
        while($donnee = $req->fetch(PDO::FETCH_ASSOC)) {
            $specialities[] = $donnee;
        }

        return $specialities;
    }
}