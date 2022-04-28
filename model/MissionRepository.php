<?php

require_once ('Model.php');
require_once ('Mission.php');

class MissionRepository
{
    use Model;

    public function deleteAllContacts($missionId)
    {
        $reqContact = $this->pdo->prepare('
            DELETE
            FROM contactMission
            WHERE missionId = :id;
        ');

        $reqContact->execute(['id' => $missionId]);
    }

    public function addContact($missionId, $contactId)
    {
        $reqAddContact = $this->pdo->prepare('
                INSERT INTO contactMission(contactId, missionId)
                VALUES 
                    (:contactId, :missionId);
            ');

        $reqAddContact->execute([
            'contactId' => $contactId,
            'missionId' => $missionId
        ]);
    }

    public function deleteAllAgents($missionId)
    {
        $req = $this->pdo->prepare('
            DELETE
            FROM agentMission
            WHERE missionId = :id;
        ');

        $req->execute(['id' => $missionId]);
    }

    public function addAgent($missionId, $agentId)
    {
        $reqAddAgent = $this->pdo->prepare('
                INSERT INTO agentMission(agentId, missionId)
                VALUES 
                    (:agentId, :missionId);
            ');

        $reqAddAgent->execute([
            'agentId' => $agentId,
            'missionId' => $missionId
        ]);
    }

    public function deleteAllStashs($missionId)
    {
        $req3 = $this->pdo->prepare('
            DELETE
            FROM stashMission
            WHERE missionId = :id;
        ');

        $req3->execute(['id' => $missionId]);
    }

    public function addStash($missionId, $stashId)
    {
        $reqAddStash = $this->pdo->prepare('
                INSERT INTO stashMission(missionId, stashId)
                VALUES 
                    (:missionId, :stashId);
            ');

        $reqAddStash->execute([
            'missionId' => $missionId,
            'stashId' => $stashId
        ]);
    }

    public function deleteAllTargets($missionId)
    {
        $req4 = $this->pdo->prepare('
            DELETE
            FROM targetMission
            WHERE missionId = :id;
        ');

        $req4->execute(['id' => $missionId]);
    }

    public function addTarget($missionId, $targetId)
    {
        $reqAddTarget = $this->pdo->prepare('
                INSERT INTO targetMission(missionId, targetId)
                VALUES 
                    (:missionId, :targetId);
            ');

        $reqAddTarget->execute([
            'missionId' => $missionId,
            'targetId' => $targetId
        ]);
    }

    public function addMission(array $data)
    {
        $req1 = $this->pdo->query('
            SELECT UUID() AS id;
        ');

        $uuid = [];
        while ($donnee = $req1->fetch(PDO::FETCH_ASSOC)) {
            $uuid = $donnee['id'];
        }

        $req = $this->pdo->prepare('
            INSERT INTO mission(id, title, description, codeName, countryId, type, statusId, specialityId, dateStart, dateEnd)
            VALUES 
                (:id, :title, :description, :codeName, :country, :type, :status, :speciality, :dateStart, :dateEnd);
        ');

        $req->execute([
            'title' => $data['title'],
            'description' => $data['description'],
            'codeName' => $data['code'],
            'country' => $data['country'],
            'type' => $data['type'],
            'status' => $data['status'],
            'speciality' => $data['speciality'],
            'dateStart' => $data['dateStart'],
            'dateEnd' => $data['dateEnd'],
            'id' => $uuid
        ]);

        $mission = [];
        while ($donnee = $req->fetch(PDO::FETCH_ASSOC)) {
            $mission = $donnee;
        }

        foreach ($data['contact'] as $contact) {
            $this->addContact($uuid, $contact);
        }

        foreach ($data['agent'] as $agent) {
            $this->addAgent($uuid, $agent);
        }

        foreach ($data['stash'] as $stash) {
            $this->addStash($uuid, $stash);
        }

        foreach ($data['target'] as $target) {
            $this->addTarget($uuid, $target);
        }

        return $uuid;
    }

    public function updateMission(string $id, array $data)
    {
        $this->deleteAllContacts($id);
        foreach ($data['contact'] as $contact) {
            $this->addContact($id, $contact);
        }

        $this->deleteAllAgents($id);
        foreach ($data['agent'] as $agent) {
            $this->addAgent($id, $agent);
        }

        $this->deleteAllStashs($id);
        foreach ($data['stash'] as $stash) {
            $this->addStash($id, $stash);
        }

        $this->deleteAllTargets($id);
        foreach ($data['target'] as $target) {
            $this->addTarget($id, $target);
        }

        $req = $this->pdo->prepare('
            UPDATE mission
            SET 
                title = :title,
                description = :description,
                codeName = :code,
                countryId = :country,
                type = :type,
                statusId = :status,
                specialityId = :speciality,
                dateStart = :dateStart,
                dateEnd = :dateEnd
            WHERE mission.id = :id;
        ');

        $req->execute([
            'title' => $data['title'],
            'description' => $data['description'],
            'code' => $data['code'],
            'country' => $data['country'],
            'type' => $data['type'],
            'status' => $data['status'],
            'speciality' => $data['speciality'],
            'dateStart' => $data['dateStart'],
            'dateEnd' => $data['dateEnd'],
            'id' => $id
        ]);

        $mission = [];
        while ($donnee = $req->fetch(PDO::FETCH_ASSOC)) {
            $mission = $donnee;
        }

        return $mission;
    }

    public function deleteMission(string $id)
    {
        $this->deleteAllContacts($id);
        $this->deleteAllAgents($id);
        $this->deleteAllStashs($id);
        $this->deleteAllTargets($id);

        $finalRequest = $this->pdo->prepare('
            DELETE
            FROM mission
            WHERE mission.id = :id;
        ');

        if($finalRequest->execute(['id' => $id])) {
            return true;
        } else {
            return false;
        }
    }

    public function getMission(string $id)
    {
        $req = $this->pdo->prepare('
            SELECT 
                mission.id,
                mission.title AS title, 
                mission.description AS description, 
                mission.codeName AS code, 
                country.frenchName AS country, 
                typeMission.name AS type, 
                missionStatus.name AS missionstatus, 
                speciality.name AS speciality, 
                dateStart, 
                dateEnd 
            FROM mission
            JOIN typeMission ON mission.type = typeMission.id
            JOIN country ON country.id = mission.countryId
            JOIN missionStatus ON mission.statusId = missionStatus.id
            JOIN speciality ON mission.specialityId = speciality.id
            WHERE mission.id = :id;
        ');

        $req->execute(['id' => $id]);

        $missions = [];
        while($donnee = $req->fetch(PDO::FETCH_ASSOC)) {
            $missions = $donnee;
        }

        $req2 = $this->pdo->prepare('
            SELECT 
            agentId
            FROM agentMission
            WHERE missionId = :id
        ');

        $req2->execute(['id' => $id]);

        while($donnee = $req2->fetch(PDO::FETCH_ASSOC)) {
            $missions['agents'][] = $donnee['agentId'];
        }

        $req3 = $this->pdo->prepare('
            SELECT 
            contactId
            FROM contactMission
            WHERE missionId = :id
        ');

        $req3->execute(['id' => $id]);

        while($donnee = $req3->fetch(PDO::FETCH_ASSOC)) {
            $missions['contacts'][] = $donnee['contactId'];
        }

        $req4 = $this->pdo->prepare('
            SELECT 
            stashId
            FROM stashMission
            WHERE missionId = :id
        ');

        $req4->execute(['id' => $id]);

        while($donnee = $req4->fetch(PDO::FETCH_ASSOC)) {
            $missions['stashs'][] = $donnee['stashId'];
        }

        $req5 = $this->pdo->prepare('
            SELECT 
            targetId
            FROM targetMission
            WHERE missionId = :id
        ');

        $req5->execute(['id' => $id]);

        while($donnee = $req5->fetch(PDO::FETCH_ASSOC)) {
            $missions['targets'][] = $donnee['targetId'];
        }

        return $missions;
    }

    public function getAllMissions()
    {
        $req = $this->pdo->query('
            SELECT 
                mission.id,
                mission.title AS title, 
                mission.description AS description, 
                mission.codeName AS code, 
                country.frenchName AS country, 
                typeMission.name AS type, 
                missionStatus.name AS missionstatus, 
                speciality.name AS speciality, 
                dateStart, 
                dateEnd 
            FROM mission
            JOIN typeMission ON mission.type = typeMission.id
            JOIN country ON country.id = mission.countryId
            JOIN missionStatus ON mission.statusId = missionStatus.id
            JOIN speciality ON mission.specialityId = speciality.id;
        ');

        $missions = [];
        while($donnee = $req->fetch(PDO::FETCH_ASSOC)) {
            $missions[] = $donnee;
        }

        return $missions;
    }
}