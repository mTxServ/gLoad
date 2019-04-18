<?php
/**
 * Class ConnectionController
 *
 * Disconnect the user if he's connected and redirect him to the loading screen
 *
 * @author Gabriel Santamaria <gaby.santamaria@outlook.fr>
 * @license Apache License Version 2.0, January 2004
 * @license http://www.apache.org/licenses/
 * @version 1.0-beta
 */
namespace gLoad\Controllers;

use gLoad\Classes\Controller;

class DisconnectController extends Controller
{
    public function run()
    {
        \Gabyfle\SteamAuth::disconnect();
        header('Location: /loading');
    }
}