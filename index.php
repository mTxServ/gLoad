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
session_start();
define('VIEWS_PATH', 'app/views/');
define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']);

require __DIR__ . '/vendor/autoload.php';

$request = $_SERVER['REQUEST_URI'];
$uri = explode('?', $request, 2)[0];
$base = gLoad\Classes\Helpers::get_param_ini_file('config.ini', 'install');

if (is_string($base) && strlen($base) >= 2)
    if ($base[0] != '/')
        $base = '/' . $base;
else
    $base = '/';

$proper = str_replace($base, '', $uri);

switch ($proper)
{
    case '/admin':
        $controller = new gLoad\Controllers\AdminController();
        break;
    case '/loading':
        $controller = new gLoad\Controllers\LoadingController();
        break;
    case '/connect':
        $controller = new gLoad\Controllers\ConnectionController();
        break;
    case '/disconnect':
        $controller = new gLoad\Controllers\DisconnectController();
        break;
    default:
        $controller = new gLoad\Controllers\ErrorController();
        break;
}

$controller->run();