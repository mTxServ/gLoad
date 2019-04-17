<?php
/**
 * Class AdminController
 *
 * Access to admin dashboard
 *
 * @author Gabriel Santamaria <gaby.santamaria@outlook.fr>
 * @license Apache License Version 2.0, January 2004
 * @license http://www.apache.org/licenses/
 * @version 1.0-beta
 */

class AdminController extends Controller
{
    private $openid;

    public function __construct()
    {
        $steamApiKey = Helpers::get_param_ini_file('config.ini', 'steamKey');
        $this->openid = new Gabyfle\SteamAuth('localhost', $steamApiKey);
    }

    /**
     * isConnected()
     * @return bool
     */
    private function isConnected()
    {
        return $this->openid->__check();
    }

    /**
     * isAdmin
     * Return whether or not an user is an administrator
     * @return bool
     */
    private function isAdmin()
    {
        if (!$this->isConnected())
            return false;
        else {
            $adminSteam = Helpers::get_param_ini_file('config.ini', 'admin');
            $userId = $this->openid->getUserData('steamid');
            return $adminSteam == $userId;
        }
    }

    public function run()
    {
        if (!$this->isAdmin())
            header('Location: /loading');
        else
            require_once VIEWS_PATH . 'admin.php';
    }

}