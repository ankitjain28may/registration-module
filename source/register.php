<?php

namespace AnkitJain\RegistrationModule;
use AnkitJain\RegistrationModule\validate;
@session_start();
require_once (dirname(__DIR__) . '/config/database.php');

class Register
{
	protected $error;
	protected $name;
	protected $email;
	protected $username;
	protected $password;
	protected $mob;
	protected $key;
	protected $ob;
	protected $connect;

	function __construct()
	{
		$this->error = array();
		$this->key = 0;
		$this->connect = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		$this->ob = new Validate();

	}

	function AuthRegister($name, $email, $username, $password, $mob)
	{
		$this->name = trim($name);
		$this->email = trim($email);
		$this->username = trim($username);
		$this->password = trim($password);
		$this->mob = trim($mob);
		if (empty($this->name)) {
			$this->key = 1;
			$this->error = array_merge($this->error, ["name" => " *Enter the name"]);
		}

		if(empty($this->email)) {
			$this->key = 1;
			$this->error = array_merge($this->error, ["email" => " *Enter the email address"]);
		}
		elseif(filter_var($this->email, FILTER_VALIDATE_EMAIL) == false) {
			$this->key = 1;
			$this->error = array_merge($this->error, ["email" => " *Enter correct Email address"]);
		}
		else
		{
			if($this->ob->ValidateEmailInDb($this->email))
			{
				$this->key = 1;
				$this->error = array_merge($this->error, ["email" => " *Email is already registered"]);
			}
		}

		if(empty($this->username)) {
			$this->key = 1;
			$this->error = array_merge($this->error, ["username" => " *Enter the username"]);
		}
		else
		{
			if($this->ob->ValidateUsernameInDb($this->username))
			{
				$this->key = 1;
				$this->error = array_merge($this->error, ["username" => " *Username is already registered"]);
			}
		}

		if(empty($this->password)) {
			$this->key = 1;
			$this->error = array_merge($this->error, ["password" => " *Enter the password"]);
		}

		if(empty($this->mob)) {
			$this->key = 1;
			$this->error = array_merge($this->error, ["mob" => " *Enter the Mobile Number"]);
		}
		elseif (!preg_match("/^[0-9]{10}$/", $this->mob)) {
			$this->key = 1;
			$this->error = array_merge($this->error, ["mob" => " *Enter correct Mobile Number"]);
		}

		if($this->key == 1)
		{
			return json_encode($this->error);
		}
		else
		{
			$this->key = 0;
			$pass = md5($this->password);
			$query = "INSERT INTO register VALUES(null, '$this->email', '$this->username', '$pass')";
			if(!$this->connect->query($query)) {
				$this->key = 1;
				echo "You are not registered || Error in registration2";
			}
			else
			{
				$query = "SELECT id FROM register WHERE email = '$this->email'";
				if($result = $this->connect->query($query)) {
					$row = $result->fetch_assoc();
					$id = $row['id'];

					$query = "INSERT INTO login VALUES('$id', '$this->name', '$this->email', '$this->username', '$this->mob')";
					if(!$this->connect->query($query)) {
						$this->key = 1;
						echo "You are not registered || Error in registration1";
					}
				}
			}
		}
		if ($this->key == 0) {
			$_SESSION['start'] = $id;
			return json_encode([
				"location" => URL."/account.php"
			]);
		}
		else
		{
			return json_encode($this->error);
		}
	}
}
?>
