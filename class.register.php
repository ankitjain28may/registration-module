<?php
session_start();
require_once 'database.php';
class register
{
	private $name;
	private $email;
	private $username;
	private $password;
	private $mob;
	private $key;

	function __construct()
	{
		$this->key=0;
		$bd = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

		$query="CREATE TABLE IF NOT EXISTS login (
			login_id int primary key auto_increment unique not null,
			name varchar(255) not null,
			email varchar(255) unique not null,
			username varchar(255) unique not null,
			mobile varchar(11) not null,
			FOREIGN KEY (login_id) REFERENCES register(id)
			) ENGINE=INNODB;";
		
		if (!$result=$bd->query($query)) {
			echo "Table is not created || Query failed";
		}

		$query="CREATE TABLE IF NOT EXISTS register (
			id int primary key not null,
			email varchar(255) unique not null,
			username varchar(255) unique not null,
			password varchar not null
			) ENGINE=INNODB;";

		if (!$result=$bd->query($query)) {
			echo "Table is not created || Query failed";
		}
		
	}

	function _register($name,$email,$username,$password,$mob)
	{
		$bd = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

		$this->name=trim($name);
		$this->email=trim($email);
		$this->username=trim($username);
		$this->password=trim($password);
		$this->mob=trim($mob);
		if (empty($this->name)) {
			$this->key=1;
			$_SESSION['name']="Enter the name";
		}

		if(empty($this->email)) {
			$this->key=1;
			$_SESSION['email']="Enter the email address";
		}
		elseif(filter_var($this->email,FILTER_VALIDATE_EMAIL)== false) {
			$this->key=1;
			$_SESSION['email']="Enter correct Email address";
		}

		if(empty($this->username)) {
			$this->key=1;
			$_SESSION['username']="Enter the username";
		}

		if(empty($this->password)) {
			$this->key=1;
			$_SESSION['password']="Enter the password";
		}

		if(empty($this->mob)) {
			$this->key=1;
			$_SESSION['mob']="Enter the Mobile Number";
		}
		elseif (!ereg("^[0-9]{10}$",$this->mob)) {
			$this->key=1;
			$_SESSION['mob']="Enter correct Mobile Number";
		}

		if($this->key!=1)
		{
			$query="SELECT login_id FROM login WHERE email='$this->email'";
			if ($result=$bd->query($query)) {
				if ($result->num_rows>0) {
					$_SESSION['email']="Email is already registered";
					$this->key=1;
				}
			
			}
			$query="SELECT login_id FROM login WHERE username='$this->username'";
			if ($result=$bd->query($query)) {
				if ($result->num_rows>0) {
					$_SESSION['username']="Username is already registered";
					$this->key=1;
				}
			
			}

		}

		if($this->key==1)
		{
			return "ERROR";
		}
		else
		{
			$this->key=0;
			$query="INSERT INTO login VALUES(null,'$this->name','$this->email','$this->username','$this->mobile')";
			if (!$result=$bd->query($query)) {
				$this->key=1;
				echo "You are not registered || Error in registration";
			}

			$query="SELECT login_id FROM login WHERE email='$this->email'";
			if($result=$bd->query($query)) {
				$row=$result->fetch_assoc();
				$id=$row['login_id'];
			}
			else {
				$this->key=1;
				echo "Error in connecting with the database";
			}
			$pass=md5($this->password);
			$query="INSERT INTO register VALUES('$id','$this->email','$this->username','$pass')";
			if (!$result=$bd->query($query)) {
				$this->key=1;
				echo "You are not registered || Error in registration";
			}

		}
		if ($this->key==0) {
			$_SESSION['start']=0;
			header('Location: account.php');
		}
		else
		{
			return "ERROR";
		}
	}
}


?>