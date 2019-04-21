<?php
/**
 * Class ThemeConfigurationController
 * @method POST
 *
 * Update the theme configuration
 *
 * @author Gabriel Santamaria <gaby.santamaria@outlook.fr>
 * @license Apache License Version 2.0, January 2004
 * @license http://www.apache.org/licenses/
 * @version 1.0-beta
 */

namespace gLoad\Controllers;


use Gabyfle\SteamAuth;
use gLoad\Classes\Controller;

class ThemeSettingsController extends Controller
{
    private $openid;
    private $themeConfig;

    public function __construct()
    {
        $steamApiKey = \gLoad\Classes\Helpers::get_param_ini_file('config.ini', 'steamKey');
        try{
            $this->openid = new SteamAuth('localhost', $steamApiKey);
        } catch(\Exception $e){
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
        if (!isset($_POST['themeName']))
            return false;
        $themeName = \gLoad\Classes\Helpers::get_param_ini_file('config.ini', 'theme');
        if ($themeName != $_POST['themeName'])
            return false;

        try {
            $this->themeConfig = \gLoad\Classes\ThemeManager::getThemeConfig($themeName);
            foreach ($this->themeConfig['extra'][0] as $key => $value) {
                if (!isset($_POST[$key]) && !is_array($this->themeConfig['extra'][0]))
                        return false;
            }

        } catch(\Exception $e) {
            /* TODO: add this error to php logs */
            return false;
        }

        return true;
    }

    public function run()
    {
        if (!$this->isValidUser()) { /* Preventing from leaked page link */
            require_once VIEWS_PATH . '404.php';
        } elseif ($this->isValidPost()) {
            foreach ($this->themeConfig['extra'][0] as $key => $value) {
                if(!isset($_POST[$key]) && is_array($this->themeConfig['extra'][0])) {
                    $this->themeConfig['extra'][0][$key] = [];
                    continue;
                }
                $this->themeConfig['extra'][0][$key] = $_POST[$key];
            }

            \gLoad\Classes\ThemeManager::setThemeConfig($_POST['themeName'], $this->themeConfig);
            header('Location: /admin');
        } else {
            header('Location: /loading');
        }
    }
}