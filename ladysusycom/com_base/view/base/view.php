<?php
/**
 * View for the base component
 * 
 * @author      José Roberto Alas <jrobertoalas@gmail.com>
 * @copyright   Copyright (C) 2018, Open Source LadySusy
 * @licence     http://www.ladysusy.org/licences/ladysusy-licence.php
 */

// Avoid direct access
define('_LS', 1);

/**
 * Class for the view of the base component
 */
class BaseViewBase extends LSView
{
    /**
     * Method to show the view
     * 
     * @return void
     */ 
    public function display($tpl = null)
    {
        parent::display($tpl);
    }
}
