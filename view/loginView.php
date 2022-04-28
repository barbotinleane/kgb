<?php
$title = "Connexion";
ob_start();
?>
    <h1 class="display-1 text-center my-5">Connexion</h1>

    <div class="row">
        <div class="col-12 col-sm-5 mx-auto">
            <form  method="POST" action="index.php?action=connexion">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Se Connecter</button>
                </div>
            </form>
        </div>
    </div>

<?php
$content = ob_get_clean();
require_once('layout.php');