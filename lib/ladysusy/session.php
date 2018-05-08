<?php
/**
 * Session
 * 
 * @author      José Roberto Alas <jrobertoalas@gmail.com>
 * @copyright   Copyright (C) 2018, Open Source LadySusy
 * @licence     http://www.ladysusy.org/licences/ladysusy-licence.php
 */

/**
 * Session class
 */
class LSSession
{
    /**
     * An instance to the same session
     *
     * @var LSSession
     */
    public static $instance = null;
    
    /**
     * Session state
     *
     * @var string
     */
    protected $state = 'active';
    
    /**
     * Maximum time in which the session expires
     *
     * @var string
     */
    protected $expires = 15;
    
    /**
     * Construct
     * 
     * @param array $options Options established for the session
     * 
     */
    public function __construct($options = array())
    {
        // Define session options
        session_name(md5($options['name']));
        ini_set('session.save_path', '/tmp');

        try {
            session_start();
            
        } catch (\Exception $e) {
             setcookie(session_name(md5($options['name'])), null, -1, '/');
        }
        
        if (!isset($_SESSION)) {
            throw new \Exception('Failed to start session');
        }

        // Initialize the session
        $this->setCont();
    }
    
      
    /**
     * Get the value of a serialized session variable
     *
     * @param string  $key The valu to obtain
     *
     * @return  mixta bool o string
     */
    public function getSessionUnserialize($key)
    {
        if (isset($_SESSION[$key])) {
            return unserialize($_SESSION[$key]);
        } else {
            return null;
        }
    }
       
    /**
     * Setting a session variable
     *
     * @param string Variable that would be defined
     * @param mixto Value of the variable that will be defined
     *
     * @return void
     */
    public function setSessionSerialize($key, $val)
    {
        $_SESSION[$key] = serialize($val);
    }
    
    /**
     * Returns an object of the LSSession class, if it does not exist
     *
     * @param array $options Options passed to the class
     *
     * @return LSSession The class object
     */
    public static function getInstance($options)
    {
        if (!is_object(self::$instance)) {
            self::$instance = new LSSession($options);
        }

        return self::$instance;
    }

    /**
     * Set the session counter
     *
     * @return boolean True in case of success
     */
    protected function setCont()
    {
        $cont = $this->get('counter', 0);
        ++$cont;
        $this->set('counter', $cont);

        return true;
    }
    
    /**
     * Allows me to define a session variable
     *
     * @param string $name Name of the variable to obtain
     * @param string $value Value to establish
     * @param string $prefix Prefix by default, to avoid collisions
     *
     * @return The previous variable if needed
     */
    public function set($name, $value = null, $prefix = 'chinqui')
    {
        $prefix = '__' . $prefix;
        $old = isset($_SESSION[$prefix][$name]) ? $_SESSION[$prefix][$name] : null;

        if (null === $value) {
            unset($_SESSION[$prefix][$name]);
        } else {
            $_SESSION[$prefix][$name] = $value;
        }

        return $old;
    }
    
    /**
     * It allows me to obtain a session variable
     *
     * @param string $name Name of the variable to obtain
     * @param string $default Return value if the name is not defined
     * @param string $prefix Prefix by default, to avoid collisions
     *
     * @return mixed value, returned
     */
    public function get($name, $default = null, $prefix = 'chinqui')
    {
        $prefix = '__' . $prefix;

        if (isset($_SESSION[$prefix][$name])) {
            return $_SESSION[$prefix][$name];
        }
        
        return $default;
    }
    
    /**
     * Get id session
     *
     * @return string The name session
     */
    public function getId()
    {
        return session_id();
    }
    
    /**
     * Check when the session was already created
     *
     * @return boolean True when it is successful
     */
    public function isNew()
    {
        $cont = $this->get('counter');
        if ($cont === 1) {
            return true;
        }
        
        return false;
    }
    
    /**
     * Function that allows me to destroy the session
     *
     * @return boolean True
     */
    public function destroySession()
    {
        unset($_COOKIE["id"]);
        setcookie('id', '', time() - 3600, '/' . LS_APP, '','', true);
        setcookie('id', '', time() - 3600, '/' . LS_APP . '/', '', '', true);
        
        session_unset();
        $this->regenerateId();
        @session_start();
        $_SESSION = array();
    }
    
    /**
     * Around de session_regenerate_id
     *
     * @param bool $deleteOldSession Elimina el archivo de session asociado
     * 
     * @return void
     */
    public function regenerateId($deleteOldSession = true) {
        @session_regenerate_id($deleteOldSession);
    }
}
