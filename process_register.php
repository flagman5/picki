<? include("config.php");
	
	$email = $_POST["email"];
	$password = $_POST["password"];
	$password2 = $_POST["password2"];
	
	//check email address
	if(empty($email)) {
		header("Location:register.php?error=1");
		exit();
	}
	//check email validity
	if(!preg_match("/^^([a-z0-9_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]+$$/i", $email)) {
		header("Location:register.php?error=1");
		exit();
	}
	
	//check if passwords match
	if($password != $password2) {
		header("Location:register.php?error=2");
		exit();
	}
	
	
	
	//open db connection
	mysql_connect($conf['database_host'],$conf['database_login'],$conf['database_pass']);
	mysql_select_db($conf['database_name']);
	
	//check if email exists
	$email = mysql_real_escape_string($email);
	$query = "SELECT email FROM users WHERE email='$email'";
	$result = mysql_query($query) or die(mysql_error());
	$num = mysql_num_rows($result);
	
	if($num == 0) {
		//email is not in database, create user
		$query = "INSERT INTO users VALUES(NULL,'".$email."','".$password."',NOW(), 0)";
		mysql_query($query) or die(mysql_error());
		
		$query = "SELECT id FROM users WHERE email='$email'";
		$result = mysql_query($query) or die(mysql_error());
		$user_id = mysql_result($result, 0, "id");
		
		//send email to user for confirm link
		$subject = "Welcome to $sitename!";
		$Message1 .= "Welcome to $sitename.\n";
		$Message1 .= "Your email addressed registered is $email\n";
		$Message1 .= "Your password is $password\n";
		$Message1 .= "Please confirm your registration by clicking here <a href=\"confirm.php?id=$user_id\">clicking here</a>\n";
		$Message1 .= "or paste this address into your browser http://www..com/confirm.php?id=$user_id\n";
		
		mail($email, $subject, $Message1);
		
		header("Location:register.php?success=1");
		exit();
	}
	else {
		//user exists
		header("Location:register.php?error=3");
		exit();
	}
?>