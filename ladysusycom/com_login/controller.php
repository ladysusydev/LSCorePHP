<?php
/**
 * LSCorePHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2018, LadySusy
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package		LSCorePHP
 * @author		LadySusy Dev
 * @copyright	Copyright (c) 2008, LadySusy (http://www.ladysusy.org/)
 * @license		http://opensource.org/licenses/MIT	MIT License
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
