<?php
/**
 * Model for the login component
 * 
 * @author      José Roberto Alas <jrobertoalas@gmail.com>
 * @copyright   Copyright (C) 2018, Open Source LadySusy
 * @licence     http://www.ladysusy.org/licences/ladysusy-licence.php
 */

// Avoid direct access
defined('_LS') or die;

/**
 * Class for the component model
 */ 
class LoginModelLogin extends LSModel
{
    /**
     * Method for user login
     *
     * @return void
     */
    public function login()
    {
        // Obtaining user data
        $login = LSReqenvironment::getVar('login', null, 'post');
        $password = LSReqenvironment::getVar('password', null, 'post');
    
        $priv = array();
        $priv['login'] = $login;
        $priv['password'] = $password;
        
        return $priv;
    }
}
