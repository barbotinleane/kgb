<?php

require_once('./model/ContactRepository.php');
require_once('./model/CountryRepository.php');

function listContacts($flash = null)
{
    $contactRepository = new ContactRepository();
    $contacts = $contactRepository->getAllContacts();

    require('./view/listContactsView.php');
}

function updateContact($id = null, $flash = null)
{
    $contactRepository = new ContactRepository();
    $countryRepository = new CountryRepository();
    $countries = $countryRepository->getAllCountries();

    if($id == null) {
        $id = $_GET['id'];
    }

    if(isset($_POST['firstName']) && $flash != "Le contact a bien été ajouté.") {
        $contactRepository->updateContact($id, $_POST);
        $flash = "Le contact a bien été modifié";
    }

    $contact = $contactRepository->getContact($id);
    $action = "update";

    require('./view/contactDetailsView.php');
}

function addContact()
{
    $contactRepository = new ContactRepository();
    $countryRepository = new CountryRepository();
    $countries = $countryRepository->getAllCountries();

    if(isset($_POST['firstName'])) {
        $id = $contactRepository->addContact($_POST);
        updateContact($id, "Le contact a bien été ajouté.");
    } else {
        $action = "add";
        require('./view/contactDetailsView.php');
    }
}

function deleteContact()
{
    $contactRepository = new ContactRepository();
    if($contactRepository->deleteContact($_GET['id'])) {
        listContacts("Contact supprimé");
    } else {
        listContacts("Une erreur est survenue. La suppression n'a pas pu s'effectuer.");
    }
}