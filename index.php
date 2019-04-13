<?php
/**
 * gLoad
 * index.php
 *
 * Handle requests and generate the right page by getting
 * datas from the core app
 *
 * @author Gabriel Santamaria <gaby.santamaria@outlook.fr>
 * @license Apache License Version 2.0, January 2004
 * @license http://www.apache.org/licenses/
 * @version 1.0-beta
*/
require 'app/core/core.php';

$request = $_SERVER['REQUEST_URI'];
$uri = explode('?', $request, 2)[0];
$base = Helpers::get_param_ini_file('config.ini', 'install');

if (is_string($base) && strlen($base) >= 2)
    if ($base[0] != '/')
        $base = '/' . $base;
else
    $base = '/"';

$proper = str_replace($base, '', $uri);
/* Redirecting user */
switch ($proper)
{
    case '/admin':
        require 'app/views/admin.php';
        break;
    case '/loading':
        require 'app/views/loading.php';
        break;
    default:
        require 'app/views/404.php';
}