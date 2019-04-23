<?php
/**
 * gLoad
 * themeload.php
 *
 * Includes the right theme thanks to ThemeManager class
 *
 * @author Gabriel Santamaria <gaby.santamaria@outlook.fr>
 * @license Apache License Version 2.0, January 2004
 * @license http://www.apache.org/licenses/
 * @version 1.0-beta
 */

$manager = new \gLoad\Classes\ThemeManager();
$themeName = \gLoad\Classes\ThemeManager::getTheme();
$themePaths = [
    'folder' => \gLoad\Classes\ThemeManager::getThemesRoot() . $themeName,
    'index' => \gLoad\Classes\ThemeManager::getThemesRoot() . $themeName . '/index.html',
    'json' => \gLoad\Classes\ThemeManager::getThemesRoot() . $themeName . '/theme.json'
];

try{
    $parser = new \gLoad\Classes\TagManager($themePaths['index'], $themeName);
    $parser->parse_config();
    $htmlCode = $parser->parse_user_data();
} catch(ErrorException $e) {
    echo 'An error occurred while trying to get the theme\'s data : ' . $e;
}

echo $htmlCode;