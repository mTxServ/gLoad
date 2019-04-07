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
switch ($uri)
{
    case '/':
        require 'app/views/loading.php';
    case '':
        require 'app/views/loading.php';
    case '/admin':
        require 'app/views/admin.php';
    case '/admin/':
        require 'app/views/admin.php';

}