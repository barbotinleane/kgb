<?php
$title = "Modifier une cible";
ob_start();

if (isset($flash) && $flash != null) { ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $flash ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>

    <h1 class="display-1 text-center my-5"><?= ($action == "update")? "Modifier" : "Ajouter" ?> une cible</h1>

<?php if ($action == "update") { ?>
    <form method="POST" action="index.php?action=cible&id=<?= $target['id'] ?>&operation=modifier">
<?php } else { ?>
    <form method="POST" action="index.php?action=cible&operation=ajouter">
<?php } ?>
    <div class="row m-2 m-sm-5">
        <div class="col-6">
            <label for="firstName" class="form-label">Prénom</label>
            <input
                type="text"
                class="form-control"
                id="firstName"
                name="firstName"
                value="<?= ($action == "update")? $target['firstName'] : "" ?>">
        </div>
        <div class="col-6">
            <label for="lastName" class="form-label">Nom</label>
            <input
                type="text"
                class="form-control"
                id="lastName"
                name="lastName"
                value="<?= ($action == "update")? $target['lastName'] : "" ?>">
        </div>
    </div>
    <div class="row m-2 m-sm-5">
        <div class="col-6">
            <label class="form-label">Pays</label>
            <select class="form-select" aria-label="country" name="country">

                <?php foreach ($countries as $country) { ?>
                    <option value="<?= $country['id'] ?>"
                        <?php if($action == "update" && $target['country'] == $country['frenchName']) { ?>
                            selected
                        <?php } ?>
                    >
                        <?= $country['frenchName'] ?>
                    </option>
                <?php } ?>

            </select>
        </div>
        <div class="col-6">
            <label for="birthDate" class="form-label">Date de naissance</label>
            <input
                type="date"
                class="form-control"
                id="birthDate"
                name="birthDate"
                value="<?= ($action == "update")? $target['birthDate'] : "" ?>">
        </div>
    </div>
    <div class="row m-2 m-sm-5">
        <div class="col-3">
            <label for="code" class="form-label">Code</label>
            <input
                type="number"
                class="form-control"
                id="code"
                name="code"
                value="<?= ($action == "update")? $target['code'] : "" ?>">
        </div>
    </div>

    <div class="text-center">
        <button class="btn btn-primary" type="submit">Valider</button>
    </div>
    </form>

<?php
$content = ob_get_clean();
require_once('layout.php');