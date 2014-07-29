<?
	include("config.php");
	
	if (empty($_COOKIE[$cookiename])) {
	
		header("Location: index.php");
		exit();
	
	}
	
	else {
		$user_id = $_COOKIE[$cookiename];
		$user_email = $_COOKIE["email"];
		
		
		//open db connection
		mysql_connect($conf['database_host'],$conf['database_login'],$conf['database_pass']);
		mysql_select_db($conf['database_name']);
		
		//check if user is confirmed to begin uploading.
		$query = "SELECT confirm FROM users WHERE id='$user_id'";
		$confirm_result = mysql_query($query) or die(mysql_error());
		$confirmed = mysql_result($confirm_result, 0, "confirm");
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
         "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Picki Profile</title>
<script src="js/main.js"></script>
<link href="css/style.css" rel="Stylesheet" type="text/css" />
</head>

<body>
<!---welcome message-->
<div id="signin">
<b><?echo $user_email?></b> - <a href="profile.php">My Account</a> - <a href="logout.php">Log Off</a>
</div>
<!---welcome message -->
<center>
<img src="images/logo.png">
<h4>Your Profile Information</h4>
<? if(isset($_GET["success"])) {
		$success = $_GET["success"];
		if($success == 1) {
			echo "Your Account as been confirmed!<br/>";
		}
		if($success == 2) {
			echo "Your Account information has been updated!<br/>";
		}
		
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
	}
?>

<div id="login_box">
    <form method="POST" action="change_profile.php">
	Change Email: <input type="text" name="email" size="30"><br/><br/>
	Change Password: <input type="password" name="password" size="30"><br/><br/>
	Re-enter New Password: <input type="password" name="password2" size="30"><br/><br/>
	<input type="submit" name="Submit" value="Submit">
	<input type="hidden" name="user" value="<?echo $user_id?>">
	<br/>
<? if($confirmed == 0) {?>
	<div id="confirm">
	<a href="confirm.php?id=<?echo $user_id?>">Confirm your account</a>
	</div>
<?}?>
	</form>
</div>

<div id="user_content">
Your Uploaded Images:
<?
	$query = "SELECT * FROM images WHERE user='$user_id'";
	$result = mysql_query($query) or die(mysql_error());
	$num = mysql_num_rows($result);
	
	if($num == 0) { // no pics submitted
		echo "You have not submitted any pictures";
	}
	else {
		echo "<ol>";
		for($i=0;$i<$num;$i++) {
			$name = mysql_result($result, $i, "name");
			$filepath = mysql_result($result, $i, "filepath");
			
			echo "<li><a href=\"uploaded_images/$filepath\">".$name."</a>";
		}
		echo "</ol>";
	}
?>
</div>

<div id="links">
<a href="index.php">Home</a> - <a href="register.php">Register</a> - <a href="upload.php">Upload a Pic</a> - <a href="about.php">About</a> - <a href="terms.php">Terms of Use</a>
</div>
</center>
</body>

</html>


















