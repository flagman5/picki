<? include("config.php");

   $email = $_POST["email"];
   $password = $_POST["password"];
   $password2 = $_POST["password2"];
   $user_id = $_POST["user"];
   
   //dont change anything cuz bad data supplied
   if(empty($email) and (empty($password) or empty($password2))) {
		header("Location:profile.php");
		exit();
	}

	//check email validity
	if(!preg_match("/^^([a-z0-9_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]+$$/i", $email)) {
		header("Location:profile.php?error=1");
		exit();
	}
	
	//check if passwords match
	if($password != $password2) {
		header("Location:profile.php?error=2");
		exit();
	}
	
	// start updating
	
	//connect to db
	mysql_connect($conf['database_host'],$conf['database_login'],$conf['database_pass']);
	mysql_select_db($conf['database_name']);
	
	//safe query
	$user_id = mysql_real_escape_string($user_id);
	
	if(empty($email)) { //password change only
		$query = "UPDATE users SET password='$password' WHERE id='$user_id'";
		mysql_query($query) or die(mysql_error());
	}
	else if(empty($password) or empty($password2)) { //email change only
		$query = "UPDATE users SET email='$email' WHERE id='$user_id'";
		mysql_query($query) or die(mysql_error());
		setcookie("email", $email, time()+3600, "/", $webpath);
	}
	else { //email and pw change
		$query = "UPDATE users SET password='$password',email='$email' WHERE id='$user_id'";
		mysql_query($query) or die(mysql_error());
		setcookie("email", $email, time()+3600, "/", $webpath);
	}
	
	header("Location:profile.php?success=2");
	exit();
?>