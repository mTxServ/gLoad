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
namespace gLoad\Controllers;

use gLoad\Classes\Controller;

class AdminController extends Controller
{
    private $openid;

    public function __construct()
    {
        $steamApiKey = \gLoad\Classes\Helpers::get_param_ini_file('config.ini', 'steamKey');
        try{
            $this->openid = new \Gabyfle\SteamAuth('localhost', $steamApiKey);
        } catch(\ErrorException $e){
            /* TODO: adding the error to PHP logs */
            header('Location: /loading');
        }
    }

    /**
     * isConnected()
     * @return bool
     */
    private function isConnected()
    {
        return $this->openid->check();
    }

    /**
     * isAdmin
     * Return whether or not an user is an administrator
     * @return bool
     */
    private function isAdmin()
    {
        $adminSteam = \gLoad\Classes\Helpers::get_param_ini_file('config.ini', 'superadmin');
        $userId = $this->openid->getUserData('steamid');
        return $adminSteam == $userId;
    }

    public function run()
    {
        if (!$this->isConnected())
            header('Location: /connect'); // redirect to connection page
        elseif(!$this->isAdmin()) {
            $this->openid->disconnect();
            header('Location: /loading');
        } else
            require_once VIEWS_PATH . 'admin.php';
    }

}