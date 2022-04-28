<?php
$title = "Les missions du KGB";
ob_start();
if (isset($flash)) { ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $flash ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>

    <h1 class="display-1 text-center my-5">Les missions</h1>

    <div class="row my-5 mx-2 mx-sm-5">
        <?php if(isset($_SESSION['user']) && $_SESSION['user'] != null) { ?>
            <div class="m-4">
                <a
                        class="btn btn-success"
                        href="/index.php?action=mission&operation=ajouter"
                >
                    Ajouter une mission
                </a>
            </div>
        <?php } ?>
        <table class="table table-success table-striped">
            <tr>
                <th>Titre</th>
                <th>Pays</th>
                <th>Dates</th>
                <th>Code</th>
                <th>Type</th>
                <th>Statut</th>
                <th>Spécialité</th>
                <th>Actions</th>
            </tr>
            <?php foreach($missions as $mission) { ?>
                <tr>
                    <td><?= $mission['title'] ?></td>
                    <td><?= $mission['country'] ?></td>
                    <td>Du <?= $mission['dateStart'] ?> au <?= $mission['dateEnd'] ?></td>
                    <td><?= $mission['code'] ?></td>
                    <td><?= $mission['type'] ?></td>
                    <td><?= $mission['missionstatus'] ?></td>
                    <td><?= $mission['speciality'] ?></td>
                    <?php if(isset($_SESSION['user']) && $_SESSION['user'] != null) { ?>
                        <td>
                            <a
                                    href="/index.php?action=mission&id=<?= $mission['id'] ?>&operation=modifier"
                                    class="link-primary"
                            >
                                Modifier
                            </a>
                            <a
                                    href="/index.php?action=mission&id=<?= $mission['id'] ?>&operation=supprimer"
                                    class="link-danger"
                            >
                                Supprimer
                            </a>
                        </td>
                    <?php } else { ?>
                        <td>
                            <a
                                    href="/index.php?action=mission&id=<?= $mission['id'] ?>&operation=details"
                                    class="link-primary"
                            >
                                Voir plus
                            </a>
                        </td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </table>
    </div>

<?php
$content = ob_get_clean();
require_once('layout.php');