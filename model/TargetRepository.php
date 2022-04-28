<?php

require_once ('Model.php');
require_once ('Target.php');

class TargetRepository
{
    use Model;

    public function addTarget(array $data)
    {
        $req1 = $this->pdo->query('
            SELECT UUID() AS id;
        ');

        $uuid = [];
        while ($donnee = $req1->fetch(PDO::FETCH_ASSOC)) {
            $uuid = $donnee['id'];
        }

        $req = $this->pdo->prepare('
            INSERT INTO target(id, firstName, lastName, birthDate, nationalityId, code)
            VALUES 
                (:id, :firstName, :lastName, :birthDate, :country, :code);
        ');

        $req->execute([
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'birthDate' => $data['birthDate'],
            'country' => $data['country'],
            'code' => $data['code'],
            'id' => $uuid
        ]);

        $target = [];
        while ($donnee = $req->fetch(PDO::FETCH_ASSOC)) {
            $target = $donnee;
        }

        return $uuid;
    }

    public function updateTarget(string $id, array $data)
    {
        $req = $this->pdo->prepare('
            UPDATE target
            SET 
                firstName = :firstName, 
                lastName = :lastName, 
                birthDate = :birthDate, 
                nationalityId = :country, 
                code = :code
            WHERE target.id = :id;
        ');

        $req->execute([
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'birthDate' => $data['birthDate'],
            'country' => $data['country'],
            'code' => $data['code'],
            'id' => $id,
        ]);

        $target = [];
        while ($donnee = $req->fetch(PDO::FETCH_ASSOC)) {
            $target = $donnee;
        }

        return $target;
    }

    public function deleteTarget(string $id)
    {
        $req1 = $this->pdo->prepare('
            DELETE
            FROM targetMission
            WHERE targetId = :id;
        ');

        if(!$req1->execute(['id' => $id])) {
            return false;
        }

        $req2 = $this->pdo->prepare('
            DELETE
            FROM target
            WHERE target.id = :id;
        ');

        if($req2->execute(['id' => $id])) {
            return true;
        } else {
            return false;
        }
    }

    public function getTarget(string $id)
    {
        $req = $this->pdo->prepare('
            SELECT 
                t.id,
                t.firstName, 
                t.lastName, 
                t.birthDate, 
                country.frenchName AS country, 
                t.code
            FROM target t
            JOIN country ON country.id = t.nationalityId
            WHERE t.id = :id;
        ');

        $req->execute(['id' => $id]);

        $target = [];
        while ($donnee = $req->fetch(PDO::FETCH_ASSOC)) {
            $target = $donnee;
        }

        return $target;
    }

    public function getAllTargets()
    {
        $req = $this->pdo->query('
            SELECT 
                t.id,
                t.lastName, 
                t.birthDate, 
                t.firstName, 
                country.frenchName AS country, 
                t.code
            FROM target t
            JOIN country ON country.id = t.nationalityId;
        ');

        $targets = [];
        while ($donnee = $req->fetch(PDO::FETCH_ASSOC)) {
            $targets[] = $donnee;
        }

        return $targets;
    }

    public function getAllTargetsNameAndCountry()
    {
        $req = $this->pdo->query('
            SELECT 
                t.id,
                CONCAT(t.firstName, " ", t.lastName, " - ", country.frenchName) AS name
            FROM target t
            JOIN country ON country.id = t.nationalityId
            ORDER BY t.nationalityId;
        ');

        $targets = [];
        while ($donnee = $req->fetch(PDO::FETCH_ASSOC)) {
            $targets[] = $donnee;
        }

        return $targets;
    }
}