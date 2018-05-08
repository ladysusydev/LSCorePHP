<?php
/**
 * Component controller
 * 
 * @author      José Roberto Alas <jrobertoalas@gmail.com>
 * @copyright   Copyright (C) 2018, Open Source LadySusy
 * @licence     http://www.ladysusy.org/licences/ladysusy-licence.php
 */

// Avoid direct access
defined('_LS') or die;

/**
 * Component controller class
 */
class BaseController extends LSController
{
    /**
     * Method that calls the view of the main controller
     * 
     * @return view of the component
     */ 
    public function display()
    {
        return parent::display();
    }
}
