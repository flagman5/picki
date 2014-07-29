<? include("config.php");
	
	//open connnection
	mysql_connect($conf['database_host'],$conf['database_login'],$conf['database_pass']);
	mysql_select_db($conf['database_name']);
	
	$query = "SELECT DISTINCT name FROM images ORDER BY date LIMIT 5";
	$latest_results = mysql_query($query) or die(mysql_error());
	
	for($i=0; $i<5; $i++) {
		$name = trim(mysql_result($latest_results, $i, "name"));
		echo "<div class=\"headline\"><b>Latest pictures uploaded: </b>";
		echo "<a href=\"index.php?q=$name\">$name</a><br/>";
		echo "</div>";
	}
?>
	
	