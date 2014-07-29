<?
	include("config.php");
	
	if (empty($_COOKIE[$cookiename])) {
	
		header("Location: prompt.php");
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
<title>Picki Upload</title>
<script src="js/upload.js"></script>
<link href="css/upload.css" rel="Stylesheet" type="text/css" />
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
<? if($confirmed == 0) {
		echo "<span class=\"emsg\">Your Account is not confirmed! Please check your email or go to your <a href=\"profile.php\">profile</a> to confirm!</span>";
	}
	else {
?>
<div id="container">
          
            <div id="content">
                <form action="process_upload.php" method="post" enctype="multipart/form-data" target="upload_target" onsubmit="startUpload();" >
                     <p id="f1_upload_process">Loading...<br/><img src="images/loader.gif" /><br/></p>
                     <p id="f1_upload_form" align="center"><br/>
                         <label>
								Name of Picture:
								 <input type="text" name="name" size="30" />
						</label>
						<br/><br/>
						 <label>File:  
                              <input name="myfile" type="file" size="30" />
                         </label>
                         <label>
                             <input type="submit" name="submitBtn" class="sbtn" value="Upload" /> 
                         </label>
						 <br/>
						 <b>By uploading this image you agree with terms of use </b>
                     </p>
                     <input type="hidden" name="user" value="<?echo $user_id?>">
                     <iframe id="upload_target" name="upload_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
                 </form>
             </div>
             <div id="footer"><br/><a href="http://www.ajaxf1.com" target="_blank">Powered by AJAX F1</a></div>
         </div>
<?}?>
<div id="links">
<a href="index.php">Home</a> - <a href="register.php">Register</a> - <a href="upload.php">Upload a Pic</a> - <a href="about.php">About</a> - <a href="terms.php">Terms of Use</a>
</div>
</center>
</body>

</html>