<?php
/**
 * Class ErrorController
 *
 * Access to error pages
 *
 * @author Gabriel Santamaria <gaby.santamaria@outlook.fr>
 * @license Apache License Version 2.0, January 2004
 * @license http://www.apache.org/licenses/
 * @version 1.0-beta
 */

class ErrorController extends Controller
{
    public function __construct()
    {
    }

    public function run()
    {
        require VIEWS_PATH . '404.php';
    }
}