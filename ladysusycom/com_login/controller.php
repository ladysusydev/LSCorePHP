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
class LoginController extends LSController
{
    /**
     * Method for user login
     *
     * @return void
     */
    public function login()
    {
        $app = LSPrincipal::getApplication();
        $model = $this->getModel('login');
        $credentials = $model->login();
        
        $authUser= $app->login($credentials);
        
        if (!($authUser instanceof Exception)) {
            $app->__r('index.php');
        }

        parent::display();
    }
    
    /**
     * It allows to define the view, when the user does not
     * has been authenticated
     * 
     * @return controller view
     */
    public function display()
    {
        LSReqenvironment::setVar('task', 'login');
        parent::display();
    }
    
    /**
     * The user leaves the session started
     * 
     * @return void
     */ 
     public function logout()
     {
         $app = LSPrincipal::getApplication();
         $authUser = $app->logout();
        
         if (!($authUser instanceof Exception)) {
            $app->__r('index.php');
         }
         
        parent::display();
     }
}
