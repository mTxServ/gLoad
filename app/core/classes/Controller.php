<?php
/**
 * Class Controller
 *
 * Basic Controller
 *
 * @author Gabriel Santamaria <gaby.santamaria@outlook.fr>
 * @license Apache License Version 2.0, January 2004
 * @license http://www.apache.org/licenses/
 * @version 1.0-beta
 */
namespace gLoad\Classes;

abstract class Controller
{
    /**
     * Displays the view to the user
     *
     * @return void
     */
    abstract function run();
}