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

$session = LSPrincipal::getSession();

?>
<h3><?php echo LSText::_('CONTENIDO'); ?>.... =:>-)-</h3>
<?php
if ($session->get('id')) {
    ?>
    <h3><a href="index.php?ladysusycom=com_login&task=logout"><?php echo LSText::_('SALIR'); ?></a></h3>
<?php
}
