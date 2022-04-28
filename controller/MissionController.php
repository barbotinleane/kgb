<?php

require_once('./model/MissionRepository.php');
require_once('./model/CountryRepository.php');
require_once('./model/TypeRepository.php');
require_once('./model/StatusRepository.php');
require_once('./model/SpecialityRepository.php');

function listMissions(string $flash = null)
{
    $missionRepository = new MissionRepository();
    $missions = $missionRepository->getAllMissions();

    require('./view/listMissionsView.php');
}

function missionDetails()
{
    $missionRepository = new MissionRepository();
    $mission = $missionRepository->getMission($_GET['id']);

    require('./view/missionSeeView.php');
}

function updateMission($id = null, $flash = null)
{
    $missionRepository = new MissionRepository();
    $countryRepository = new CountryRepository();
    $countries = $countryRepository->getAllCountries();

    $typeRepository = new TypeRepository();
    $types = $typeRepository->getAllTypes();

    $statusRepository = new StatusRepository();
    $status = $statusRepository->getAllStatus();

    $specialityRepository = new SpecialityRepository();
    $specialities = $specialityRepository->getAllSpecialities();

    $agentRepository = new AgentRepository();
    $agents = $agentRepository->getAllAgentsNameAndCountry();

    $contactRepository = new ContactRepository();
    $contacts = $contactRepository->getAllContactsNameAndCountry();

    $stashRepository = new StashRepository();
    $stashs = $stashRepository->getAllStashsNameAndCountry();

    $targetRepository = new TargetRepository();
    $targets = $targetRepository->getAllTargetsNameAndCountry();

    if($id == null) {
        $id = $_GET['id'];
    }

    if(isset($_POST['title']) && $flash != "La mission a bien été ajoutée.") {
        $missionRepository->updateMission($id, $_POST);
        $flash = "La mission a bien été modifiée.";
    }

    $mission = $missionRepository->getMission($id);
    $action = "update";

    require('./view/missionDetailsView.php');
}

function addMission()
{
    $missionRepository = new MissionRepository();
    $countryRepository = new CountryRepository();
    $countries = $countryRepository->getAllCountries();

    $typeRepository = new TypeRepository();
    $types = $typeRepository->getAllTypes();

    $statusRepository = new StatusRepository();
    $status = $statusRepository->getAllStatus();

    $specialityRepository = new SpecialityRepository();
    $specialities = $specialityRepository->getAllSpecialities();

    $agentRepository = new AgentRepository();
    $agents = $agentRepository->getAllAgentsNameAndCountry();

    $contactRepository = new ContactRepository();
    $contacts = $contactRepository->getAllContactsNameAndCountry();

    $stashRepository = new StashRepository();
    $stashs = $stashRepository->getAllStashsNameAndCountry();

    $targetRepository = new TargetRepository();
    $targets = $targetRepository->getAllTargetsNameAndCountry();

    if(isset($_POST['title'])) {
        $id = $missionRepository->addMission($_POST);
        updateMission($id, "La mission a bien été ajoutée.");
    } else {
        $action = "add";
        require('./view/missionDetailsView.php');
    }
}

function deleteMission()
{
    $missionRepository = new MissionRepository();
    if($missionRepository->deleteMission($_GET['id'])) {
        listMissions("Mission supprimée.");
    } else {
        listMissions("Une erreur est survenue. La suppression n'a pas pu s'effectuer.");
    }
}