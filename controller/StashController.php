<?php

require_once('./model/StashRepository.php');
require_once('./model/CountryRepository.php');

function listStashs($flash = null)
{
    $stashRepository = new StashRepository();
    $stashs = $stashRepository->getAllStashs();

    require('./view/listStashsView.php');
}

function updateStash($id = null, $flash = null)
{
    $stashRepository = new StashRepository();
    $countryRepository = new CountryRepository();
    $countries = $countryRepository->getAllCountries();

    if($id == null) {
        $id = $_GET['id'];
    }

    if(isset($_POST['address']) && $flash != "La planque a bien été ajoutée.") {
        $stashRepository->updateStash($id, $_POST);
        $flash = "La planque a bien été modifiée";
    }

    $stash = $stashRepository->getStash($id);
    $action = "update";

    require('./view/stashDetailsView.php');
}

function addStash()
{
    $stashRepository = new StashRepository();
    $countryRepository = new CountryRepository();
    $countries = $countryRepository->getAllCountries();

    if(isset($_POST['address'])) {
        $id = $stashRepository->addStash($_POST);
        updateStash($id, "La planque a bien été ajoutée.");
    } else {
        $action = "add";
        require('./view/stashDetailsView.php');
    }
}

function deleteStash()
{
    $stashRepository = new StashRepository();
    if($stashRepository->deleteStash($_GET['id'])) {
        listStashs("Planque supprimée");
    } else {
        listStashs("Une erreur est survenue. La suppression n'a pas pu s'effectuer.");
    }
}