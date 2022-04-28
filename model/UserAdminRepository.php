<?php

require_once ('Model.php');
require('UserAdmin.php');

class UserAdminRepository
{
    use Model;

    public function login($email, $password) {
        $user = new UserAdmin();
        $req = $this->pdo->prepare('
            SELECT 
                password
            FROM userAdmin
            WHERE email = :email;
        ');

        $req->execute(['email' => $email]);

        $hash = '';
        while($donnee = $req->fetch(PDO::FETCH_ASSOC)) {
            $hash = $donnee['password'];
        }

        if(isset($hash)) {
            if(password_verify($password, $hash)) {
                $req = $this->pdo->prepare('
                    SELECT 
                        id, firstName, lastName, creationDate, email
                    FROM userAdmin
                    WHERE email = :email;
                ');

                $req->execute(['email' => $email]);

                while($donnee = $req->fetch(PDO::FETCH_ASSOC)) {
                    $user->setFirstName($donnee['firstName']);
                    $user->setLastName($donnee['lastName']);
                    $user->setEmail($email);
                    $user->setCreationDate(DateTime::createFromFormat('Y-m-d', $donnee['creationDate']));
                    $_SESSION['user'] = $donnee['id'];

                    return true;
                }
            } else {
                return false;
            }
        }

        return false;
    }

    public function logout() {
        $user = null;
        $_SESSION['user'] = null;
        session_destroy();
    }
}