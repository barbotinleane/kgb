<?php

require_once ('Model.php');
require_once ('Contact.php');

class ContactRepository
{
    use Model;

    public function addContact(array $data)
    {
        $req1 = $this->pdo->query('
            SELECT UUID() AS id;
        ');

        $uuid = [];
        while ($donnee = $req1->fetch(PDO::FETCH_ASSOC)) {
            $uuid = $donnee['id'];
        }

        $req = $this->pdo->prepare('
            INSERT INTO contact(id, firstName, lastName, birthDate, nationalityId, code)
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

        $contact = [];
        while ($donnee = $req->fetch(PDO::FETCH_ASSOC)) {
            $contact = $donnee;
        }

        return $uuid;
    }

    public function updateContact(string $id, array $data)
    {
        $req = $this->pdo->prepare('
            UPDATE contact
            SET 
                firstName = :firstName, 
                lastName = :lastName, 
                birthDate = :birthDate, 
                nationalityId = :country, 
                code = :code
            WHERE contact.id = :id;
        ');

        $req->execute([
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'birthDate' => $data['birthDate'],
            'country' => $data['country'],
            'code' => $data['code'],
            'id' => $id,
        ]);

        $contact = [];
        while ($donnee = $req->fetch(PDO::FETCH_ASSOC)) {
            $contact = $donnee;
        }

        return $contact;
    }

    public function deleteContact(string $id)
    {
        $req1 = $this->pdo->prepare('
            DELETE
            FROM contactMission
            WHERE contactId = :id;
        ');

        if(!$req1->execute(['id' => $id])) {
            return false;
        }

        $req2 = $this->pdo->prepare('
            DELETE
            FROM contact
            WHERE contact.id = :id;
        ');

        if($req2->execute(['id' => $id])) {
            return true;
        } else {
            return false;
        }
    }

    public function getContact(string $id)
    {
        $req = $this->pdo->prepare('
            SELECT 
                c.id,
                c.firstName, 
                c.lastName, 
                c.birthDate, 
                country.frenchName AS country, 
                c.code
            FROM contact c
            JOIN country ON country.id = c.nationalityId
            WHERE c.id = :id;
        ');

        $req->execute(['id' => $id]);

        $contact = [];
        while ($donnee = $req->fetch(PDO::FETCH_ASSOC)) {
            $contact = $donnee;
        }

        return $contact;
    }

    public function getAllContacts()
    {
        $req = $this->pdo->query('
            SELECT 
                c.id,
                c.lastName, 
                c.birthDate, 
                c.firstName, 
                country.frenchName AS country, 
                c.code
            FROM contact c
            JOIN country ON country.id = c.nationalityId;
        ');

        $contacts = [];
        while ($donnee = $req->fetch(PDO::FETCH_ASSOC)) {
            $contacts[] = $donnee;
        }

        return $contacts;
    }

    public function getAllContactsNameAndCountry()
    {
        $req = $this->pdo->query('
            SELECT 
                c.id,
                CONCAT(c.firstName, " ", c.lastName, " - ", country.frenchName) AS name
            FROM contact c
            JOIN country ON country.id = c.nationalityId
            ORDER BY c.nationalityId;
        ');

        $contacts = [];
        while ($donnee = $req->fetch(PDO::FETCH_ASSOC)) {
            $contacts[] = $donnee;
        }

        return $contacts;
    }
}