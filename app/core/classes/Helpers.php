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
     * Parse the owner's name and the name of the repository (works only with github)
     * Gist : https://gist.github.com/Gabyfle/dd07b51c39627e5038b47efe5037d028
     *
     * @param string $repo_url
     * @return array
     */
    private static function parse_repo_name(string $repo_url)
    {
        $pattern = '/^https?:\/\/(?:www.)?github\.com\/(.*)\/(.*)/';
        preg_match($pattern, $repo_url, $matches);

        return $matches;
    }
    /**
     * Gets the name of the latest's release tag
     * Gist : https://gist.github.com/Gabyfle/dd07b51c39627e5038b47efe5037d028
     *
     * @param string $github_repo_link
     * @return string
     */
    public static function get_latest_version(string $github_repo_link)
    {
        /* Verifying that the data file exists */
        if(is_file(DOCUMENT_ROOT . '/data/latest-release.txt')) {
            $data = file_get_contents(DOCUMENT_ROOT . '/data/latest-release.txt');
            $decoded = json_decode($data, true);
        } else{
            $decoded['lastFetched'] = 0;
        }

        if (time() - $decoded['lastFetched'] <=  (5 * 3600)) {
            $releaseName = $decoded['releaseName'];
        } else {
            $github_infos = self::parse_repo_name($github_repo_link);
            $get_options = [
                'http' => [
                    'method' => 'GET',
                    'header' => [
                        'User-Agent: getting-releases (made by Gabyfle)'
                    ]
                ]
            ];
            $context = stream_context_create($get_options);
            $apiRepositoryUrl = 'https://api.github.com/repos/' . $github_infos[1] . '/' . $github_infos[2] . '/releases';
            $json = file_get_contents($apiRepositoryUrl, false, $context);
            $content = json_decode($json, true);

            $releaseName = $content[0]['name'];

            $toEncode = [
                'lastFetched' => time(),
                'releaseName' => $releaseName
            ];

            $flow = fopen(DOCUMENT_ROOT . '/data/latest-release.txt', 'w+');
            fwrite($flow, json_encode($toEncode));
        }

        return $releaseName;
    }

    /**
     * Gets user data from steam's services
     * @param string $steamId the user steam ID
     * @return mixed
     */
    public static function get_steam_user_data(string $steamId)
    {
        $steamUrl = 'http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=' . self::get_param_ini_file('config.ini', 'steamKey') . '&steamids=' . $steamId;
        $json = file_get_contents($steamUrl);
        $contents = json_decode($json, true);

        return $contents['response']['players'][0];
    }
}