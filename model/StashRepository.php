<?php

require_once ('Model.php');
require_once ('Stash.php');

class StashRepository
{
    use Model;

    public function addStash(array $data)
    {
        $req1 = $this->pdo->query('
            SELECT UUID() AS id;
        ');

        $uuid = [];
        while ($donnee = $req1->fetch(PDO::FETCH_ASSOC)) {
            $uuid = $donnee['id'];
        }

        $req = $this->pdo->prepare('
            INSERT INTO stash(id, address, type, code, countryId)
            VALUES 
                (:id, :address, :type, :code, :country);
        ');

        $req->execute([
            'address' => $data['address'],
            'type' => $data['type'],
            'country' => $data['country'],
            'code' => $data['code'],
            'id' => $uuid
        ]);

        $stash = [];
        while ($donnee = $req->fetch(PDO::FETCH_ASSOC)) {
            $stash = $donnee;
        }

        return $uuid;
    }

    public function updateStash(string $id, array $data)
    {
        $req = $this->pdo->prepare('
            UPDATE stash
            SET 
                address = :address, 
                type = :type, 
                code = :code, 
                countryId = :country
            WHERE id = :id;
        ');

        $req->execute([
            'address' => $data['address'],
            'type' => $data['type'],
            'country' => $data['country'],
            'code' => $data['code'],
            'id' => $id
        ]);

        $stash = [];
        while ($donnee = $req->fetch(PDO::FETCH_ASSOC)) {
            $stash = $donnee;
        }

        return $stash;
    }

    public function deleteStash(string $id)
    {
        $req1 = $this->pdo->prepare('
            DELETE
            FROM stashMission
            WHERE stashId = :id;
        ');

        if(!$req1->execute(['id' => $id])) {
            return false;
        }

        $req2 = $this->pdo->prepare('
            DELETE
            FROM stash
            WHERE stash.id = :id;
        ');

        if($req2->execute(['id' => $id])) {
            return true;
        } else {
            return false;
        }
    }

    public function getStash(string $id)
    {
        $req = $this->pdo->prepare('
            SELECT 
                s.id,
                s.address, 
                s.type, 
                s.code, 
                country.frenchName AS country
            FROM stash s
            JOIN country ON country.id = s.countryId
            WHERE s.id = :id;
        ');

        $req->execute(['id' => $id]);

        $stash = [];
        while ($donnee = $req->fetch(PDO::FETCH_ASSOC)) {
            $stash = $donnee;
        }

        return $stash;
    }

    public function getAllStashs()
    {
        $req = $this->pdo->query('
            SELECT 
                s.id,
                s.address, 
                s.type, 
                s.code, 
                country.frenchName AS country
            FROM stash s
            JOIN country ON country.id = s.countryId;
        ');

        $stashs = [];
        while ($donnee = $req->fetch(PDO::FETCH_ASSOC)) {
            $stashs[] = $donnee;
        }

        return $stashs;
    }

    public function getAllStashsNameAndCountry()
    {
        $req = $this->pdo->query('
            SELECT 
                s.id,
                CONCAT(s.address, " - ", country.frenchName) AS name
            FROM stash s
            JOIN country ON country.id = s.countryId
            ORDER BY s.countryId;
        ');

        $stashs = [];
        while ($donnee = $req->fetch(PDO::FETCH_ASSOC)) {
            $stashs[] = $donnee;
        }

        return $stashs;
    }
}