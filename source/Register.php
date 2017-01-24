<?php
/**
 * Register Class Doc Comment
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
use AnkitJain\RegistrationModule\Validate;
use AnkitJain\RegistrationModule\Session;
require_once dirname(__DIR__) . '/config/database.php';

/**
 * For Register the New User
 *
 * @category PHP
 * @package  Registration-Module
 * @author   Ankit Jain <ankitjain28may77@gmail.com>
 * @license  The MIT License (MIT)
 * @link     https://github.com/ankitjain28may/registration-module
 */

class Register
{
    /*
    |--------------------------------------------------------------------------
    | Register Class
    |--------------------------------------------------------------------------
    |
    | For Register the New User.
    |
    */

    protected $error;
    protected $flag;
    protected $obValidate;
    protected $connect;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->error = array();
        $this->flag = 0;
        $this->connect = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $this->obValidate = new Validate();
    }

    /**
     * Credentials check for allowing new user to Register
     *
     * @param array $data Contains the User Credentials
     *
     * @return json
     */
    public function authRegister($data)
    {
        $data = $this->emptyValue($data);
        $name = $data["name"];
        $email = $data["email"];
        $username = $data["username"];
        $mob = $data["mob"];
        $password = $data["passRegister"];
        $userId = '';

        if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
            $this->onError("email", " *Enter correct Email address");
        } elseif ($this->obValidate->validateEmailInDb($email) === 1) {
            $this->onError("email", " *Email is already registered");
        }

        if ($this->obValidate->validateUsernameInDb($username) === 1) {
            $this->onError("username", " *Username is already registered");
        }

        if (!preg_match("/^[0-9]{10}$/", $data["mob"])) {
            $this->onError("mob", " *Enter correct Mobile Number");
        }

        if ($this->flag == 1) {
            return json_encode($this->error);
        }

        $password = md5($password);

        $query = "INSERT INTO register VALUES(
        	null, '$email', '$username', '$password'
        )";
        if (!$this->connect->query($query)) {
            return json_encode(
                [
                "Error" => "You are not registered, " . $this->connect->error
                ]
            );
        }
        $query = "SELECT id FROM register WHERE email = '$email'";
        if ($result = $this->connect->query($query)) {
            $row = $result->fetch_assoc();
            $userId = $row['id'];
            $query = "INSERT INTO login VALUES(
            	'$userId', '$name', '$email', '$username', '$mob'
            )";

            if (!$this->connect->query($query)) {
                return json_encode(
                    [
                    "Error" => "You are not registered, " . $this->connect->error
                    ]
                );
            }

            Session::put('start', $userId);
            return json_encode(
                [
                "location" => URL . "/account.php"
                ]
            );
        }
    }

    /**
     * For generating Error array by key value pair
     *
     * @param string $key   Contains key
     * @param string $value Contains the Value for the key
     *
     * @return void
     */
    public function onError($key, $value)
    {
        $this->flag = 1;
        $this->error = array_merge(
            $this->error,
            [
            [
            "key" => $key,
            "value" => $value
            ]
            ]
        );
    }

    /**
     * For checking whether the credentials are empty or not
     *
     * @param array $data Contains the Credentials
     *
     * @return array
     */
    public function emptyValue($data)
    {
        $errorCode = array(
            "name" => " *Enter the name",
            "email" => " *Enter the email address",
            "username" => " *Enter the username",
            "passRegister" => " *Enter the password",
            "mob" => " *Enter the Mobile Number"
        );

        foreach ($data as $key => $value) {
            $data[$key] = trim($data[$key]);
            $value = trim($value);
            if (empty($value)) {
                $this->onError($key, $errorCode[$key]);
            }
        }
        return $data;
    }
}
