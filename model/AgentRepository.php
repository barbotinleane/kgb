<?php

require_once ('Model.php');
require_once ('Mission.php');

class AgentRepository
{
    use Model;

    public function addAgent(array $data)
    {
        $req1 = $this->pdo->query('
            SELECT UUID() AS id;
        ');

        $uuid = [];
        while ($donnee = $req1->fetch(PDO::FETCH_ASSOC)) {
            $uuid = $donnee['id'];
        }

        $req = $this->pdo->prepare('
            INSERT INTO agent(id, firstName, lastName, birthDate, countryId, code)
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

        $agent = [];
        while ($donnee = $req->fetch(PDO::FETCH_ASSOC)) {
            $agent = $donnee;
        }

        return $uuid;
    }

    public function updateAgent(string $id, array $data)
    {
        $req = $this->pdo->prepare('
            UPDATE agent
            SET 
                firstName = :firstName, 
                lastName = :lastName, 
                birthDate = :birthDate, 
                countryId = :country, 
                code = :code
            WHERE agent.id = :id;
        ');

        $req->execute([
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'birthDate' => $data['birthDate'],
            'country' => $data['country'],
            'code' => $data['code'],
            'id' => $id,
        ]);

        $agent = [];
        while ($donnee = $req->fetch(PDO::FETCH_ASSOC)) {
            $agent = $donnee;
        }

        return $agent;
    }

    public function deleteAgent(string $id)
    {
        $req1 = $this->pdo->prepare('
            DELETE
            FROM specialityAgent
            WHERE agentId = :id;
        ');

        if(!$req1->execute(['id' => $id])) {
            return false;
        }

        $req2 = $this->pdo->prepare('
            DELETE
            FROM agent
            WHERE agent.id = :id;
        ');

        if($req2->execute(['id' => $id])) {
            return true;
        } else {
            return false;
        }
    }

    public function getAgent(string $id)
    {
        $req = $this->pdo->prepare('
            SELECT 
                a.id,
                a.firstName, 
                a.lastName, 
                a.birthDate, 
                country.frenchName AS country, 
                a.code
            FROM agent a
            JOIN country ON country.id = a.countryId
            WHERE a.id = :id;
        ');

        $req->execute(['id' => $id]);

        $agent = [];
        while ($donnee = $req->fetch(PDO::FETCH_ASSOC)) {
            $agent = $donnee;
        }

        return $agent;
    }

    public function getAllAgents()
    {
        $req = $this->pdo->query('
            SELECT 
                a.id,
                a.firstName, 
                a.lastName, 
                a.birthDate, 
                country.frenchName AS country, 
                a.code
            FROM agent a
            JOIN country ON country.id = a.countryId;
        ');

        $agents = [];
        while ($donnee = $req->fetch(PDO::FETCH_ASSOC)) {
            $agents[] = $donnee;
        }

        return $agents;
    }

    public function getAllAgentsNameAndCountry()
    {
        $req = $this->pdo->query('
            SELECT 
                a.id,
                CONCAT(a.firstName, " ", a.lastName, " - ", country.frenchName) AS name
            FROM agent a
            JOIN country ON country.id = a.countryId
            ORDER BY a.countryId;
        ');

        $agents = [];
        while ($donnee = $req->fetch(PDO::FETCH_ASSOC)) {
            $agents[] = $donnee;
        }

        return $agents;
    }
}