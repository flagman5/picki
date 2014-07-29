<?php
/*
	This is the back-end PHP file for the AJAX Suggest Tutorial
	
	You may use this code in your own projects as long as this 
	copyright is left	in place.  All code is provided AS-IS.
	This code is distributed in the hope that it will be useful,
 	but WITHOUT ANY WARRANTY; without even the implied warranty of
 	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
	
	For the rest of the code visit http://www.DynamicAJAX.com
	
	Copyright 2006 Ryan Smith / 345 Technical / 345 Group.	
*/

//Send some headers to keep the user's browser from caching the response.
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" ); 
header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" ); 
header("Cache-Control: no-cache, must-revalidate" ); 
header("Pragma: no-cache" );
header("Content-Type: text/xml; charset=utf-8");

//connect to db
include("config.php");
//open connnection
mysql_connect($conf['database_host'],$conf['database_login'],$conf['database_pass']);
mysql_select_db($conf['database_name']);

///Make sure that a value was sent.
if (isset($_GET['search']) && $_GET['search'] != '') {
	//Add slashes to any quotes to avoid SQL problems.
	$search = addslashes($_GET['search']);
	//Get every page title for the site.
	$suggest_query = mysql_query("SELECT distinct(name) as suggest FROM images WHERE name like('" . 
		$search . "%') ORDER BY name");
	while($suggest = mysql_fetch_array($suggest_query, MYSQL_ASSOC)) {
		//Return each page title seperated by a newline.
		echo $suggest['suggest'] . "\n";
	}
}
?>