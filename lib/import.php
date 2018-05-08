<?php
/**
 * Import files
 * 
 * @author      José Roberto Alas <jrobertoalas@gmail.com>
 * @copyright   Copyright (C) 2018, Open Source LadySusy
 * @licence     http://www.ladysusy.org/licences/ladysusy-licence.php
 */

// Avoid direct access
defined('_LS') or die;

// Importing library that will allow me to include the scripts
if (!class_exists('LSLoads')) {
    require_once LS_LIBRERIAS .'/loads.php';
}

// Starting the automatic charger
LSLoads::init();

// Importing the main libraries
LSLoads::import('ladysusy.ladysusy');
LSLoads::import('ladysusy.database.database');
LSLoads::import('ladysusy.model');
LSLoads::import('ladysusy.database.queries');
LSLoads::import('ladysusy.database.requests');
LSLoads::import('ladysusy.session');
LSLoads::import('ladysusy.environment.reqenvironment');
LSLoads::import('ladysusy.error');
LSLoads::import('ladysusy.user');
LSLoads::import('ladysusy.environment.content');
LSLoads::import('ladysusy.answer');
LSLoads::import('ladysusy.text');
LSLoads::import('ladysusy.hash');
LSLoads::import('ladysusy.controller');
LSLoads::import('ladysusy.view');

/**
 * Importing the library to obtain components
 */ 
if (!class_exists('LSComponent')) {
    require_once LS_APLICACION.'/includes/component.php';
}
