<?php

namespace AnkitJain\RegistrationModule;
require (dirname(__DIR__) . '/registration-module/vendor/autoload.php');
use AnkitJain\RegistrationModule\Session;

if(Session::get('start') != null)
{
	Session::forget('start');
	header('Location: index.php');
}
else
{
	echo "Please Login";
}
?>
