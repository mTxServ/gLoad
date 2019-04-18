<?php
/**
 * Class LoadingController
 *
 * Access to loading screen
 *
 * @author Gabriel Santamaria <gaby.santamaria@outlook.fr>
 * @license Apache License Version 2.0, January 2004
 * @license http://www.apache.org/licenses/
 * @version 1.0-beta
 */
namespace gLoad\Controllers;

use gLoad\Classes\Controller;

class LoadingController extends Controller
{
    public function __construct()
    {

    }

    public function run()
    {
        require VIEWS_PATH . 'loading.php';
    }
}