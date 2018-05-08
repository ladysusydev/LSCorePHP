<?php
/**
 * Hast fot safety
 * 
 * @author      José Roberto Alas <jrobertoalas@gmail.com>
 * @copyright   Copyright (C) 2018, Open Source LadySusy
 * @licence     http://www.ladysusy.org/licences/ladysusy-licence.php
 */

// Avoid direct access
defined('_LS') or die;

/**
 * class de hash
 */
class LSHash
{
    /**
     * @var string, algorit Blowfish
     */
    private static $_salt = '$2a$';

    /**
     * @var int cost value
     */
    private static $_cost = '10';

    /**
     * Generating character string
     *
     * @return string Text string to use with the hash
     */
    public static function uniqueSalt()
    {
        return substr(sha1(mt_rand()), 0, 22);
    }

    /**
     * Hash generator
     *
     * @param string Spassword The password provided
     *
     * @return string The hash
     */
    public static function hash($password)
    {
        return crypt($password, self::$_salt . self::$_cost . '$' . self::uniqueSalt());
    }

    /**
     * Password comparator with hash
     *
     * @param string $hash
     * @param string $password Password provided by the user
     *
     * @return string The hash value
     */
    public static function compPassword($hash, $password)
    {
        $fullSalt = substr($hash, 0, 29);
        $newHash = crypt($password, $fullSalt);

        return ($hash == $newHash);
    }
}
