<?php
/**
 * gLoad
 * themes.class.php
 * 
 * The main themes class which manage the theme system
 * It's a core file, do not delete it
 * 
 * @author Gabriel Santamaria <gaby.santamaria@outlook.fr>
 * @license Apache License Version 2.0, January 2004
 * @license http://www.apache.org/licenses/
 * @version 1.0-beta
 */
class ThemeManager
{
    private $configPath;

    function __construct()
    {
        $this->configPath = $_SERVER['DOCUMENT_ROOT'] . 'config.ini';
    }

    /**
     * Sets the appropriate theme in config.ini
     *
     * @throws \InvalidArgumentException in case of an invalid $themeName argument
     * @throws \Exception in case of files related problems
     * @param string $themeName The theme name.
     */
    public function setTheme(string $themeName)
    {
        if(!is_string($themeName))
        {
            throw new \InvalidArgumentException('First argument must be a string.');
        }
        if(!$handle = fopen($this->configPath, 'w'))
        {
            throw new Exception('Can\'t point to the config file', 1);
        }
        $configString = parse_ini_string($this->configPath);

        $configString = preg_replace('/theme = (.*)/', '$0 --> theme = ' . $themeName, $configString);

        if(!fwrite($handle, $configString))
        {
            throw new Exception('Can\'t point to the config file', 1);
        }

    }

    public function getAllThemes()
    {

    }

    public function getTheme()
    {

    }

}