<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Les missions du KGB</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./scss/global.css">
    </head>
    <body class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">KGB</a>
                <button
                        class="navbar-toggler"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbarNav"
                        aria-controls="navbarNav"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/">Les missions</a>
                        </li>
                        <?php if(isset($_SESSION['user']) && $_SESSION['user'] != null) { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/index.php?action=agent">
                                    Les Agents
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/index.php?action=contact">
                                    Les Contacts
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/index.php?action=planque">
                                    Les Planques
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/index.php?action=cible">
                                    Les Cibles
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/index.php?action=deconnexion">
                                    Déconnexion
                                </a>
                            </li>
                        <?php } else { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/index.php?action=connexion">
                                    Connexion
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>

        <?= $content ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>