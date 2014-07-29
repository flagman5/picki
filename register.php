<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
         "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Picki Registration</title>
<link href="css/style.css" rel="Stylesheet" type="text/css" />
</head>

<body>
<center>
<img src="images/logo.png">
<div id="register">
<h4>Register for an account to begin uploading pictures!</h4>
<? if(isset($_GET["success"])) {
		echo "Registration successful, please confirm your registration in your email to begin using the site!";
	}
	else {
		if(isset($_GET["error"])) {
			$error = $_GET["error"];
			if($error == 1) {
				echo "<div id=\"error\">Please check your email address</a></div><br/>";
			}
			if($error == 2) {
				echo "<div id=\"error\">Passwords do not match!</a></div><br/>";
			}
			if($error == 3) {
				echo "<div id=\"error\">Duplicate Email, try again!</a></div><br/>";
			}
		}
?>
<form method="POST" action="process_register.php"> 
Your Email address:<br/>
<input type="text" name="email" size="30">
<br/>
Your Password:<br/>
<input type="password" name="password" size="30">
<br/>
Your Password again:<br/>
<input type="password" name="password2" size="30">
<br/>
<input type="submit" name="Submit" value="Submit">
</form>
<?}?>
</div>
<div id="links">
<a href="index.php">Home</a> - <a href="register.php">Register</a> - <a href="upload.php">Upload a Pic</a> - <a href="about.php">About</a> - <a href="terms.php">Terms of Use</a>
</div>
</center>
</body>

</html>