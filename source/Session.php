<?php
/**
 * Session Class Doc Comment
 *
 * PHP version 5
 *
 * @category PHP
 * @package  Registration-Module
 * @author   Ankit Jain <ankitjain28may77@gmail.com>
 * @license  The MIT License (MIT)
 * @link     https://github.com/ankitjain28may/registration-module
 */

namespace AnkitJain\RegistrationModule;
@session_start();

/**
 * For getting the Session values
 *
 * @category PHP
 * @package  Registration-Module
 * @author   Ankit Jain <ankitjain28may77@gmail.com>
 * @license  The MIT License (MIT)
 * @link     https://github.com/ankitjain28may/registration-module
 */

class Session
{
    /*
    |--------------------------------------------------------------------------
    | Session Class
    |--------------------------------------------------------------------------
    |
    | For Manipulation with Sessions.
    |
    */

    /**
     * For generating Session with the key
     *
     * @param string $key   Contains key
     * @param string $value Contains the Value for the key
     *
     * @return void
     */
    public static function put($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * For getting Session value
     *
     * @param string $key Contains key
     *
     * @return string | null
     */
    public static function get($key)
    {
        return (isset($_SESSION[$key]) ? $_SESSION[$key] : null);
    }

    /**
     * For unsetting Session key
     *
     * @param string $key Contains key
     *
     * @return void
     */
    public static function forget($key)
    {
        unset($_SESSION[$key]);
    }
}
