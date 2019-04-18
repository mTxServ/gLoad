<?php
/**
 * Class ConnectionController
 *
 * Controls the user's connection to steam services
 *
 * @author Gabriel Santamaria <gaby.santamaria@outlook.fr>
 * @license Apache License Version 2.0, January 2004
 * @license http://www.apache.org/licenses/
 * @version 1.0-beta
 */
namespace gLoad\Controllers;

use gLoad\Classes\Controller;

class ConnectionController extends Controller
{
    private $openid;

    public function __construct()
    {
        $url = \gLoad\Classes\Helpers::get_server_url();
        $steamKey = \gLoad\Classes\Helpers::get_param_ini_file('config.ini', 'steamKey');
        try{
            $this->openid = new \Gabyfle\SteamAuth($url, $steamKey);
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

    public function run()
    {
        if ($this->isConnected())
        {
            $this->openid->getDataFromSteam();
            header('Location: /admin');
            return;
        }
        try{
            $this->openid->open();
        } catch (\ErrorException $e){
            /* TODO: adding the error to PHP logs */
            header('Location: /loading');
        }

    }
}