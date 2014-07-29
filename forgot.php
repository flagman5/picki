<?
	include("config.php");
	
	if (!empty($_COOKIE[$cookiename])) {
	
		header("Location: index.php");
		exit();
	
	}
	
	else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
         "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Picki Send Password</title>
<script src="js/main.js"></script>
<link href="css/style.css" rel="Stylesheet" type="text/css" />
</head>

<body>
<center>
<img src="images/logo.png">
<h4>Enter your email to retreive your password</h4>
<?php
		if(isset($_GET['error']))
		{
			$error = $_GET['error'];
			if($error == 1) {
				echo "<div id=\"error\">Please check your email and try again</div>";
			}
			if($error == 2) {
				echo "<div id=\"error\">There is no account registered with the email you provided, please try again</div>";
			}
	    }
		else if(isset($_GET['success']))
		{	
			echo "<div id=\"success\">Password has been sent! Please check your email momentarily.</div>";
		}
		
?>
<div id="login_box">

    <form method="POST" action="send_reminder.php">
	Email: <input type="text" name="email" size="30"><br/><br/>
	<input class="submit" type="submit" accesskey="s" value="Send" name="submit"/>
    <input class="submit" type="reset" accesskey="s" value="Reset" /><br/>
	   
	</form>
</div>

<div id="links">
<a href="index.php">Home</a> - <a href="register.php">Register</a> - <a href="upload.php">Upload a Pic</a> - <a href="about.php">About</a> - <a href="terms.php">Terms of Use</a>
</div>
</center>
</body>

</html>
<?}?>