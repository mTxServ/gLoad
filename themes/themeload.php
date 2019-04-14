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
$manager = new ThemeManager();
$themeName = $manager->getTheme();
$themePaths = [
    'folder' => $manager->getThemesRoot() . $themeName,
    'index' => $manager->getThemesRoot() . $themeName . '/index.html',
    'json' => $manager->getThemesRoot() . $themeName . '/theme.json'
];

$parser = new TagManager($themePaths['index'], $themeName);
$parser->parse_config();
$htmlCode = $parser->parse();

echo $htmlCode;