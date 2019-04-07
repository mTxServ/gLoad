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
        $this->htmlFile = file_get_contents($file);
        $this->root = $_SERVER['DOCUMENT_ROOT'] . '/themes/' . $themeName;
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
            '/{{gloadscript}}/',
            '/{{steamavatar}}/',
            '/{{steamid}}/'
        ];
        $replace = [
            '<link href="' . $this->root . '/$1" rel="stylesheet"/>',
            '<script src="' . $this->root . '/gload.js"></script>',
            '<img src="" alt="User steam avatar" />',
            'User steam id'
        ];
        return preg_replace($patterns, $replace, $this->htmlFile);
    }
}