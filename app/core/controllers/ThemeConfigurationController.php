<?php
/**
 * Class ThemeConfigurationController
 * @method POST
 *
 * Access to admin dashboard
 *
 * @author Gabriel Santamaria <gaby.santamaria@outlook.fr>
 * @license Apache License Version 2.0, January 2004
 * @license http://www.apache.org/licenses/
 * @version 1.0-beta
 */

namespace gLoad\Controllers;


use Gabyfle\SteamAuth;
use gLoad\Classes\Controller;

class ThemeConfigurationController extends Controller
{
    private $openid;

    public function __construct()
    {
        $steamApiKey = \gLoad\Classes\Helpers::get_param_ini_file('config.ini', 'steamKey');
        try{
            $this->openid = new SteamAuth('localhost', $steamApiKey);
        } catch(\ErrorException $e){
            /* TODO: adding the error to PHP logs */
            header('Location: /loading');
        }
    }

    /**
     * Return whether or not the user is a superadmin (and if he's connected
     * @return bool
     */
    private function isValidUser()
    {
        return $this->openid->check() && $this->openid::getUserData('steamid') == \gLoad\Classes\Helpers::get_param_ini_file('config.ini', 'superadmin');
    }

    /**
     * Returns whether or not the POST variable is correctly set
     * @return bool
     */
    private function isValidPost()
    {
        return isset($_POST['themeName']);
    }

    public function run()
    {
        if (!$this->isValidUser()) { /* Preventing from leaked page link */
            require_once VIEWS_PATH . '404.php';
        } elseif ($this->isValidPost()) {
            \gLoad\Classes\Helpers::write_ini_file('config.ini', 'theme', $_POST['themeName']);
            header('Location: /admin');
        } else {
            header('Location: /loading');
        }
    }
}