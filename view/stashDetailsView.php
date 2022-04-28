<?php
$title = "Modifier une planque";
ob_start();

if (isset($flash) && $flash != null) { ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $flash ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>

    <h1 class="display-1 text-center my-5"><?= ($action == "update")? "Modifier" : "Ajouter" ?> une planque</h1>

<?php if ($action == "update") { ?>
    <form method="POST" action="index.php?action=planque&id=<?= $stash['id'] ?>&operation=modifier">
<?php } else { ?>
    <form method="POST" action="index.php?action=planque&operation=ajouter">
<?php } ?>
    <div class="row m-2 m-sm-5">
        <div class="col-12">
            <label for="address" class="form-label">Adresse</label>
            <input
                type="text"
                class="form-control"
                id="address"
                name="address"
                value="<?= ($action == "update")? $stash['address'] : "" ?>">
        </div>
    </div>
    <div class="row m-2 m-sm-5">
        <div class="col-6">
            <label class="form-label">Pays</label>
            <select class="form-select" aria-label="country" name="country">

                <?php foreach ($countries as $country) { ?>
                    <option value="<?= $country['id'] ?>"
                        <?php if($action == "update" && $stash['country'] == $country['frenchName']) { ?>
                            selected
                        <?php } ?>
                    >
                        <?= $country['frenchName'] ?>
                    </option>
                <?php } ?>

            </select>
        </div>
        <div class="col-3">
            <label for="code" class="form-label">Code</label>
            <input
                type="number"
                class="form-control"
                id="code"
                name="code"
                value="<?= ($action == "update")? $stash['code'] : "" ?>">
        </div>
    </div>

    <div class="row m-2 m-sm-5">
        <div class="col-6">
            <label for="type" class="form-label">Type de planque</label>
            <input
                    type="text"
                    class="form-control"
                    id="type"
                    name="type"
                    value="<?= ($action == "update")? $stash['type'] : "" ?>">
        </div>
    </div>

    <div class="text-center">
        <button class="btn btn-primary" type="submit">Valider</button>
    </div>
    </form>

<?php
$content = ob_get_clean();
require_once('layout.php');