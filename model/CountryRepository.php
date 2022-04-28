<?php

require_once ('Model.php');
require_once ('Country.php');

class CountryRepository
{
    use Model;

    public function getAllCountries()
    {
        $req = $this->pdo->query('
            SELECT 
               country.id,
                country.frenchName 
            FROM country;
        ');

        $countries = [];
        while($donnee = $req->fetch(PDO::FETCH_ASSOC)) {
            $countries[] = $donnee;
        }

        return $countries;
    }
}