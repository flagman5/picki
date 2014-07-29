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
<title>Picki Log In</title>
<script src="js/main.js"></script>
<link href="css/style.css" rel="Stylesheet" type="text/css" />
</head>

<body>
<center>
<img src="images/logo.png">
<h4>Please Sign in! Only registered users can start contributing images</h4>
<div id="login_box">

    <form method="POST" action="login.php">
	Email: <input type="text" name="email" size="15"><br/><br/>
	Password: <input type="password" name="password" size="15"><br/><br/>
	<input type="submit" name="Submit" value="Submit">
	<br/>
	<div id="forgot">
	<a href="forgot.php">Forgot Password?</a>
	</div>
	</form>
</div>

<div id="links">
<a href="index.php">Home</a> - <a href="register.php">Register</a> - <a href="upload.php">Upload a Pic</a> - <a href="about.php">About</a> - <a href="terms.php">Terms of Use</a>
</div>
</center>
</body>

</html>
<?}?>