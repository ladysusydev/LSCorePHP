<?php
/**
 * Error handling
 * 
 * @author      José Roberto Alas <jrobertoalas@gmail.com>
 * @copyright   Copyright (C) 2018, Open Source LadySusy
 * @licence     http://www.ladysusy.org/licences/ladysusy-licence.php
 */

// Avoid direct access
defined('_LS') or die;

/**
 * Class to generate system errors
 */
class LSError
{
    /**
     * The error message
     * 
     * @var string
     */
    protected $msnError = null;

    /**
     * An instance to the class
     * 
     * @var LSError
     */
    protected static $instance;
    
    /**
     * The output of the template error
     *
     * @var string
     */
    protected $output = null;

    /**
     * Returns an object of the LSError class, if it does not exist
     *
     * @return LSError The object of the class
     */
    public static function getInstance()
    {
        if (empty(self::$instance)) {
            $error = new LSError();
            self::$instance = $error;
        }
        
        return self::$instance;
    }
    
    /**
     * The error handler
     *
     * @param int $errno Error nivel
     * @param string $errstr Error message
     * @param string $errfile File in which the error occurred
     * @param int $errline Line in which the error occurred
     *
     * @return boolean true
     */
    function handlerError($errno, $errstr, $errfile, $errline)
    {
        //$fecha = ucfirst(strftime("%b %d %H:%M:%S"));
        $fecha = '';
        switch ($errno) {
            case E_USER_ERROR:
                error_log("$fecha  Error: $errstr Fatal error en la linea $errline, en el archivo $errfile \n", DEST_LOGFILE, LOG_FILE);
                break;
            case E_USER_WARNING:
                error_log("$fecha  Warning: $errstr en $errfile en la linea $errline \n", DEST_LOGFILE, LOG_FILE);
                break;
            case E_USER_NOTICE:
                error_log("$fecha  Notice: $errstr en $errfile en la linea $errline \n", DEST_LOGFILE, LOG_FILE);
                break;
            default:
                error_log("$fecha  Error desconocido: [#$errno] $errstr en $errfile en la linea $errline \n", DEST_LOGFILE, LOG_FILE);
                break;
        }

        return true;
    }
    
    /**
     * Function that allows us to record error messages
     *
     * @return void
     */
    public static function msgLog($errno, $error, $arch)
    {
        // Formando mensaje de log
        $errnoLog = LSText::_('ERROR_NUMERO').":". $errno."\r\n";
        $errorLog = LSText::_('ERROR').": " . $error. "\r\n";
        $archLog = LSText::_('ARCHIVO').": ".$arch. "\r\n";
        $mensLog = $errnoLog.$errorLog.$archLog;
        self::logLS($mensLog);
    }
    
     /**
      * Processed log
      *
      * @param array $message The message to save
      * @param string $nivel The error nivel
      *
      * @return void
      */
    protected static function logLS($message, $nivel = "ERROR")
    {
         $fileLog = LS_LOGS.date("Y-m-d").'.log';
         $arch = fopen($fileLog, "a+");
         fwrite($arch, $nivel.' : ['.date("Y/m/d H:i:s").'] - '.$message."\r\n");
         fclose($arch);
    }

    /**
     * Error messages
     * 
     * @property string $type Type of error
     * 
     * @return string
     */
     public static function propError($type, $typemessage) 
     {
         // Obteniendo mensaje del titulo
         $title = self::titleMessage($typemessage);
         
         switch ($type) {
             case 'EMERGENCY':
                $message = LSText::_('EMERGENCY').': '.$title ;
                break;
            case 'ALERT':
                $message = LSText::_('ALERT').': '.$title ;
                break;
            case 'CRITICAL': 
                $messgae = LSText::_('CRITICAL').': '.$title ;
                break;
            case 'ERROR':
                $message = LSText::_('ERROR').': '.$title ;
                break;
            case 'WARNING': 
                $message = LSText::_('WARNING').': '.$title ;
                break;
            case 'NOTICE':
                $message = LSText::_('NOTICE').': '.$title ;
                break;
            case 'INFO':
                $message = LSText::_('INFO').': '.$title ;
                break;
            case 'DEBUG': 
                $message = LSText::_('DEBUG').': '.$title ;
                break;
         }
         
         return $message;
     }
     
    /**
     * Title of the message
     * 
     * @property string $typemessage Message type
     * 
     * @return string
     */
     public static function titleMessage($typemessage) 
     {
         switch ($typemessage) {
             case 'SQLERROR':
                $title = 'Error al realizar la consulta SQL';
                break;
            case 'DBERROR':
                $title = 'Error al conectarse a la base de datos';
                break;
        }
      
         return $title;
     }
     
     /**
     * Error generator by exceptions
     * 
     * @param object $error Instance Exception
     *
     * @return string
     */
    public static function render($error)
    {
        $isException = $error instanceof Exception;
        
        if ($isException) {
            // Starting the capture in the buffer
            ob_start();
            echo '<div class="alert alert-error">';
            echo '<h4>'.strtoupper($error->getMessage()).'</h4>';
            echo '<p>Code: '.$error->getCode().'</p>';
            echo '<p>File: '.$error->getFile().'</p>';
            echo '<p>Line: '.$error->getLine().'</p>';
            echo '</div>';
            $message = ob_get_contents();
            ob_get_clean();
        }

        echo $message;
        exit();
    }
}
