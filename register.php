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
        <label id="nameLabel">Your Name</label><br><br>
        <input type="text" name="name" id="name" placeholder="Name"><br><br>
        <label id="emailLabel">Email</label><br><br>
        <input type="email" name="email" id="email" placeholder="Email id"><br><br>
        <label id="userLabel">Username</label><br><br>
        <input type="text" name="username" id="username" placeholder="Username"><br><br>
        <label id="mobLabel">Mobile No.</label><br><br>
        <input type="text" name="mob" id="mob" placeholder="99******00"><br><br>
        <label id="passLabelRegister">Password</label><br><br>
        <input type="password" name="passRegister" id="passRegister" placeholder="Password"><br><br><br>
        <button name="submit" value="Register" onclick="registerCheck()">Register</button>
    </body>
    <script type="text/javascript" src="js/register_validate.js"></script>
</html>
