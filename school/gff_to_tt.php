<?
	if(isset($_POST["submit"])) {
	
		//execute time
		$exectime = $_POST["exectime"];
	
		$uploaded = $_FILES['file']['tmp_name'];
		$filename = "target.gff";
		$uproot = 'uploads/';
		$path = $uproot.$filename;
		move_uploaded_file($uploaded, $path);
		
		$parse = file_get_contents($path);
		
		//first get props
		
		$array = explode("</alphabet>", $parse);
		
		$temp_array = explode("</prop>", $array[0]);
		for($i=0;$i<count($temp_array)-1;$i++) {
			$props =  explode("<prop>", $temp_array[$i]);
			$props_array[$i] = $props[1];
		}
		
		//now u want to get the matlab code
		$temp_array = explode("</read>", $array[1]);
		for($i=0;$i<count($temp_array)-1;$i++) {
			$transitions =  explode("<read>", $temp_array[$i]);
			$transition_array[$i] = $transitions[1];
		}
		
		for($i=0;$i<count($transition_array);$i++) {
			$tasks = explode(" ", $transition_array[$i]);
			$seg = $i+1;
			echo "case ".$seg.",<br>";
			$not_idle = 0; //reset
			for($j=0;$j<count($tasks);$j++) {
				
				if($tasks[$j] == $props_array[$j]) {
					echo "ttCreateJob('".$tasks[$j]."'); exectime = $exectime;";
					$not_idle = 1;
				}
					
			}
			if($not_idle == 0) {
					echo "exectime = -1;";
			}
			echo "<br/><br/>";
		}
	}
	else {
		

	
?>

<form method="POST" enctype="multipart/form-data" action="<? echo $_SERVER["PHP_SELF"]?>">
Input execute time: <input type="text" name="exectime"><br/>
GFF File upload: <input type="file" name="file"><br>
<br>
<input type="submit" name="submit" value="Press"> to change to matlab scheduling!
</form>

<?}?>
