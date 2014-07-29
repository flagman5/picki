<? include("config.php");
	
	$email = $_POST["email"];
	$password = $_POST["password"];
	
	//check if it is working
	if(empty($email)) {
		header("Location:index.php?error=1");
		exit();
	}
	if(empty($password)) {
		header("Location:index.php?error=2");
		exit();
	}
	
	//open db connection
	mysql_connect($conf['database_host'],$conf['database_login'],$conf['database_pass']);
	mysql_select_db($conf['database_name']);
	
	//safe query
	$email = mysql_real_escape_string($email);
	$password = mysql_real_escape_string($password);
	
	$query = "SELECT * FROM users WHERE email='$email'";
	$result = mysql_query($query) or die(mysql_error());
	$num = mysql_num_rows($result);
	$db_password = mysql_result($result, 0, "password");
	
	if($num == 0) {
		//user does not exist
		header("Location:index.php?error=1");
		exit();
	}
	else {
		if($db_password != $password) {
			//wrong pw
			header("Location:index.php?error=2");
			exit();
		}
		else {
			//correct login
			$user_id = mysql_result($result, 0, "id");
			//set the cookie fo this user
			setcookie($cookiename, $user_id, time()+3600, "/", $webpath);
			setcookie("email", $email, time()+3600, "/", $webpath);
		}
	}
	
	header("Location:index.php");
	exit();
?>