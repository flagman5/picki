<?php
   include("config.php");
   
   $name = $_POST["name"];
   $user_id = $_POST["user"];
   
   
   //make sure name is supplied
   if(empty($name)) {
		$result = 4;
	}
	else {
		// Edit upload location here
	   $destination_path = "uploaded_images/";
	
	   //check file type
	   $type =  strtolower($_FILES['myfile']['type']);
	   if($type == 'image/jpg' or $type == 'image/jpeg' or $type == 'image/jpe' or $type == 'image/gif' or $type == 'image/bmp' or $type == 'image/png' or $type == 'image/tiff' or $type == 'image/tif') 
	   {
			//check size
			if ($_FILES['myfile']['size'] < 500000)
			{
				//get a random number
				$random = mt_rand();
				$file_name = $random. '_' . $name ."_". $_FILES['myfile']['name'];
			   $target_path = $destination_path . $file_name;
				
			   if(@move_uploaded_file($_FILES['myfile']['tmp_name'], $target_path)) {
				  $result = 1;
			   }
			   
			   //do dbase stuff
			   //open db connection
				mysql_connect($conf['database_host'],$conf['database_login'],$conf['database_pass']);
				mysql_select_db($conf['database_name']);
				
				//insert into dbase
				$query = "INSERT INTO images VALUES(NULL,'".$file_name."','".$name."','".$user_id."', NOW())";
				$result = mysql_query($query) or die(mysql_error());
			   
			   sleep(1);
			   
			}
			else {
				//file too large
				$result = 2;
			}
		}
		else {
			//bad file type
			$result = 3;
		}
	}
?>

<script language="javascript" type="text/javascript">window.top.window.stopUpload(<?php echo $result; ?>);</script>   
