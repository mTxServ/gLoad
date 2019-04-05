<?php
/**
 * gLoad
 * core.php
 *
 * Include every classes located in /classes
 *
 * @author Gabriel Santamaria <gaby.santamaria@outlook.fr>
 * @license Apache License Version 2.0, January 2004
 * @license http://www.apache.org/licenses/
 * @version 1.0-beta
 */
$relativePath = 'app/core/classes';
$classes = scandir($relativePath);
foreach ($classes as $class) {
    if(!is_file($relativePath . '/' . $class))
        continue;
    if(pathinfo($relativePath . '/' . $class, PATHINFO_EXTENSION) == 'php')
        require($relativePath . '/' . $class);
}