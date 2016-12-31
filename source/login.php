<?php
namespace AnkitJain\RegistrationModule;
@session_start();
require_once (dirname(__DIR__) . '/config/database.php');

class Login
{

	private $login;
	private $password;
	private $key;
	private $error;
	private $connect;

	function __construct()
	{
		$this->key = 0;
		$this->connect = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		$this->error = array();
	}

	function AuthLogin($login, $password)
	{

		$this->login = trim($login);
		$this->password = trim($password);

		if(empty($this->login))
		{
			$this->key = 1;
			$this->error = array_merge($this->error, ["login" => " *Enter the login field"]);
		}
		elseif (preg_match("/^[@]{1}$/", $this->login))
		{
			if(filter_var($this->email, FILTER_VALIDATE_EMAIL) == false)
			{
			$this->key = 1;
			$this->error = array_merge($this->error, ["login" => " *Enter correct Email address"]);
			}
		}
		if(empty($this->password)) {
			$this->key = 1;
			$this->error = array_merge($this->error, ["password" => " *Enter the password"]);
		}
		else
		{
			$pass = md5($this->password);
		}

		if($this->key == 0)
		{
			$query = "SELECT * FROM login WHERE email = '$this->login' or username = '$this->login'";
			if ($result = $this->connect->query($query))
			{
				if ($result->num_rows > 0)
				{
					$row = $result->fetch_assoc();
					$login_id = $row['login_id'];
					$query = "SELECT id FROM register WHERE id = '$login_id' and password = '$pass'";
					if($result = $this->connect->query($query))
					{
						if ($result->num_rows > 0)
						{
							$_SESSION['start'] = $login_id;
							return json_encode([
								"location" => URL."/account.php"
							]);
						}
						else
						{
							$this->error = array_merge($this->error, ["password" => " *Invalid password"]);
							return json_encode($this->error);
						}
					}
				}
				else
				{
					$this->error = array_merge($this->error, ["login" => " *Invalid username or email"]);
					return json_encode($this->error);
				}
			}

		}
		else
		{
			return json_encode($this->error);
		}
		$this->connect->close();
	}
}


?>
