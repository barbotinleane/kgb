<?php
$title = $mission['title'];
ob_start();
?>
<h1 class="display-1 text-center my-5"><?= $mission['title'] ?></h1>

<div class="row m-2 m-sm-5">
    <h2 class="card-subtitle mb-2 text-muted fs-5"><?= $mission['country'] ?></h2>
    <p class="card-subtitle text-muted">Du <?= $mission['dateStart'] ?> au <?= $mission['dateEnd'] ?></p>
    <ul class="m-5">
        <li><strong>Code : </strong><?= $mission['code'] ?></li>
        <li><strong>Type : </strong><?= $mission['type'] ?></li>
        <li><strong>Statut : </strong><?= $mission['missionstatus'] ?></li>
        <li><strong>Spécialité : </strong><?= $mission['speciality'] ?></li>
    </ul>
    <p>
        <?= $mission['description'] ?>
    </p>
</div>

<?php
$content = ob_get_clean();
require_once('layout.php');