<?php
/**
 * Default file
 * 
 * @author      José Roberto Alas <jrobertoalas@gmail.com>
 * @copyright   Copyright (C) 2018, Open Source LadySusy
 * @licence     http://www.ladysusy.org/licences/ladysusy-licence.php
 */

// Avoid direct access
defined('_LS') or die;

?>
<div>    
    <div>
        <div><?php echo LSText::_('INICIAR_SESION'); ?></div>
    </div>     
    <form id="loginForm" action="index.php" class="form-horizontal" method="post">
    <div>
        <?php echo LSText::_('USUARIO'); ?><input type="text" class="form-control" name="login" tabindex="1" value="" placeholder="email" />                                      
    </div> 
    <div>
        <?php echo LSText::_('PASSWORD'); ?><input id="login-password" type="password" class="form-control" name="password" tabindex="2" placeholder="password" />
    </div>
        <input name="task" type="hidden" value="login"/>
        <input name="commit" type="submit" class="btn btn-success" value="<?php echo LSText::_('LOG_IN'); ?>">
    </form>     
</div>
