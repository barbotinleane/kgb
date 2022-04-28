<?php

require_once('./model/TargetRepository.php');
require_once('./model/CountryRepository.php');

function listTargets($flash = null)
{
    $targetRepository = new TargetRepository();
    $targets = $targetRepository->getAllTargets();

    require('./view/listTargetsView.php');
}

function updateTarget($id = null, $flash = null)
{
    $targetRepository = new TargetRepository();
    $countryRepository = new CountryRepository();
    $countries = $countryRepository->getAllCountries();

    if($id == null) {
        $id = $_GET['id'];
    }

    if(isset($_POST['firstName']) && $flash != "La cible a bien été ajoutée.") {
        $targetRepository->updateTarget($id, $_POST);
        $flash = "La cible a bien été modifiée";
    }

    $target = $targetRepository->getTarget($id);
    $action = "update";

    require('./view/targetDetailsView.php');
}

function addTarget()
{
    $targetRepository = new TargetRepository();
    $countryRepository = new CountryRepository();
    $countries = $countryRepository->getAllCountries();

    if(isset($_POST['firstName'])) {
        $id = $targetRepository->addTarget($_POST);
        updateTarget($id, "La cible a bien été ajoutée.");
    } else {
        $action = "add";
        require('./view/targetDetailsView.php');
    }
}

function deleteTarget()
{
    $targetRepository = new TargetRepository();
    if($targetRepository->deleteTarget($_GET['id'])) {
        listTargets("Cible supprimée.");
    } else {
        listTargets("Une erreur est survenue. La suppression n'a pas pu s'effectuer.");
    }
}