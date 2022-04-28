<?php
$title = "Les contacts du KGB";
ob_start();
if (isset($flash)) { ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $flash ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>

    <h1 class="display-1 text-center my-5">Les contacts</h1>

    <div class="row my-5 mx-2 mx-sm-5">
        <div class="m-4">
            <a
                class="btn btn-success"
                href="/index.php?action=contact&operation=ajouter"
            >
                Ajouter un contact
            </a>
        </div>
        <table class="table table-success table-striped">
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Date de naissance</th>
                <th>Pays</th>
                <th>Code</th>
                <th>Actions</th>
            </tr>
            <?php foreach($contacts as $person) { ?>
                <tr>
                    <td><?= $person['firstName'] ?></td>
                    <td><?= $person['lastName'] ?></td>
                    <td><?= $person['birthDate'] ?></td>
                    <td><?= $person['country'] ?></td>
                    <td><?= $person['code'] ?></td>
                    <td>
                        <a
                            href="/index.php?action=contact&id=<?= $person['id'] ?>&operation=modifier"
                            class="link-primary"
                        >
                            Modifier
                        </a>
                        <a
                            href="/index.php?action=contact&id=<?= $person['id'] ?>&operation=supprimer"
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