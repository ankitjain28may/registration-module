<?php
/**
 * Validate Class Doc Comment
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
require_once dirname(__DIR__) . '/config/database.php';

/**
 * For validation the Email and Username in DB.
 *
 * @category PHP
 * @package  Registration-Module
 * @author   Ankit Jain <ankitjain28may77@gmail.com>
 * @license  The MIT License (MIT)
 * @link     https://github.com/ankitjain28may/registration-module
 */
class Validate
{
    /*
    |--------------------------------------------------------------------------
    | Validate Class
    |--------------------------------------------------------------------------
    |
    | For validation the Email and Username in DB.
    |
    */

    protected $connect;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->connect = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    }

    /**
     * For checking whether the credentials are empty or not
     *
     * @param string $email Contains the email for checking
     *
     * @return 0 | 1
     */
    public function validateEmailInDb($email)
    {
        $query = "SELECT login_id FROM login WHERE email = '$email'";
        if ($result = $this->connect->query($query)) {
            if ($result->num_rows > 0) {
                return 1;
            }
            return 0;
        }
    }

    /**
     * For checking whether the credentials are empty or not
     *
     * @param string $username Contains the username for checking
     *
     * @return 0 | 1
     */
    public function validateUsernameInDb($username)
    {
        $query = "SELECT login_id FROM login WHERE username = '$username'";
        if ($result = $this->connect->query($query)) {
            if ($result->num_rows > 0) {
                return 1;
            }
            return 0;
        }
    }
}
