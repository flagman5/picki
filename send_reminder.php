<? include("config.php");

	$email = $_POST["email"];
	
	//shouldnt be here without email
	if(empty($email)) {
		header("Location: forgot.php?error=1");
		exit();
	}
	
	//connect to dbase
	mysql_connect($conf['database_host'],$conf['database_login'],$conf['database_pass']);
	mysql_select_db($conf['database_name']);
	
	//safe query
	$email = mysql_real_escape_string($email);
	
	$query = "SELECT password FROM users WHERE email='$email'";
	$result = mysql_query($query) or die(mysql_error());
	$num = mysql_num_rows($result);
	
	if($num == 0) {
		//no such user
		header("Location:forgot.php?error=2");
		exit();
	}
	else {
		//send the email
		//get pw
		$pw = mysql_result($result, 0, "password");
		send_reminder($pw, $email, $sitename);
		header("Location: forgot.php?success=1");
		exit();
	}
	
	header("Location:forgot.php");
	exit();

function send_reminder($pw, $email, $sitename) {
	
	$subject = "Your password to $sitename!";

	$Message1 .= "You have requested your password to be sent to you.\n\n";
	$Message1 .= "Your password is $pw\n\n";
	$Message1 .= "Please login to the website at http://www..com";
	
	mail($email, $subject, $Message1);
}