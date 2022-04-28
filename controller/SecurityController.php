<?php

require_once('./model/MissionRepository.php');
require_once('./model/AgentRepository.php');
require_once('./model/CountryRepository.php');
require('./model/UserAdminRepository.php');

function login()
{
    if(isset($_POST['email'])) {
        $userRepository = new UserAdminRepository();
        if(!$userRepository->login($_POST['email'], $_POST['password'])) {
            $loginSuccess = false;
            require('./view/loginView.php');
        } else {
            $loginSuccess = true;
            listMissions();
        }
    } else {
        require('./view/loginView.php');
    }
}

function logout()
{
    $userRepository = new UserAdminRepository();
    if(isset($_SESSION['user']) && $_SESSION['user'] != null) {
        $userRepository->logout();
    }

    listMissions();
}

function error()
{
    require('./view/404.php');
}