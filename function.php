<?php
	function resize_crop_image($max_width, $max_height, $source_file, $dst_dir, $quality = 80)
		{
		$imgsize = getimagesize($source_file);
		$width = $imgsize[0];
		$height = $imgsize[1];
		$mime = $imgsize['mime'];
	 
		switch($mime){
			case 'image/gif':
				$image_create = "imagecreatefromgif";
				$image = "imagegif";
				break;
	 
			case 'image/png':
				$image_create = "imagecreatefrompng";
				$image = "imagepng";
				$quality = 7;
				break;
	 
			case 'image/jpeg':
				$image_create = "imagecreatefromjpeg";
				$image = "imagejpeg";
				$quality = 80;
				break;
	 
			default:
				return false;
				break;
		}
		 
		$dst_img = imagecreatetruecolor($max_width, $max_height);
		$src_img = $image_create($source_file);
		 
		$width_new = $height * $max_width / $max_height;
		$height_new = $width * $max_height / $max_width;
		//if the new width is greater than the actual width of the image, then the height is too large and the rest cut off, or vice versa
		if($width_new > $width){
			//cut point by height
			$h_point = (($height - $height_new) / 2);
			//copy image
			imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
		}else{
			//cut point by width
			$w_point = (($width - $width_new) / 2);
			imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
		}
		 
		$image($dst_img, $dst_dir, $quality);
	 
		if($dst_img)imagedestroy($dst_img);
		if($src_img)imagedestroy($src_img);
	}
	/*
	function upload_image()
	{
		
				$filename = $_FILES["file"]["name"];
				$file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
				$file_ext = substr($filename, strripos($filename, '.')); // get file name
				$filesize = $_FILES["file"]["size"];
				$allowed_file_types = array('.png','.jpg','.gif','.jpeg');	
				
				if (in_array($file_ext,$allowed_file_types) && ($filesize < 5000000))
				{	
					// Rename file
					$newfilename = $file_basename."-".date("s"). $file_ext;
					if (file_exists($path . $newfilename))
					{
						// file already exists error
						echo "bu dosya zaten mevcut.";
					}
					else
					{		
						move_uploaded_file($_FILES["file"]["tmp_name"], $path . $newfilename);
						return true;
					
					}
				}
				elseif (empty($file_basename))
				{	
					// file selection error
					echo "lütfen bir dosya seçiniz.";
				} 
				elseif ($filesize > 50000000)
				{	
					// file size error
					echo "dosya boyutunuz çok büyük.";
				}
				else
				{
					// file type error
					echo "desteklenen dosya: " . implode(', ',$allowed_file_types);
					unlink($_FILES["file"]["tmp_name"]);
				}
			}
	*/

?>