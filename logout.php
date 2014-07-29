<?
	include("config.php");
	
if (empty($_COOKIE[$cookiename])) { // a guest

	header("Location: login.php");
}
else { 
		$user_id = $_COOKIE[$cookiename];
 }

setcookie($cookiename, $user_id, time()-3600, "/", $webpath);setcookie("email", 0, time()-3600, "/", $webpath);
$extra = "login.php";
header("Location: index.php");

?>