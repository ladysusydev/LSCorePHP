<?php
/**
 * Component base
 * 
 * @author      José Roberto Alas <jrobertoalas@gmail.com>
 * @copyright   Copyright (C) 2018, Open Source LadySusy
 * @licence     http://www.ladysusy.org/licences/ladysusy-licence.php
 */

define('_LS', 1);

$content = LSController::getInstance('base');
$content->display();
