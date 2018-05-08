<?php
/**
 * Index
 * 
 * @author      José Roberto Alas <jrobertoalas@gmail.com>
 * @copyright   Copyright (C) 2018, Open Source LadySusy
 * @licence     http://www.ladysusy.org/licences/ladysusy-licence.php
 */

// Defining main routes of the application and loading libraries

define('SD', DIRECTORY_SEPARATOR);
define('LS_BASE', dirname(__FILE__));
define('LS_APP', basename(LS_BASE));

require_once LS_BASE.SD.'includes'.SD.'defines.php';
require_once LS_BASE.SD.'includes'.SD.'environment.php';

// Getting an instance of the main class
$ladysusy = LSPrincipal::getApplication('application');

// Initialize the application
$ladysusy->initialize();

// Route the application
$ladysusy->router();

// Rendering the application
$ladysusy->render();

echo $ladysusy;
