<?php
/**
 * Content responses of the components
 * 
 * @author      José Roberto Alas <jrobertoalas@gmail.com>
 * @copyright   Copyright (C) 2018, Open Source LadySusy
 * @licence     http://www.ladysusy.org/licences/ladysusy-licence.php
 */

// Avoid direct access
defined('_LS') or die;

/**
 * Class of answers
 */
class LSAnswer
{
    /**
     * @var array Body
     */
    protected static $_body = array();

    /**
     * Define the body of the content
     *
     * @param string $content The content to be defined in the body
     *
     * @return void
     */
    public static function setBody($content)
    {
        self::$_body = array((string) $content);
    }

    /**
     * Returns the content of the body
     *
     * @return string array
     */
    public static function getBody()
    {
        ob_start();
        foreach (self::$_body as $content) {
            echo $content;
        }

        return ob_get_clean();
    }

    /**
     * Get the data to show
     *
     * @return  string
     */
    public static function toString()
    {
        $data = self::getBody();

        return $data;
    }
}
