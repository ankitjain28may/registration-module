<?php
@session_start();
require_once '../source/login.php';
if(isset($_POST['q']))
{
	$loginField=json_decode($_POST['q']);
	$login=$loginField->login;
	$password=$loginField->password;
	$ob = new login();
	$result=$ob->_login($login,$password);
	if(isset($result))
		echo $result;
	else
		echo json_encode([]);
}
?>
