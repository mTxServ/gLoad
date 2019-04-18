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
namespace gLoad\Classes;

class ThemeManager
{
    private $themeRoot;
    private $configuration;

    /**
     * ThemeManager constructor.
     */
    function __construct()
    {
        $this->themeRoot = $_SERVER['DOCUMENT_ROOT'] . '/themes/';
        $this->configuration = $_SERVER['DOCUMENT_ROOT'] . '/config.ini';
    }

    /**
     * Returns the /themes folder path
     *
     * @return string
     */
    public function getThemesRoot()
    {
        return $this->themeRoot;
    }

    /**
     * Sets the appropriate theme in config.ini
     *
     * @param string $themeName
     * @throws \Exception
     */
    public function setTheme(string $themeName)
    {
        if(!is_string($themeName))
            throw new \Exception('First argument must be a string.');

        Helpers::write_ini_file($this->configuration, 'theme', $themeName);
    }

    /**
     * Returns if $themeName is an available theme
     *
     * @param string $themeName
     * @return bool
     */
    public function isTheme(string $themeName)
    {
        $themePath = $this->themeRoot . $themeName;
        return is_dir($themePath);
    }

    /**
     * Gets every available theme
     *
     * @return array
     */
    public function getAllThemes()
    {
        $themes = [];

        foreach (scandir($this->themeRoot) as $dir)
            if(is_dir($dir))
                $themes[] = $dir;

        return $themes;
    }

    /**
     * Gets the current installation's theme
     *
     * @return mixed
     */
    public function getTheme()
    {
        $config = parse_ini_file($this->configuration, false);
        return $config['theme'];
    }

}