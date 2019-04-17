<?php
/**
 * gLoad
 * core.php
 *
 * Include every classes located in /classes and /controllers
 *
 * @author Gabriel Santamaria <gaby.santamaria@outlook.fr>
 * @license Apache License Version 2.0, January 2004
 * @license http://www.apache.org/licenses/
 * @version 1.0-beta
 */
$relativePaths = [
    'app/core/classes',
    'app/core/controllers'
];
foreach ($relativePaths as $path)
{
    $classes = scandir($path);
    foreach ($classes as $class) {
        if (!is_file($path . '/' . $class))
            continue;
        if (pathinfo($path . '/' . $class, PATHINFO_EXTENSION) == 'php')
            require($path . '/' . $class);
    }
}