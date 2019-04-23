<?php
/**
 * Administrator dashboard
 */
$themeName = \gLoad\Classes\Helpers::get_param_ini_file('config.ini', 'theme');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
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
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="<?= \gLoad\Classes\Helpers::get_server_url() . \gLoad\Classes\Helpers::get_param_ini_file('config.ini', 'install') ?>/loading?mapname=rockford_v1&steamid=<?= \Gabyfle\SteamAuth::getUserData('steamid'); ?>" target="_blank">
                            Live testing <i class="fas fa-external-link-alt"></i>
                        </a>
                    </li>
                </ul>
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
    <div class="container">
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Welcome home, <?= \Gabyfle\SteamAuth::getUserData('personaname'); ?></h4>
            <p>gLoad is a loading-screen management system that has been designed for front-end developers. In this administration panel, you will find everything you need to configure your installation. I invite you to make regular visits to the "updates" section of your dashboard to ensure the safe use of gLoad.</p>
            <hr>
            <p class="mb-0"><a href="https://github.com/Gabyfle">@Gabyfle</a>, author of <b>gLoad</b> </p>
        </div>
        <?php
            if(\gLoad\Classes\Helpers::get_latest_version('https://github.com/Gabyfle/gSteam-Auth') != SYSTEM_VERSION) {
                ?>
                <div class="alert alert-danger" role="alert">
                    A new update is available for <b>gLoad</b>! Click here for more details: <a
                            href="https://github.com/Gabyfle/gLoad/releases" class="alert-link">Releases</a>
                </div>
                <?php
            }
        ?>
        <div class="container">
            <div class="row">
                <div class="col-12 section-title">
                    <h2>General informations</h2>
                    <hr class="my-4">
                </div>
                <div class="col-12 col-md-6">
                    <div class="card text-white bg-dark">
                        <div class="card-header">Your loading URL</div>
                        <div class="card-body">
                            <div class="input-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default">URL</span>
                                </div>
                                <input type="text" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" placeholder="<?= \gLoad\Classes\Helpers::get_server_url() . \gLoad\Classes\Helpers::get_param_ini_file('config.ini', 'install') ?>/loading?mapname=%m&steamid=%s" value="<?= \gLoad\Classes\Helpers::get_server_url() . \gLoad\Classes\Helpers::get_param_ini_file('config.ini', 'install') ?>/loading?mapname=%m&steamid=%s">
                            </div>
                            <p class="card-text">Goes in your servers settings (<code>server.cfg</code>) and in the field <code>sv_loading_url</code>, put this link.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card text-white bg-info">
                        <div class="card-header">Your system version</div>
                        <div class="card-body">
                            <h5 class="card-title">Latest version : <?= \gLoad\Classes\Helpers::get_latest_version('https://github.com/Gabyfle/gLoad') ?></h5>
                            <h5 class="card-title">Installed version : 1.0.0-beta</h5>
                            <p class="card-text">We recommend to always use the latest version of gLoad.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 section-title">
                    <h2>Theme configuration</h2>
                    <hr class="my-4">
                </div>

                <div class="col-12 col-md-6">
                    <?php
                        if(\gLoad\Classes\ThemeManager::isTheme($themeName)){ ?>
                    <h4>Current theme : <code><?= htmlspecialchars($themeName) ?></code></h4>
                    <p class="small">
                        <b>Author
                            :</b> <?= htmlspecialchars(\gLoad\Classes\ThemeManager::getThemeConfig($themeName)['author']) ?>
                        <br>
                        <b>Version
                            :</b> <?= htmlspecialchars(\gLoad\Classes\ThemeManager::getThemeConfig($themeName)['version']) ?>
                    </p>
                        <?php
                    } else {
                        ?>
                        <div class="alert alert-danger" role="alert">
                            <strong>OMG!</strong> An error occurred while trying to get the current theme. Please, choose a valid theme from the list of available themes.
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="col-12 col-md-6">
                    <form method="POST" action="/update/theme">
                        <div class="form-row">
                            <div class="col-6">
                                <h4><label for="themeSelect">Available themes : </label></h4>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <select class="form-control" id="themeSelect" name="themeName">
                                        <?php
                                        foreach (\gLoad\Classes\ThemeManager::getAllThemes() as $theme){
                                            echo '<option>' . htmlspecialchars($theme) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-outline-success btn-block">Use this theme</button>
                            </div>
                        </div>
                    </form>
                </div>
                <?php
                    if(\gLoad\Classes\ThemeManager::isTheme($themeName)) {
                        ?>
                        <div class="col-12">
                            <h4></h4>
                            <div class="accordion" id="accordionConfig">
                                <div class="card">
                                    <div class="card-header" id="main">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link" type="button" data-toggle="collapse"
                                                    data-target="#collapseMain" aria-expanded="false"
                                                    aria-controls="collapseMain">
                                                Configuring <code><?= $themeName ?></code>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapseMain" class="collapse" aria-labelledby="main"
                                         data-parent="#accordionConfig">
                                        <div class="card-body">
                                            <?php
                                                $themeExtra = \gLoad\Classes\ThemeManager::getThemeConfig($themeName)['extra'][0];
                                                if (is_array($themeExtra) && !empty($themeExtra)) {
                                                    ?>
                                                    <form method="POST" action="/update/theme/settings"
                                                          name="themeSettings">
                                                        <input type="hidden" class="invisible" value="<?= $themeName ?>"
                                                               name="themeName">
                                                        <div class="form-row">
                                                            <?php
                                                            foreach (\gLoad\Classes\ThemeManager::getThemeConfig($themeName)['extra'][0] as $key => $extraConfig) {
                                                                if (is_array($extraConfig)) {
                                                                    ?>
                                                                    <div class="col-12 col-md-4">
                                                                        <div id="<?= $key ?>">
                                                                            <h5>
                                                                                <label for="<?= $key ?>"><code><?= $key ?></code></label>
                                                                            </h5>
                                                                            <?php
                                                                            $i = 0;
                                                                            foreach ($extraConfig as $value) {
                                                                                ?>
                                                                                <div id="<?= $key . $i?>" class="input-group mb-3">
                                                                                    <input name="<?= $key ?>[]" type="text"
                                                                                           class="form-control config-text"
                                                                                           value="<?= $value ?>">
                                                                                    <div class="input-group-append">
                                                                                        <button type="button" class="btn btn-danger" data-toggle="deleteField"
                                                                                                data-target="<?= $key . $i?>">
                                                                                            <i class="fas fa-minus"></i>
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                                <?php
                                                                                $i++;
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                        <button type="button"
                                                                                class="btn btn-outline-dark btn-block"
                                                                                data-toggle="configFields"
                                                                                data-target="<?= $key ?>">Adding a new
                                                                            field
                                                                        </button>
                                                                    </div>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <div id="<?= $key ?>" class="col-12">
                                                                        <h5 class="inline"><code><?= $key ?></code> :
                                                                        </h5> <input
                                                                                type="text" class="form-control"
                                                                                value="<?= $extraConfig ?>"
                                                                                name="<?= $key ?>">
                                                                    </div>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                    </form>
                                                    <hr>
                                                    <button id="updateButton" class="btn btn-outline-warning btn-block btn-lg">Update theme's
                                                        settings
                                                    </button>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <div class="alert alert-warning" role="alert">
                                                        <strong>A problem occurred</strong> while trying to get theme's
                                                        extra configuration. Maybe your theme just don't support extra
                                                        configs ?
                                                    </div>
                                                    <?php
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <h5>gLoad</h5>
                    <p><a href="https://github.com/Gabyfle/gLoad">gLoad</a> is an open-sourced project hosted by <a href="https://github.com">Github</a>, created by <a href="https://github.com/Gabyfle">@Gabyfle</a> maintained by the community.</p>
                </div>
                <div class="col-12 col-md-6">
                    <h5>Join the community</h5>
                    <p>Don't be shy and join the <a href="https://github.com/Gabyfle/gLoad">Github Community</a> to start contributing for this project!</p>
                </div>
            </div>
        </div>
        <div id="gloadCopyright">
            <div class="container">
                &copy; Gabriel Santamaria <?= date('Y'); ?>. <b>gLoad</b> is licensed under <a href="https://www.apache.org/licenses/LICENSE-2.0">Apache 2.0</a> license.
            </div>
        </div>
    </footer>
    <script src="<?= \gLoad\Classes\Helpers::get_server_url() . '/compiled/js/jquery.min.js' ?>"></script>
    <script src="<?= \gLoad\Classes\Helpers::get_server_url() . '/compiled/js/popper.min.js' ?>"></script>
    <script src="<?= \gLoad\Classes\Helpers::get_server_url() . '/compiled/js/bootstrap.min.js' ?>"></script>
    <script src="<?= \gLoad\Classes\Helpers::get_server_url() . '/compiled/js/gloadAdmin.js' ?>"></script>
</body>
</html>
