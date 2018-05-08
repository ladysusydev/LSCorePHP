<?php
/**
 * Component login
 * 
 * @author      José Roberto Alas <jrobertoalas@gmail.com>
 * @copyright   Copyright (C) 2018, Open Source LadySusy
 * @licence     http://www.ladysusy.org/licences/ladysusy-licence.php
 */
 
// Avoid direct access
defined('_LS') or die;

$task = LSReqenvironment::getVar('task', null, '');

if ($task != 'login' && $task != 'logout') {
    LSReqenvironment::setVar('task', '');
    $task = '';
}

$content = LSController::getInstance('login');
$content->execute($task);
