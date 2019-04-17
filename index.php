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
define('VIEWS_PATH', 'app/views/');

require 'app/core/core.php';
require __DIR__ . '/vendor/autoload.php';

$request = $_SERVER['REQUEST_URI'];
$uri = explode('?', $request, 2)[0];
$base = Helpers::get_param_ini_file('config.ini', 'install');

if (is_string($base) && strlen($base) >= 2)
    if ($base[0] != '/')
        $base = '/' . $base;
else
    $base = '/"';

$proper = str_replace($base, '', $uri);

switch ($proper)
{
    case '/admin':
        $controller = new AdminController();
        break;
    case '/loading':
        $controller = new LoadingController();
        break;
    default:
        $controller = new ErrorController();
        break;
}

$controller->run();