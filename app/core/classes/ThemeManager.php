<?php
/**
 * gLoad
 * ThemeManager.php
 * 
 * The main themes class which manage the theme system
 * It's a core file, do not delete it
 * 
 * @author Gabriel Santamaria <gaby.santamaria@outlook.fr>
 * @license Apache License Version 2.0, January 2004
 * @license http://www.apache.org/licenses/
 * @version 1.0-beta
 */
require 'Helpers.php';

class ThemeManager
{
    private $root;

    function __construct()
    {
        $this->root = $_SERVER['DOCUMENT_ROOT'] . 'config.ini';
    }

    /**
     * Sets the appropriate theme in config.ini
     *
     * @param string $themeName
     * @throws Exception
     */
    public function setTheme(string $themeName)
    {
        if(!is_string($themeName))
        {
            throw new InvalidArgumentException('First argument must be a string.');
        }

        Helpers::write_ini_file($this->root . '/config.ini', 'theme', $themeName);
    }

    /**
     * Returns if $themeName is an available theme
     *
     * @param string $themeName
     * @return bool
     */
    public function isTheme(string $themeName)
    {
        $themePath = $this->root . '/themes/' . $themeName;
        return is_dir($themePath);
    }

    /**
     * Gets every available theme
     *
     * @return array
     */
    public function getAllThemes()
    {
        $path = $this->root . '/themes/';
        $themes = [];

        foreach (scandir($path) as $dir)
        {
            if(is_dir($dir))
                $themes[] = $dir;
        }

        return $themes;
    }

    /**
     * Gets the current installation's theme
     *
     * @return mixed
     */
    public function getTheme()
    {
        $config = parse_ini_file($this->root . '/config.ini', false);
        return $config['theme'];
    }

}