<?php
@session_start();
require_once '../source/class.register.php';
if(isset($_POST['q']))
{
	$registerField=json_decode($_POST['q']);
	$name=$registerField->name;
	$email=$registerField->email;
	$username=$registerField->username;
	$mob=$registerField->mob;
	$password=$registerField->password;
	$ob = new register();
	$result=$ob->_register($name,$email,$username,$password,$mob);
	if(isset($result))
		echo $result;
	else
		echo json_encode([]);
}
?>