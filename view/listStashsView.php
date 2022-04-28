<?php
$title = "Les planques du KGB";
ob_start();
if (isset($flash)) { ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $flash ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>

    <h1 class="display-1 text-center my-5">Les planques</h1>

    <div class="row my-5 mx-2 mx-sm-5">
        <div class="m-4">
            <a
                class="btn btn-success"
                href="/index.php?action=planque&operation=ajouter"
            >
                Ajouter une planque
            </a>
        </div>
        <table class="table table-success table-striped">
            <tr>
                <th>Adresse</th>
                <th>Type</th>
                <th>Code</th>
                <th>Pays</th>
                <th>Actions</th>
            </tr>
            <?php foreach($stashs as $stash) { ?>
                <tr>
                    <td><?= $stash['address'] ?></td>
                    <td><?= $stash['type'] ?></td>
                    <td><?= $stash['code'] ?></td>
                    <td><?= $stash['country'] ?></td>
                    <td>
                        <a
                            href="/index.php?action=planque&id=<?= $stash['id'] ?>&operation=modifier"
                            class="link-primary"
                        >
                            Modifier
                        </a>
                        <a
                            href="/index.php?action=planque&id=<?= $stash['id'] ?>&operation=supprimer"
                            class="link-danger"
                        >
                            Supprimer
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>

<?php
$content = ob_get_clean();
require_once('layout.php');