<?php
/**
 * Text handling
 * 
 * @author      José Roberto Alas <jrobertoalas@gmail.com>
 * @copyright   Copyright (C) 2018, Open Source LadySusy
 * @licence     http://www.ladysusy.org/licences/ladysusy-licence.php
 */
 
// Avoid direct access
defined('_LS') or die;

/**
 * Class for text handling
 */
class LSText
{
    /**
     * Move a string in its corresponding language
     * 
     * @param string $str The message to be transferred
     * 
     * @return string
     */
    public static function _($str)
    {
        $language = LSPrincipal::getLanguage();
        $file = LS_LENGUAJE . SD . $language  . SD . $language  . '.template.ini';
        $string = parse_ini_file($file);
        $text = $string[$str];
        
        return $text;
    }
}
