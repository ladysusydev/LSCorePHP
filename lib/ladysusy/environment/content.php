<?php
/**
 * Content of the system
 * 
 * @author      José Roberto Alas <jrobertoalas@gmail.com>
 * @copyright   Copyright (C) 2018, Open Source LadySusy
 * @licence     http://www.ladysusy.org/licences/ladysusy-licence.php
 */

// Avoid direct access
defined('_LS') or die;

/**
 * Class to get the content to show
 */
class LSContent
{
    /**
     * Allows you to obtain the content, for a component
     * 
     * @param string $nomcomp The name of the component
     * 
     * @return string Content of the component
     */
    public static function render($nomcomp)
    {
        if (empty($nomcomp)) {
            // Error for not defining a component
            echo 'Error the component has not been established';
            
            return;
        }

        // Getting the name of the file
        $file = substr($nomcomp, 4);
            
        // We are going to define a variable for the component
        define('LS_COMPONENTE', LS_COM . '/' . $nomcomp);

        // Getting the file path
        $path = LS_COMPONENTE . '/' . $file . '.php';
    
        // Verifying if the file exists
        if (!file_exists($path)) {
            echo 'The file:'.$path.' not found';
        }
        
        // Getting the output
        $cont = null;
        $cont = self::elComponent($path);

        return $cont;
    }
    
    /**
     * Contents in render
     * 
     * @param string $path Route to obtain the information
     * 
     * @return string Content
     */ 
    protected static function elComponent($path)
    {
        ob_start();
        require_once $path;
        $cont = ob_get_contents();
        ob_end_clean();
        
        return $cont;    
    }
}
