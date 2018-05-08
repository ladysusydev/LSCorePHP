<?php
/**
 * Environment
 * 
 * @author      José Roberto Alas <jrobertoalas@gmail.com>
 * @copyright   Copyright (C) 2018, Open Source LadySusy
 * @licence     http://www.ladysusy.org/licences/ladysusy-licence.php
 */

// Directional separator
if (!defined('SD')) {
    define('SD', DIRECTORY_SEPARATOR);
}

if (!defined('LS_BASE')) {
    $routeBaseTemp = dirname(__FILE__);
    $routeBase = strstr($routeBaseTemp, SD.LS_APP, true);
    define('LS_BASE', $routeBase.SD.LS_APP);
    
    // Include definitions and main libraries
    require_once LS_BASE.SD.'includes'.SD.'defines.php';
}

// Load configuration
ob_start();
require_once LS_CONFIGURACION.SD.'configuration.php';
ob_end_clean();

// System configuration
$config = new LSConfig();

// Establishing bug reports
switch ($config->channel) {
    case 'default':
    case '-1':
        break;
    case 'none':
    case '0':
        error_reporting(0);
        break;
    case 'simple':
        error_reporting(E_ERROR | E_WARNING | E_PARSE);
        ini_set('display_errors', 1);
        break;
    case 'maximum':
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        break;
    case 'development':
        error_reporting(-1);
        ini_set('display_errors', 1);
        break;
    default:
        error_reporting($config->canal);
        ini_set('display_errors', 1);
        break;
}

unset($config);

// Importing libraries
require_once LS_LIBRERIAS.SD.'import.php';
