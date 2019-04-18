<?php
/**
 * Class Helpers
 * Some helper functions that will be used in the code
 */
namespace gLoad\Classes;

class Helpers
{
    /**
     * Write a new $value in a $param for an .ini file
     * Gist : https://gist.github.com/Gabyfle/3ea2a2ec1125f967fc06736c91d27df9
     *
     * @param string $path path of the .ini file
     * @param string $param parameter to change
     * @param string $value value to put in $param
     */
    public static function write_ini_file(string $path, string $param, string $value)
    {
        $parsedFile = parse_ini_file($path, true);
        $contents = '';

        foreach ($parsedFile as $sectionKey => $sectionValue)
        {
            if(is_array($sectionValue)) {
                $contents .= "[" . $sectionKey . "]\n";
                foreach ($sectionValue as $paramKey => $paramValue) {
                    if ($paramKey == $param)
                    {
                        $contents .= $paramKey . " = " . $value . "\n";
                    } else {
                        $contents .= $paramKey . " = " . $paramValue . "\n";
                    }
                }
            } else {
                if ($sectionKey == $param)
                {
                    $contents .= $sectionKey . " = " . $value . "\n";
                } else {
                    $contents .= $sectionKey . " = " . $sectionValue . "\n";
                }
            }
        }

        file_put_contents($path, $contents);
    }

    /**
     * Get a particular value from an .ini file
     *
     * @param string $path relative path to this file
     * @param string $param name of the parameter
     */
    public static function get_param_ini_file(string $path, string $param)
    {
        $parsed = parse_ini_file($path, false);

        return $parsed[$param];
    }

    /**
     * Get the full server URL including protocol and port
     *
     * @return string
     */
    public static function get_server_url()
    {
        /* Defining the server's protocol */
        if(!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) != 'off')
            $protocol = 'https';
        else
            $protocol = 'http';

        /* Defining server name */
        $serverName = $_SERVER['SERVER_NAME'];

        /* Defining server port */
        if ($_SERVER['SERVER_PORT'] != 80 || $_SERVER['SERVER_PORT'] != 443) {
            $port = ":{$_SERVER['SERVER_PORT']}";
        } else {
            $port = '';
        }

        return $protocol . '://' . $serverName . $port;
    }

    /**
     * Get the whole theme configuration file
     *
     * @param string $themeName
     * @return mixed
     * @throws \Exception
     */
    public static function theme_config(string $themeName)
    {
        $PATH = $_SERVER['DOCUMENT_ROOT'] . "/themes/" . $themeName . "/" . $themeName . ".json";
        if (!is_file($PATH))
            throw new \Exception('Can\'t find the theme\'s config file.');

        $json = file_get_contents($PATH);

        $config = json_decode($json, true);
        return $config;
    }
}