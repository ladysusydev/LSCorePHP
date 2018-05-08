<?php
/**
 * Loads
 * 
 * @author      José Roberto Alas <jrobertoalas@gmail.com>
 * @copyright   Copyright (C) 2018, Open Source LadySusy
 * @licence     http://www.ladysusy.org/licences/ladysusy-licence.php
 */
 
// Avoid direct access
defined('_LS') or die;

/**
 * Class LSLoads
 */ 
class LSLoads
{
    /**
     * The file that is imported
     * 
     * @var array
     */
    protected static $fileImported = array();
    
    /**
     * Import files
     * 
     * @param string $route, contains the file path to include
     * 
     * @return
     */
    public static function import($route)
    {
        // Verifying if the route is already imported
        if (!isset(self::$fileImported[$route])) {
           
            // Configure some variables
            $success  = false;
            $base = dirname(__FILE__);
            $path = str_replace('.', DIRECTORY_SEPARATOR, $route);
                
            // If the file exists to include
            if (is_file($base . '/' . $path . '.php')) {
                $success = (bool) include_once $base . '/' . $path . '.php';
            }
            self::$fileImported[$route] = $success;
        }

        return self::$fileImported[$route];
    }
    
    
    /**
     * Starting the automatic charger
     */ 
     public static function init() 
     {
         spl_autoload_register(array('LSLoads', 'loads'));
     }
    
    /**
     * This method allows me to load all the files located in lib/cms
     * 
     * @param  string $class What will we load
     * 
     * @return  void
     */
     private static function loads($class)
     {
        if (class_exists($class, false)) {
            return true;
        }

        // Separating LS from file name
        $routeLoads = LS_LIBRERIAS.'/cms';
        $route = $routeLoads . '/' . strtolower($class) . '.php';

        // We include the file, verifying that there is
        if (file_exists($route)) {
            return include $route;
        }
     }
}
 
 /**
  * Importing necessary libraries when required
  * 
  * @param   string  $route, that will be what we are going to import
  * 
  * @return  boolean  True
 */
function ladysusyimport($route)
{
    return LSLoads::import($route);
}
