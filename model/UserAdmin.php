<?php

require_once ('Model.php');

class UserAdmin
{
    use Model;

    private string $id;
    private string $firstName;
    private string $lastName;
    private DateTime $creationDate;
    private string $email;

    public function getId() {
        return $this->id;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getCreationDate() {
        return $this->creationDate;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function setCreationDate($creationDate) {
        $this->creationDate = $creationDate;
    }

    public function setEmail($email) {
        $this->email = $email;
    }
}