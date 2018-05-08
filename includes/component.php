<?php
/**
 * Application component
 * 
 * @author      José Roberto Alas <jrobertoalas@gmail.com>
 * @copyright   Copyright (C) 2018, Open Source LadySusy
 * @licence     http://www.ladysusy.org/licences/ladysusy-licence.php
 */

// Avoid direct access
defined('_LS') or die;

/**
 * Class to obtain the component to be displayed
 */
class LSComponent
{
    /**
     * Return de application component
     *
     * @return string with the name of the component
     */
    public static function getComponent()
    {
        $contex = new stdClass();
 
        $contex->option = strtolower(LSReqenvironment::getVar('ladysusycom'));
        $contex->user = LSPrincipal::getUser();
        
        if (!$contex->user->isAuthenticated()) {
            $contex->option = 'com_login';
        }

        return $contex->option;
    }
}
