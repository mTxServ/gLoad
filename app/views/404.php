<?php
/**
 * 404 not found page
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>404 - You're lost...</title>
        <link rel="stylesheet" href="<?= \gLoad\Classes\Helpers::get_server_url() . '/compiled/css/bootstrap.min.css' ?>">
        <link rel="stylesheet" href="<?= \gLoad\Classes\Helpers::get_server_url() . '/compiled/css/site.css' ?>">
    </head>
    <body>
        <div id="not-found">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1>It's seems you're lost.</h1>
                        <p class="small"><b>gLoad</b>, made with love by <a href="https://github.com/Gabyfle">@Gabyfle</a></p>
                    </div>
                    <div class="col-12">
                        <a href="/loading" class="btn btn-outline-success">Come back to the loading screen</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>