<?
	include("config.php");
	
	if (isset($_COOKIE[$cookiename])) {
		$signed = 1;
		$user_email = $_COOKIE["email"];
	}
	$q = $_GET["q"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
         "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Picki</title>
<script src="js/main.js"></script>
<link href="css/style.css" rel="Stylesheet" type="text/css" />
</head>

<body onLoad="showPics('<?echo $q?>')">
<?if($signed) {?>
<!---welcome message-->
<div id="signin">
<b><?echo $user_email?></b> - <a href="profile.php">My Account</a> - <a href="logout.php">Log Off</a>
</div>
<!---welcome message -->
<?}
else {?>
<!---sign in box -->
<div id="signin_link">
<a href="#" onclick="sign();">Sign in</a>
<?if(isset($_GET["error"])) {
	echo "<div id=\"signin_box\">";
	
	$error = $_GET["error"];
	if($error == 1) {
		echo "<div id=\"error\">Email does not exist in database!</a></div><br/>";
	}
	if($error == 2) {
		echo "<div id=\"error\">Wrong Password!</a></div><br/>";
	}
}
else {
	echo "<div id=\"signin_box\" style=\"display: none;\">";
?>
<form method="POST" action="login.php">
Email: <input type="text" name="email" size="15"><br/>
Password: <input type="password" name="password" size="15"><br/>
<input type="submit" name="Submit" value="Submit"><br/>
<div id="forgot">
<a href="forgot.php">Forgot Password?</a>
</div>
</form>
</div>
</div>
<!---sign in box --><?} 
}?>
<center>
<img src="images/logo.png">

<form> 
Search:
<input type="text" id="txt1" onkeyup="showPics(this.value)" size="50" onkeypress="return event.keyCode!=13">
</form>

<p><span id="results"></span></p> 

<div id="links">
<a href="register.php">Register</a> - <a href="upload.php">Upload a Pic</a> - <a href="about.php">About</a> - <a href="terms.php">Terms of Use</a>
</div>
</center>
</body>

</html>