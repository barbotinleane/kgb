<?php
session_start();
require_once('controller/SecurityController.php');
require_once('controller/MissionController.php');
require_once('controller/AgentController.php');
require_once('controller/ContactController.php');
require_once('controller/StashController.php');
require_once('controller/TargetController.php');

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'mission') {
        if (isset($_GET['id'])) {
            if (isset($_GET['operation']) && $_GET['operation'] == 'modifier') {
                updateMission($_GET['id']);
            } elseif (isset($_GET['operation']) && $_GET['operation'] == 'details') {
                missionDetails();
            } elseif (isset($_GET['operation']) && $_GET['operation'] == 'supprimer') {
                deleteMission();
            } else {
                error();
            }
        } elseif (isset($_GET['operation']) && $_GET['operation'] == 'ajouter') {
            addMission();
        } else {
            listMissions();
        }
    } elseif ($_GET['action'] == 'agent') {
        if (isset($_GET['id'])) {
            if (isset($_GET['operation']) && $_GET['operation'] == 'modifier') {
                updateAgent($_GET['id']);
            } elseif (isset($_GET['operation']) && $_GET['operation'] == 'supprimer') {
                deleteAgent();
            } else {
                error();
            }
        } elseif (isset($_GET['operation']) && $_GET['operation'] == 'ajouter') {
            addAgent();
        } else {
            listAgents();
        }
    } elseif ($_GET['action'] == 'contact') {
        if (isset($_GET['id'])) {
            if (isset($_GET['operation']) && $_GET['operation'] == 'modifier') {
                updateContact($_GET['id']);
            } elseif (isset($_GET['operation']) && $_GET['operation'] == 'supprimer') {
                deleteContact();
            } else {
                error();
            }
        } elseif (isset($_GET['operation']) && $_GET['operation'] == 'ajouter') {
            addContact();
        } else {
            listContacts();
        }
    } elseif ($_GET['action'] == 'planque') {
        if (isset($_GET['id'])) {
            if (isset($_GET['operation']) && $_GET['operation'] == 'modifier') {
                updateStash($_GET['id']);
            } elseif (isset($_GET['operation']) && $_GET['operation'] == 'supprimer') {
                deleteStash();
            } else {
                error();
            }
        } elseif (isset($_GET['operation']) && $_GET['operation'] == 'ajouter') {
            addStash();
        } else {
            listStashs();
        }
    } elseif ($_GET['action'] == 'cible') {
        if (isset($_GET['id'])) {
            if (isset($_GET['operation']) && $_GET['operation'] == 'modifier') {
                updateTarget($_GET['id']);
            } elseif (isset($_GET['operation']) && $_GET['operation'] == 'supprimer') {
                deleteTarget();
            } else {
                error();
            }
        } elseif (isset($_GET['operation']) && $_GET['operation'] == 'ajouter') {
            addTarget();
        } else {
            listTargets();
        }
    } elseif ($_GET['action'] == 'connexion') {
        login();
    } elseif ($_GET['action'] == 'deconnexion') {
        logout();
    } else {
        error();
    }
}
else {
    listMissions();
}