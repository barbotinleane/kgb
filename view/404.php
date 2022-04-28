<?php
$title = "Erreur 404";
ob_start();
?>
    <h1 class="display-1 text-center my-5">404 - Page non trouvée</h1>

    <div class="text-center">
        <p>Veuillez revenir à la <a href="/">page d'accueil</a></p>
    </div>

<?php
$content = ob_get_clean();
require_once('layout.php');