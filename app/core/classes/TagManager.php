<?php
/**
 * gLoad
 * TagManager.php
 *
 * This is the HTML files parser.
 *
 * @author Gabriel Santamaria <gaby.santamaria@outlook.fr>
 * @license Apache License Version 2.0, January 2004
 * @license http://www.apache.org/licenses/
 * @version 1.0-beta
 */
namespace gLoad\Classes;

class TagManager
{
    /**
     * @var false|string Contain HTML code.
     */
    private $htmlFile;
    private $root;
    private $themeRoot;

    /**
     * TagManager constructor.
     * @param string $file
     * @throws \Exception
     */
    public function __construct(string $file, string $themeName)
    {
        if(!is_file($file))
        {
            throw new \Exception('Parser load failed. Can\'t find ' . $file);
        }
        $baseUrl = Helpers::get_server_url();

        $this->htmlFile = file_get_contents($file);
        $this->root = $baseUrl;
        $this->themeRoot = $baseUrl. '/themes/' . $themeName;
    }

    public function parse_config()
    {
        try{
            $data = \gLoad\Classes\ThemeManager::getThemeConfig('default');
        } catch(\ErrorException $e) {
            return false;
        }

        $keys = [];

        if(!$data or !$data['extra'][0])
            return false;

        $pattern = '/{{json: (.*),/';
        preg_match_all($pattern, $this->htmlFile, $m);

        foreach ($m[1] as $key => $value)
            $keys[] = $value;

        foreach ($keys as $key) {
            /* Preventing from missing configs */
            if (!isset($data['extra'][0][$key]))
                continue;

            $pattern = '/{{json: ' . $key . ', (.*)}}/';
            preg_match_all($pattern, $this->htmlFile, $m);

            foreach ($m as $i => $value) {
                if ($i != 1)
                    continue;

                foreach ($value as $v)
                {
                    $subPattern = '/' . preg_quote('{{json: ' . $key . ', ' . $v . '}}', '/') . '/';
                    preg_match($subPattern, $this->htmlFile, $match);
                    if (!$match)
                        continue;

                    $delimiters = [];
                    $delimiters[] = explode("{{var}}", $v);

                    foreach ($match as $t) {
                        if (is_array($data['extra'][0][$key])) {
                            $replace = '';
                            foreach ($data['extra'][0][$key] as $v)
                                $replace .= implode($v, $delimiters[0]);
                        } else {
                            $replace = $data['extra'][0][$key];
                        }

                        $this->htmlFile = preg_replace($subPattern, $replace, $this->htmlFile);
                    }
                }
            }
        }
    }

    /**
     * Parse the htmlFile and returns the HTML parsed code.
     *
     * @return string|string[]|null
     */
    public function parse_user_data()
    {
        $steamId = isset($_GET['steamid']) ? $_GET['steamid'] : false;

        if($steamId)
            $userData = \gLoad\Classes\Helpers::get_steam_user_data($_GET['steamid']);
        else
            $userData = [];

        /* Defining basic tags */
        $patterns = [
            '/{{style: (.*)}}/',
            '/{{script: (.*)}}/',
            '/{{siteroot}}/'
        ];
        $replace = [
            '<link href="' . $this->themeRoot . '/$1" rel="stylesheet"/>',
            '<script src="' . $this->themeRoot .'/$1"></script>',
            $this->root
        ];
        /* Defining every user-related tags */
        foreach ($userData as $key => $value) {
            $patterns[] = '/{{' . preg_quote($key) . '}}/';
            $replace[] = $value;
        }

        return preg_replace($patterns, $replace, $this->htmlFile);
    }
}