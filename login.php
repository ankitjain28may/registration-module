<?php
session_start();
if(isset($_SESSION['start']))
{
    header("Location: account.php");
}
?>
<!Doctype html>
<html>
	<head>
		<title>OpenChat</title>
		<script type="text/javascript" src="js/jquery-3.0.0.min.js"></script>
	</head>
	<body>

            <label id="loginLabel">Email or Username</label><br><br>
            <input type="text" name="login" id="login" placeholder="Email or Username" ><br><br>
            <label id="passLabelLogin">Password</label><br><br>
            <input type="password" name="passLogin" id="passLogin" placeholder="Password"><br><br><br>
            <button name="submit" onclick="loginCheck()" value="Login">Login</button>

    </body>
    <script type="text/javascript" src="js/login_validate.js"></script>
</html>