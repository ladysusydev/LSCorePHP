<?php
/**
 * Version
 * 
 * @author      José Roberto Alas <jrobertoalas@gmail.com>
 * @copyright   Copyright (C) 2018, Open Source LadySusy
 * @licence     http://www.ladysusy.org/licences/ladysusy-licence.php
 */
 
include ('configuration.php');
$config = new LSConfig();

echo "@@--- DATA OF THE SYSTEM ---@@";
echo "<br>";
echo "<br>";
echo "System: ".$config->appName;
echo "<br>";
echo "Version: ".$config->version;
echo "<br>";
echo "Channel: ".$config->channel;
echo "<br>";
echo "-----------------";
echo "<br>";
echo "Development by:";
echo "<br>";
echo "José Roberto Alas <jrobertoalas@gmail.com>";
echo "<br>";
