<?php
/**
 * Header for the template
 * 
 * @author      José Roberto Alas <jrobertoalas@gmail.com>
 * @copyright   Copyright (C) 2018, Open Source LadySusy
 * @licence     http://www.ladysusy.org/licences/ladysusy-licence.php
 */
 
// Avoid direct access
defined('_LS') or die;

$config = LSPrincipal::getConfig();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/favicon.ico">
    <title><?php echo $config->appName ?> - LS -</title>
  </head>
<body>
<h2><?php echo LSText::_('TITULO_BASE'); ?></h2>
