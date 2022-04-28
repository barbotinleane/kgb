<?php

require_once('./model/AgentRepository.php');
require_once('./model/CountryRepository.php');

function listAgents($flash = null)
{
    $agentRepository = new AgentRepository();
    $agents = $agentRepository->getAllAgents();

    require('./view/listAgentsView.php');
}

function updateAgent($id = null, $flash = null)
{
    $agentRepository = new AgentRepository();

    $countryRepository = new CountryRepository();
    $countries = $countryRepository->getAllCountries();

    if($id == null) {
        $id = $_GET['id'];
    }

    if(isset($_POST['firstName']) && $flash != "L'agent a bien été ajouté.") {
        $agentRepository->updateAgent($id, $_POST);
        $flash = "L'agent a bien été modifié";
    }

    $agent = $agentRepository->getAgent($id);
    $action = "update";

    require('./view/agentDetailsView.php');
}

function addAgent()
{
    $agentRepository = new AgentRepository();
    $countryRepository = new CountryRepository();
    $countries = $countryRepository->getAllCountries();

    if(isset($_POST['firstName'])) {
        $id = $agentRepository->addAgent($_POST);
        updateAgent($id, "L'agent a bien été ajouté.");
    } else {
        $action = "add";
        require('./view/agentDetailsView.php');
    }
}

function deleteAgent()
{
    $agentRepository = new AgentRepository();
    if($agentRepository->deleteAgent($_GET['id'])) {
        listAgents("Agent supprimé");
    } else {
        listAgents("Une erreur est survenue. La suppression n'a pas pu s'effectuer.");
    }
}