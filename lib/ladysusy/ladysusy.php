<?php
/**
 * LS Principal
 * 
 * @author      José Roberto Alas <jrobertoalas@gmail.com>
 * @copyright   Copyright (C) 2018, Open Source LadySusy
 * @licence     http://www.ladysusy.org/licences/ladysusy-licence.php
 */

// Avoid direct access
defined('_LS') or die;

/**
 * The main Class of the application
 */
class LSPrincipal
{
    /**
     * Object for the Application class of the system
     *
     * @var  LSApplication
     */
    public static $application = null;
         
    /**
     * An instance to session class
     * 
     * @var LSSession
     */
    public static $session = null;
     
    /**
     * An instance for the database
     * 
     * @var   LSDatabase;
     */
    public static $database = null ;
     
    /**
     * An instance for the language class
     * 
     * @var LSConfig
     */
    public static $language = null;
     
    /**
     * An instance for the configuration class
     * 
     * @var Instance of a Class
     */
    public static $config = null;
  
    /**
     * An instance for the Mail class
     * 
     * @var   LSAMail
     */
    public static $mail = null;

    /**
     * An instance for the Authentication class of users
     * 
     * @var   LSAutentication
     */
    protected static $_user;

    /**
     * Get an LSApplication object
     * 
     * @param mix $app Name of the application passed by default
     * @param string $prefix Class Identifier
     *
     * @return Objeto LSApplication
     */
    public static function getApplication($app = null, $prefix = 'LS')
    {
        if (!self::$application) {
            if ($app == 'admin') {
                $route = LS_ADMINISTRACION . '/includes/application.php';
            } else {
                $route = LS_APLICACION . '/includes/application.php';
            }

            if (file_exists($route)) {
                include_once $route;
                $class = $prefix . ucfirst($app);
                $instance = new $class($app);
            } else {
                $error = 'The application is not instantiated, for: '.$ruta;
                return $error;
            }
            self::$application = &$instance;
        }

        return self::$application;
    }

    /**
     * Gets an object from the session
     * 
     * @param array $options Options passed in the session
     *
     * @return  LSSession object
     */
    public static function getSession($options = array())
    {
        $options['expires'] = 900;
        
        if (!self::$session) {
            self::$session = LSSession::getInstance($options);
        }

        return self::$session;
    }
    
    /**
     * Get object user
     *
     * @return Objeto LSUser
     */
    public static function getUser()
    {
        if (!self::$_user) {
            self::$_user = LSUser::getInstance();
        }

        return self::$_user;
    }

    /**
     * Get instance of Error class
     *
     * @return  LSError object
     */
    public static function getError()
    {
        $instance = LSError::getInstance();

        return $instance;
    }
    
    /**
     * Obtaining an object from the database
     *
     * @return  Objeto LSDatabase
     */
    public static function getDBO()
    {
        if (!self::$database) {
            self::$database = self::setDBO();
        }

        return self::$database;
    }

    /**
     * Creating an object in the database
     *
     * @return  Objeto LSDatabase
     */
    protected static function setDBO()
    {
        $_db = LSDb::getInstance();
        if ($_db instanceof Exception) {
            LSError::msgLog($_db->errno, $_db->error, $_SERVER['PHP_SELF']);
            die('Database Error:' . (string) $_db);
        }

        return $_db;
    }

    /**
     * It allows me to manage an operation to the database
     *
     * @param  string $sql query
     *
     * @return string
     */
    public function consultar($sql = '')
    {
        if (empty($sql)) {
            return false;
        }

        $_db = self::getDBO();
        if ($this->result = $_db->query($sql)) {
            return $this->result;
        } else {
            LSUtil::msgLog($_db->errno, $_db->error, $_SERVER['PHP_SELF']);
            die(LSText::_('ERROR_EJECUTAR_SQL'));
        }
    }

    /**
     * It allows to obtain the language that will be used in the application
     *
     * @return string A string that contains the language to use
     */
    public static function getLanguage()
    {
        if (!self::$language) {
            self::$language = self::setLanguage();
        }
        
        return self::$language;
    }

    /**
     * A string that represents the language to be used
     *
     * @return string
     */
    protected static function setLanguage()
    {
        $conf = self::getConfig();
        $language = $conf->language;

        return $language;
    }

    /**
     * Obtain the configuration of the application, by means of variables
     *
     * @param string $file The configuration file
     *
     * @return LSConfig
     */
    public static function getConfig($file = null)
    {
        if (!self::$config) {
            if ($file === null) {
                $file = LS_CONFIGURACION . '/configuration.php';
            }
            self::$config = self::setConfig($file);
        }

        return self::$config;
    }

    /**
     * It allows us to create a configuration object
     *
     * @param string $file The route to the file
     *
     * @return LSConfig
     */
    protected static function setConfig($file)
    {
        if (is_file($file)) {
            include_once $file;
        }

        // Verifying if the class exists
        $class = 'LSConfig';
        if (class_exists($class)) {
            // Instantiating the class
            $config = new $class;
        }

         return $config;
    }

    /**
     * Get instance to send emails
     *
     * @return string
     */
    public static function getMail()
    {
        // Una instance a LSMail
        $route = LS_LIBRARY . SD . 'ladysusy' .SD. 'mail.php';
        include_once $route;
        
        if (!self::$mail) {
            self::$mail = LSMail::getInstance();
        }

        return self::$mail;
    }
}
