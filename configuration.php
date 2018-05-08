<?php
/**
 * Configuration
 * 
 * @author      José Roberto Alas <jrobertoalas@gmail.com>
 * @copyright   Copyright (C) 2018, Open Source LadySusy
 * @licence     http://www.ladysusy.org/licences/ladysusy-licence.php
 */

define('_LS', 1);

/**
 * Class that allows me to define the environment variables of the system
 */
class LSConfig
{
    /**
     * Server URL
     */ 
    public $baseUrl = 'http://localhost';
    
    /**
     * Server
     */ 
    public $server = 'localhost';

    /**
     * System name
     */ 
    public $appName = 'Core LS';
    
    /**
     * Security Hash
     */ 
    public $hashKey = '5037a60152ac0';

    /**
     * User of database
     */ 
    public $user = 'iccae';
    
    /**
     * Database password
     */ 
    public $password = 'COICDB44%pwd';
    
    /**
     * ID root
     */ 
    public $userRoot = 1;

    /**
     * Database
     */ 
    public $database = 'lscorephp';
    
    /**
     * Prefix of tables in the database
     */ 
    public $dbprefix = 'ls_';

    /**
     * Language of the application
     */ 
    public $language = 'en-US';
    
    /**
     * State of trace
     */ 
    public $trace = false;

    /**
     * Template defined
     */ 
    public $template = 'ladysusy';
    
    /**
     * Version of the application
     */ 
    public $version = '1.1';

    /**
     * Application channel
     */ 
    public $channel = 'development';
}
