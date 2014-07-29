<?php
header("Cache-Control: no-cache, must-revalidate");
 // Date in the past
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

include("config.php");

//get the q parameter from URL
$q=$_GET["q"];

$q = str_replace(','," ",$q); 

//open connnection
mysql_connect($conf['database_host'],$conf['database_login'],$conf['database_pass']);
mysql_select_db($conf['database_name']);

// Fill up array with names
$query = " SELECT *,MATCH(name) AGAINST('$q') AS score
		   FROM images 
		   WHERE MATCH(name) AGAINST('$q')
		   ORDER BY score DESC "; 
			
$image_results = mysql_query($query) or die(mysql_error());
$num = mysql_num_rows($image_results);

//lookup all hints from array if length of q>0
if (strlen($q) > 0)
{
  $result="";
  $count_results = 0;
  for($i=0; $i<$num; $i++)
  {
		//get the name of pic
		$name = strtolower(mysql_result($image_results, $i, "name"));;
		
		$pattern = "/\b".strtolower($q)."\b/";

	    if (preg_match($pattern, $name) )
		{
			$count_results++;
			//there is a match
			$file_path = mysql_result($image_results, $i, "filepath");
			$file_path = "uploaded_images/".$file_path;
			$result = $result.$count_results.'. <br/><img src="'.$file_path.'"><br/>';
	    }
  }
}

// Set output to "no suggestion" if no hint were found
// or to the correct values
$link = '<a href="upload.php">submit</a>';
if ($result == "")
{
	$response="There are no existing pictures of <b>".$q."</b><br/>Please help others and $link them if you got them!!";
}
else
{
	$link_to = '<a href="index.php?q='.$q.'">Link to this page</a><br/><br/>';
	$addem = "<br/><br/>Not the right pictures for $q? Got something better? $link them and help others!";
	$response= $link_to. $result . $addem;
}

//output the response
echo $response;
?>