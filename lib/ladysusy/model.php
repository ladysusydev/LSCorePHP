<?php
/**
 * Main model
 * 
 * @author      José Roberto Alas <jrobertoalas@gmail.com>
 * @copyright   Copyright (C) 2017, Open Source LadySusy
 * @licence     http://www.ladysusy.org/licences/ladysusy-licence.php
 */

// Avoid direct access
defined('_LS') or die;

/**
 * Class for the main model
 */
class LSModel
{
    /**
     * Connection to the database
     * 
     * @var LSDatabase
     */
    protected $_db;
    
    /**
     * $var array
     */
    protected $result;
    
    /**
     * Name model
     *
     * @var string
     */
    protected $name;
    
    /**
     * Construct
     */
    public function __construct()
    {
        // An instance to the database
        $this->_db = LSPrincipal::getDBO();
    }
    
    /**
     * Method to obtain an instance of the database
     *
     * @return  LSDb
     */
    public function getDbo()
    {
        return $this->_db;
    }
    
    /**
     * Executing SQL queries
     *
     * @param string $sql about the query
     *
     * @return object or string msg error
     */
    public function consult($sql = '')
    {
        if (empty($sql)) {
            return false;
        }
        if ($this->result = $this->_db->query($sql)) {
            return $this->result;
        } else {
            LSError::msgLog($this->_db->errno, $this->_db->error, $_SERVER['PHP_SELF']);
            die(LSText::_('ERROR_EJECUTAR_SQL'));
        }
    }
    
    /**
     * Get the name of the model of the component in the category
     *
     * @return string
     */
    public function getName()
    {
        if (empty($this->name)) {
            $result = null;
            if (!preg_match('/Model(.*)/i', get_class($this), $result)) {
                echo 'error';
            }
            $this->name = strtolower($result[1]);
        }

        return $this->name;
    }
}
