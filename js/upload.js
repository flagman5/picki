function startUpload(){
	  document.getElementById('f1_upload_process').style.visibility = 'visible';
      document.getElementById('f1_upload_form').style.visibility = 'hidden';
      return true;
}

function stopUpload(success){
      var result = '';
      if (success == 1){
         result = '<span class="msg">The file was uploaded successfully!<\/span><br/><br/>';
      }
      else {
         if (success == 2) {
			result = '<span class="emsg">File is too large!<\/span><br/><br/>';
		 }
		 if (success == 3) {
			result = '<span class="emsg">File is not an image type!<\/span><br/><br/>';
		 }
		 if (success == 4) {
			result = '<span class="emsg">No name was supplied for picture!<\/span><br/><br/>';
		 }
      }
      document.getElementById('f1_upload_process').style.visibility = 'hidden';
      document.getElementById('f1_upload_form').innerHTML = result + '<a href="upload.php">Upload another picture</a><br/><br/><a href="index.php">Go Back to Home</a>';
      document.getElementById('f1_upload_form').style.visibility = 'visible';      
      return true;   
}