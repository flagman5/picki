<? include("config.php");

	$user_id = $_GET["id"];
	
	//shouldnt be here like this..
	if(empty($user_id)) {
		header("Location:index.php");
		exit();
	}
	
	//open db connection
	mysql_connect($conf['database_host'],$conf['database_login'],$conf['database_pass']);
	mysql_select_db($conf['database_name']);
	
	$query = "UPDATE users SET confirm='1' WHERE id='$user_id'";
	mysql_query($query) or die(mysql_error());
	
	header("Location:profile.php?success=1");
	exit();
?>
	