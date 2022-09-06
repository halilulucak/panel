
<html>
<body>
 
<form action="" method="post" enctype="multipart/form-data">
  <input type="file" name="file" id="file">
  <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>
<?php
if(isset($_POST['submit'])) {
	
	$filename = $_FILES["file"]["name"];
	$file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
	$file_ext = substr($filename, strripos($filename, '.')); // get file name
	$filesize = $_FILES["file"]["size"];
	$allowed_file_types = array('.png','.jpg','.gif','.jpeg');	

	if (in_array($file_ext,$allowed_file_types) && ($filesize < 200000))
	{	
		// Rename file
		$newfilename = $file_basename ."-" .date("s"). $file_ext;
		if (file_exists("uploads/" . $newfilename))
		{
			// file already exists error
			echo "bu dosya zaten mevcut.";
		}
		else
		{		
			move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/" . $newfilename);
			echo "dosyanız yüklendi.";		
		}
	}
	elseif (empty($file_basename))
	{	
		// file selection error
		echo "lütfen yüklemek için dosya seçin";
	} 
	elseif ($filesize > 200000)
	{	
		// file size error
		echo "dosya boyutunuz çok büyük.";
	}
	else
	{
		// file type error
		echo "desteklenen dosyalar bunlardır: " . implode(', ',$allowed_file_types);
		unlink($_FILES["file"]["tmp_name"]);
	}

} 
?>