<?php
/**
 * Definitions
 * 
 * @author      José Roberto Alas <jrobertoalas@gmail.com>
 * @copyright   Copyright (C) 2018, Open Source LadySusy
 * @licence     http://www.ladysusy.org/licences/ladysusy-licence.php
 */

// Global definitions
$parts = explode(DIRECTORY_SEPARATOR, LS_BASE);
 
// File paths
define('LS_ROOT', implode(DIRECTORY_SEPARATOR, $parts));
define('LS_APLICACION', LS_ROOT);
define('LS_CONFIGURACION', LS_ROOT);
define('LS_LIBRERIAS', LS_ROOT . '/lib');
define('LS_ADMINISTRACION', LS_ROOT . '/admin');
define('LS_LENGUAJE', LS_ROOT . '/language');
define('LS_COM', LS_ROOT . '/ladysusycom');
define('LS_LOGS', LS_ROOT . '/logs/');
define('LS_TEMPLATE', LS_ROOT . '/template');

// Definitions for error handling
define("ADMIN_EMAIL", "jrobertoalas@gmail.com");
define("LOG_FILE", LS_LOGS."error.log");
 
// Destination types
define("DEST_EMAIL", "1");
define("DEST_LOGFILE", "3");

setlocale(LC_ALL, "es_ES");
