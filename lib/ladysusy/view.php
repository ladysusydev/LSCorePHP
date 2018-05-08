<?php
/**
 * Main view
 * 
 * @author      José Roberto Alas <jrobertoalas@gmail.com>
 * @copyright   Copyright (C) 2018, Open Source LadySusy
 * @licence     http://www.ladysusy.org/licences/ladysusy-licence.php
 */

// Avoid direct access
defined('_LS') or die;

/**
 * This class allows me to manage the set and get objects among other things
 */
class LSView
{
    /**
     * An arrangement of models
     * 
     * @var array
     */ 
    protected $_models = array();
    
    /**
     * The default model
     * 
     * @var array
     */ 
    protected $_defaultModel = null;
    
    
    public function __construct()
    {
    }
    
    /**
     * It allows me to load the template in the view
     * 
     * @param string $tpl Template name to load
     * 
     * @return string With the content of the template
     */ 
    public function display($tpl = null)
    {
        $result_com = $this->loadTemplate($tpl);

        if ($result_com instanceof Exception) {
            return $result_com;
        }
        echo $result_com;
    }
    
    /**
     * Load the template in the requested view
     * 
     * @param string $tpl Name of file to load
     * 
     * @return Template content
     */ 
    public function loadTemplate($tpl = null)
    {
        // Getting the action to run in the view.
        $process = LSReqenvironment::getVar('process');
        
        // Creating the name of the template file to load    
        $arch = isset($tpl) ? $tpl : 'default';
        
        // Defining the base route of the view to be displayed
        $this->routeView = LS_COMPONENTE . '/view/' . $process.'/'.$arch.'.php';

            ob_start();
            require_once $this->routeView;
            $cont = ob_get_contents();
            ob_end_clean();
            
        return $cont;
    }
    
    /**
     * Setting the model to use in the view, for a certain category
     * 
     * @param array $model An instance by model reference
     * @param boolean $default A default model
     * 
     * @return objeto del model
     */ 
    public function setModel(&$model, $default = false)
    {
        $name = strtolower($model->getName());
    
        $this->_models[$name] = &$model;

        if ($default) {
            $this->_defaultModel = $name;
        }

        return $model;
    }

    /**
     * Get model
     * 
     * @param string $name Name of the model
     * 
     * @return array
     */ 
    public function getModel($name = null)
        {
            if ($name === null) {
                $name = $this->_defaultModel;
            }
        
            return $this->_models[strtolower($name)];
        }
        
    
    public function get($property, $default = null)
    {
        if (is_null($default)) {
            $model = $this->_defaultModel;
        } else {
            $model = strtolower($default);                 
        }
    
        // Verifying first that the model exists
        if (isset($this->_models[$model])) {
            // If the model exists, we obtain the method
            $method = 'get' . ucfirst($property);
            
            if (method_exists($this->_models[$model], $method)) {
                // Obtenemos el resultado
                $result = $this->_models[$model]->$method();
            }
        }

        return $result;
    }
}
