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
    private static $themeRoot = DOCUMENT_ROOT . '/themes/';
    private static $configuration = DOCUMENT_ROOT . '/config.ini';


    /**
     * Returns the /themes folder path
     *
     * @return string
     */
    public static function getThemesRoot()
    {
        return self::$themeRoot;
    }

    /**
     * Sets the appropriate theme in config.ini
     *
     * @param string $themeName
     * @throws \Exception
     */
    public static function setTheme(string $themeName)
    {
        if(!is_string($themeName))
            throw new \Exception('First argument must be a string.');

        Helpers::write_ini_file(self::$configuration, 'theme', $themeName);
    }

    /**
     * Returns if $themeName is an available theme
     *
     * @param string $themeName
     * @return bool
     */
    public static function isTheme(string $themeName)
    {
        $themePath = self::$themeRoot . $themeName;
        $themeConfig = self::$themeRoot . $themeName . '/theme.json';

        if (is_dir($themePath)) {
            if (!is_file($themeConfig))
                return false;

            $json = file_get_contents($themeConfig);
            $decoded = json_decode($json, true);
            return json_last_error() == JSON_ERROR_NONE && !empty($decoded['author']) && !empty($decoded['name']) && !empty($decoded['version']) && is_array($decoded['extra']); /* the file is a valid json */
        }

        return false;
    }

    /**
     * Gets every available theme
     *
     * @return array
     */
    public static function getAllThemes()
    {
        $themes = [];

        foreach (scandir(self::$themeRoot) as $dir) {
            if (self::isTheme($dir)){
                $themeConfig = self::$themeRoot . $dir . '/theme.json';
                $json = file_get_contents($themeConfig);
                $decoded = json_decode($json, true);

                $themes[] = $decoded['name'];
            }

        }

        return $themes;
    }

    /**
     * Gets the current installation's theme
     *
     * @return mixed
     */
    public static function getTheme()
    {
        $config = parse_ini_file(self::$configuration, false);
        return $config['theme'];
    }

    /**
     * Get the whole theme configuration file
     *
     * @param string $themeName
     * @return mixed
     * @throws \Exception
     */
    public static function getThemeConfig(string $themeName)
    {
        $themeConfig = self::$themeRoot . $themeName . '/theme.json';
        if (!is_file($themeConfig))
            throw new \Exception('Can\'t find the theme\'s config file.');

        $json = file_get_contents($themeConfig);

        $config = json_decode($json, true);
        return $config;
    }
}