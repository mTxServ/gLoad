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
     * @throws Exception
     */
    public function __construct(string $file, string $themeName)
    {
        if(!is_file($file))
        {
            throw new Exception('Parser load failed. Can\'t find ' . $file);
        }
        $baseUrl = Helpers::get_server_url();

        $this->htmlFile = file_get_contents($file);
        $this->root = $baseUrl;
        $this->themeRoot = $baseUrl. '/themes/' . $themeName;
    }

    public function parse_config()
    {
        $data = Helpers::theme_config('default');
        $keys = [];

        if(!$data or !$data['extra'][0])
            return false;

        $pattern = '/{{json: (.*),/';
        preg_match_all($pattern, $this->htmlFile, $m);

        foreach ($m[1] as $key => $value)
            $keys[] = $value;

        foreach ($keys as $key) {
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

                    foreach ($match as $t) {
                        $delimiters = [];
                        $replace = '';

                        $delimiters[] = explode("{{var}}", $v);

                        foreach ($data['extra'][0][$key] as $v)
                            $replace .= implode($v, $delimiters[0]);

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
    public function parse()
    {
        $patterns = [
            '/{{style: (.*)}}/',
            '/{{script: (.*)}}/',
            '/{{siteroot}}/',
            '/{{steamavatar}}/',
            '/{{steamid}}/'
        ];
        $replace = [
            '<link href="' . $this->themeRoot . '/$1" rel="stylesheet"/>',
            '<script src="' . $this->themeRoot .'/$1"></script>',
            $this->root,
            '<img src="" alt="User steam avatar" />',
            'User steam id'
        ];
        return preg_replace($patterns, $replace, $this->htmlFile);
    }
}