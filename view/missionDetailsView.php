<?php
$title = "Modifier une mission";
ob_start();

if (isset($flash) && $flash != null) { ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $flash ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>

    <h1 class="display-1 text-center my-5"><?= ($action == "update")? "Modifier" : "Ajouter" ?> une mission</h1>

<?php if ($action == "update") { ?>
    <form method="POST" action="index.php?action=mission&id=<?= $mission['id'] ?>&operation=modifier">
<?php } else { ?>
    <form method="POST" action="index.php?action=mission&operation=ajouter">
<?php } ?>
    <div class="row m-2 m-sm-5">
        <div class="col-6">
            <label for="title" class="form-label">Titre</label>
            <input
                type="text"
                class="form-control"
                id="title"
                name="title"
                value="<?= ($action == "update")? $mission['title'] : "" ?>">
        </div>
        <div class="col-6">
            <label for="code" class="form-label">Nom de code</label>
            <input
                type="text"
                class="form-control"
                id="code"
                name="code"
                value="<?= ($action == "update")? $mission['code'] : "" ?>">
        </div>
    </div>
    <div class="row m-2 m-sm-5">
        <div class="col-6">
            <label class="form-label">Pays</label>
            <select class="form-select" aria-label="country" name="country">

                <?php foreach ($countries as $country) { ?>
                    <option value="<?= $country['id'] ?>"
                        <?php if($action == "update" && $mission['country'] == $country['frenchName']) { ?>
                            selected
                        <?php } ?>
                    >
                        <?= $country['frenchName'] ?>
                    </option>
                <?php } ?>

            </select>
        </div>
        <div class="col-6">
            <label for="dateStart" class="form-label">Date de début</label>
            <input
                type="date"
                class="form-control"
                id="dateStart"
                name="dateStart"
                value="<?= ($action == "update")? $mission['dateStart'] : "" ?>">
        </div>
        <div class="col-6">
            <label for="dateEnd" class="form-label">Date de fin</label>
            <input
                type="date"
                class="form-control"
                id="dateEnd"
                name="dateEnd"
                value="<?= ($action == "update")? $mission['dateEnd'] : "" ?>">
        </div>
    </div>
    <div class="row m-2 m-sm-5">
        <div class="col-6">
            <label class="form-label">Spécialité</label>
            <select class="form-select" aria-label="speciality" name="speciality">

                <?php foreach ($specialities as $speciality) { ?>
                    <option value="<?= $speciality['id'] ?>"
                        <?php if($action == "update" && $mission['speciality'] == $speciality['name']) { ?>
                            selected
                        <?php } ?>
                    >
                        <?= $speciality['name'] ?>
                    </option>
                <?php } ?>

            </select>
        </div>

        <div class="col-6">
            <label class="form-label">Statut</label>
            <select class="form-select" aria-label="status" name="status">

                <?php foreach ($status as $item) { ?>
                    <option value="<?= $item['id'] ?>"
                        <?php if($action == "update" && $mission['missionstatus'] == $item['name']) { ?>
                            selected
                        <?php } ?>
                    >
                        <?= $item['name'] ?>
                    </option>
                <?php } ?>

            </select>
        </div>

        <div class="col-6">
            <label class="form-label">Type de mission</label>
            <select class="form-select" aria-label="type" name="type">
                <?php foreach ($types as $type) { ?>
                    <option value="<?= $type['id'] ?>"
                        <?php if($action == "update" && $mission['type'] == $type['name']) { ?>
                            selected
                        <?php } ?>
                    >
                        <?= $type['name'] ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="col-4">
            <label class="form-label">Agents sélectionnés pour la mission</label>
            <?php foreach ($agents as $agent) { ?>
                <div class="form-check">
                    <input
                            class="form-check-input"
                            type="checkbox"
                            value="<?= $agent['id'] ?>"
                            id="<?= $agent['id'] ?>"
                            name="agent[<?= $agent['id'] ?>]"
                            <?php if($action == "update" && in_array($agent['id'], $mission['agents'])) { ?>
                                checked
                            <?php } ?>
                    >
                    <label class="form-check-label" for="<?= $agent['id'] ?>">
                        <?= $agent['name'] ?>
                    </label>
                </div>
            <?php } ?>
        </div>

        <div class="col-4">
            <label class="form-label">Contacts pour la mission</label>
            <?php foreach ($contacts as $contact) { ?>
                <div class="form-check">
                    <input
                            class="form-check-input"
                            type="checkbox"
                            value="<?= $contact['id'] ?>"
                            id="<?= $contact['id'] ?>"
                            name="contact[<?= $contact['id'] ?>]"
                            <?php if($action == "update" && in_array($contact['id'], $mission['contacts'])) { ?>
                                checked
                            <?php } ?>
                    >
                    <label class="form-check-label" for="<?= $contact['id'] ?>">
                        <?= $contact['name'] ?>
                    </label>
                </div>
            <?php } ?>
        </div>

        <div class="col-4">
            <label class="form-label">Planques pour la mission</label>
            <?php foreach ($stashs as $stash) { ?>
                <div class="form-check">
                    <input
                            class="form-check-input"
                            type="checkbox"
                            value="<?= $stash['id'] ?>"
                            id="<?= $stash['id'] ?>"
                            name="stash[<?= $stash['id'] ?>]"
                            <?php if($action == "update" && in_array($stash['id'], $mission['stashs'])) { ?>
                                checked
                            <?php } ?>
                    >
                    <label class="form-check-label" for="<?= $stash['id'] ?>">
                        <?= $stash['name'] ?>
                    </label>
                </div>
            <?php } ?>
        </div>

        <div class="col-4">
            <label class="form-label">Cibles pour la mission</label>
            <?php foreach ($targets as $target) { ?>
                <div class="form-check">
                    <input
                            class="form-check-input"
                            type="checkbox"
                            value="<?= $target['id'] ?>"
                            id="<?= $target['id'] ?>"
                            name="target[<?= $target['id'] ?>]"
                        <?php if($action == "update" && in_array($target['id'], $mission['targets'])) { ?>
                            checked
                        <?php } ?>
                    >
                    <label class="form-check-label" for="<?= $target['id'] ?>">
                        <?= $target['name'] ?>
                    </label>
                </div>
            <?php } ?>
        </div>

        <div class="col-12">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"><?= ($action == "update")? $mission['description'] : "" ?></textarea>
        </div>
    </div>

    <div class="text-center">
        <button class="btn btn-primary" type="submit">Valider</button>
    </div>
    </form>

<?php
$content = ob_get_clean();
require_once('layout.php');