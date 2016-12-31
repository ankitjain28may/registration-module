<?php

namespace AnkitJain\RegistrationModule;
require (dirname(__DIR__) . '/vendor/autoload.php');
use AnkitJain\RegistrationModule\Login;
@session_start();

if(isset($_POST['q']))
{
	$loginField = json_decode($_POST['q']);
	$login = $loginField->login;
	$password = $loginField->password;
	$ob = new Login();
	$result = $ob->AuthLogin($login, $password);
	if(isset($result))
		echo $result;
	else
		echo json_encode([]);
}
?>
