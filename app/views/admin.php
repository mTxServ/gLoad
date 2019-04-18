<?php
/**
 * Administrator dashboard
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>gLoad | Administrator dashboard</title>
    <link rel="stylesheet" href="<?= \gLoad\Classes\Helpers::get_server_url() . '/compiled/css/bootstrap.min.css' ?>">
    <!-- font awesome includes -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/solid.css" integrity="sha384-QokYePQSOwpBDuhlHOsX0ymF6R/vLk/UQVz3WHa6wygxI5oGTmDTv8wahFOSspdm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/fontawesome.css" integrity="sha384-vd1e11sR28tEK9YANUtpIOdjGW14pS87bUBuOIoBILVWLFnS+MCX9T6MMf0VdPGq" crossorigin="anonymous">
    <!-- custom css -->
    <link rel="stylesheet" href="<?= \gLoad\Classes\Helpers::get_server_url() . '/compiled/css/site.css' ?>">
</head>
<body>
    <nav class="navbar navbar-dark navbar-expand-lg bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">gLoad <span class="badge badge-danger">Administrator</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="navbar-text"><?= \Gabyfle\SteamAuth::getUserData('personaname'); ?></span>
                            <img class="rounded-circle" src="<?= \Gabyfle\SteamAuth::getUserData('avatarfull'); ?>" alt="administrator avatar" width="40"/>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/disconnect"><i class="fas fa-power-off"></i> Disconnect</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <script src="<?= \gLoad\Classes\Helpers::get_server_url() . '/compiled/js/jquery.min.js' ?>"></script>
    <script src="<?= \gLoad\Classes\Helpers::get_server_url() . '/compiled/js/popper.min.js' ?>"></script>
    <script src="<?= \gLoad\Classes\Helpers::get_server_url() . '/compiled/js/bootstrap.min.js' ?>"></script>
</body>
</html>
