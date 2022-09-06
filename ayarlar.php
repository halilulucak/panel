<?php ob_start(); session_start();
	
	
	
	include("header.php"); 
	$table="ayarlar";
	$sql = "SELECT * FROM ".$table." ";
	$result = $conn->query($sql);
	$width=90;
	$height=40;
	
?>
<script src="ckeditor/ckeditor.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Begin Page Content -->
<div class="container-fluid">
	<style>
		h1{text-transform:capitalize;}
	</style>
	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800" ><?php echo $table; ?></h1>
	
	
	<?php include("alert.php"); ?>
	
	<div class="card shadow mb-4">
		<div class="card-body">
		<?php if($result->num_rows == 0){ ?>
			<form class="user" action="" method="post" enctype="multipart/form-data">
				<div class="form-group row">
					<div class="col-sm-6 mb-3 mb-sm-0">
						<input type="text" class="form-control" id="exampleFirstName" name="firma_adi" placeholder="Firma Adı">
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="exampleLastName" name="slogan" placeholder="Slogan">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-6 mb-3 mb-sm-0">
						<input type="text" class="form-control" id="exampleFirstName" name="tel" placeholder="Tel 1">
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="exampleLastName" name="tel2" placeholder="Tel 2">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-6 mb-3 mb-sm-0">
						<input type="text" class="form-control" id="exampleFirstName" name="adres" placeholder="Adres">
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="exampleLastName" name="email" placeholder="Email">
					</div>
				</div>
				
				<div class="form-group row">
					<div class="col-sm-4 mb-3 mb-sm-0">
						<input type="text" class="form-control" id="exampleFirstName" name="facebook" placeholder="Facebook">
					</div>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="exampleLastName" name="twitter" placeholder="Twitter">
					</div>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="exampleLastName" name="instagram" placeholder="İnstagram">
					</div>
				</div>
				<h2>Hakkımızda</h2>
				<div class="form-group">
					<textarea name="hakkimizda" id="editor1" rows="10" cols="80" data-sample-short></textarea>
				</div>
				<hr>
				<h2>Misyon</h2>
				<div class="form-group">
					<textarea name="misyon" id="editor2" rows="10" cols="80" data-sample-short></textarea>
				</div>
				<hr>
				<h2>Vizyon</h2>
				<div class="form-group">
					<textarea name="vizyon" id="editor3" rows="10" cols="80" data-sample-short></textarea>
				</div>
                <script>
                    CKEDITOR.replace( 'editor1' ); 
					CKEDITOR.replace( 'editor2' );
					CKEDITOR.replace( 'editor3' );					
                </script>
				
				<button name="add" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-save"></i>
                    </span>
                    <span class="text">Kaydet</span>
                </button>
			</form>
			
		<?php }else{
			$resul = $conn->query("SELECT * FROM ".$table." ");
			
			
			if($resul->num_rows > 0) {
			while($item = $resul->fetch_assoc()) {
				echo $item['firma_adi']." firma bilgileri düzenleniyor";
				?>
				
				
			<form class="user" action="" method="post" enctype="multipart/form-data" >
				
				<div class="form-group row">
					<div class="col-sm-6 mb-3 mb-sm-0">
						<input type="text" class="form-control" id="exampleFirstName" name="firma_adi" value="<?php echo $item['firma_adi']; ?>" placeholder="Firma Adı">
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="exampleLastName" name="slogan" value="<?php echo $item['slogan']; ?>" placeholder="Slogan">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-6 mb-3 mb-sm-0">
						<input type="text" class="form-control" id="exampleFirstName" name="tel" value="<?php echo $item['tel']; ?>" placeholder="Tel 1">
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="exampleLastName" name="tel2" value="<?php echo $item['tel2']; ?>" placeholder="Tel 2">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-6 mb-3 mb-sm-0">
						<input type="text" class="form-control" id="exampleFirstName" name="adres" value="<?php echo $item['adres']; ?>" placeholder="Adres">
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="exampleLastName" name="email" value="<?php echo $item['email']; ?>" placeholder="Email">
					</div>
				</div>
				
				<div class="form-group row">
					<div class="col-sm-4 mb-3 mb-sm-0">
						<input type="text" class="form-control" id="exampleFirstName" name="facebook" value="<?php echo $item['facebook']; ?>" placeholder="Facebook">
					</div>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="exampleLastName" name="twitter" value="<?php echo $item['twitter']; ?>" placeholder="Twitter">
					</div>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="exampleLastName" name="instagram" value="<?php echo $item['instagram']; ?>" placeholder="İnstagram">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-4 mb-3 mb-sm-0">
						<input type="file" name="file" >
					</div>
				</div>
				<h2>Hakkımızda</h2>
				<div class="form-group">
					<textarea name="hakkimizda" id="editor1" rows="10" cols="80" data-sample-short><?php echo $item['hakkimizda']; ?></textarea>
				</div>
				<hr>
				<h2>Misyon</h2>
				<div class="form-group">
					<textarea name="misyon" id="editor2" rows="10" cols="80" data-sample-short><?php echo $item['misyon']; ?></textarea>
				</div>
				<hr>
				<h2>Vizyon</h2>
				<div class="form-group">
					<textarea name="vizyon" id="editor3" rows="10" cols="80" data-sample-short><?php echo $item['vizyon']; ?></textarea>
				</div>
                <script>
                    CKEDITOR.replace( 'editor1' ); 
					CKEDITOR.replace( 'editor2' );
					CKEDITOR.replace( 'editor3' );					
                </script>
				
				<input type="hidden" name="id" value="<?php echo $item['id']; ?>">
				<button name="update" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-save"></i>
                    </span>
                    <span class="text">Güncelle</span>
                </button>
				
			</form>
			
			<?
			}}
		} ?>
		</div>
	</div>
	<!-- DataTales Example -->
	

</div>
<!-- /.container-fluid -->

<?php 
	include("footer.php");
	//print_r($_POST);
	
	$id=$_POST["id"];
	$firma_adi=$_POST["firma_adi"];
	$slogan=$_POST["slogan"];
	$tel=$_POST["tel"];
	$tel2=$_POST["tel2"];
	$adres=$_POST["adres"];
	$email=$_POST["email"];
	$facebook=$_POST["facebook"];
	$twitter=$_POST["twitter"];
	$instagram=$_POST["instagram"];
	$hakkimizda=$_POST["hakkimizda"];
	$misyon=$_POST["misyon"];
	$vizyon=$_POST["vizyon"];
	$path="../uploads/";
	if(isset($_POST["add"])){
		if($firma_adi!="" && $slogan!="" && $tel!="")
		{
			$sql = "INSERT INTO ".$table." (firma_adi,slogan,tel,tel2,adres,email,facebook,twitter,instagram,hakkimizda,misyon,vizyon
			) VALUES ('$firma_adi','$slogan','$tel','$tel2','$adres','$email','$facebook','$twitter','$instagram','$hakkimizda','$misyon','$vizyon')";
			if ($conn->query($sql) === TRUE) 
			{
				$_SESSION['alert']="Ekleme işlemi başarılı";
				$_SESSION['type']="success";
				$_SESSION['icon']="save";
				header("Location:".$back_url);
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
	}
	
?>

					
<?php
	if(isset($_POST["update"])){
		date_default_timezone_set('Europe/Istanbul');
		$tarih=date("Y-m-d H:i:s");
		
		if($_FILES["file"]["size"]>0){
			
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
					echo "dosya başarışı bir şekilde yüklendi.";
					
					$sql = "UPDATE  ayarlar  SET 
					firma_adi='$firma_adi', 
					slogan='$slogan', 
					tel='$tel', 
					tel2='$tel2', 
					adres='$adres', 
					email='$email', 
					facebook='$facebook', 
					twitter='$twitter', 
					instagram='$instagram', 
					hakkimizda='$hakkimizda', 
					misyon='$misyon', 
					vizyon='$vizyon', 
					logo='$newfilename' WHERE id=$id";

					if ($conn->query($sql) === TRUE) {
						//resize_crop_image($width, $height, $path.$newfilename, $path.$newfilename);
							$_SESSION['alert']="Güncelleme işlemi başarılı";
							$_SESSION['type']="success";
							$_SESSION['icon']="edit";
							header("Location:".$back_url);
					} else {
					  echo "Error updating record: " . $conn->error;
					}
					//echo $sql; exit;
				}
			}
			elseif (empty($file_basename))
			{	
				// file selection error
				echo "lütfen bir dosya seçiniz.";
			} 
			elseif ($filesize > 5000000)
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
		}else{
			$sql = "UPDATE ".$table." SET firma_adi='$firma_adi', slogan='$slogan', tel='$tel', tel2='$tel2', adres='$adres', email='$email', facebook='$facebook', twitter='$twitter', instagram='$instagram', hakkimizda='$hakkimizda', misyon='$misyon', vizyon='$vizyon'  WHERE id=$id";

		if ($conn->query($sql) === TRUE) {
				$_SESSION['alert']="Güncelleme işlemi başarılı";
				$_SESSION['type']="success";
				$_SESSION['icon']="edit";
				header("Location:".$page_url);
		} else {
		  echo "Error updating record: " . $conn->error;
		}
			
		}
			
	
	/*
		$sql = "UPDATE ".$table." SET title='$title', url='$url', description='$description', tarih='$tarih' WHERE id=$id";

		if ($conn->query($sql) === TRUE) {
				$_SESSION['alert']="Güncelleme işlemi başarılı";
				$_SESSION['type']="success";
				$_SESSION['icon']="edit";
				header("Location:".$page_url);
		} else {
		  echo "Error updating record: " . $conn->error;
		}
		*/
				
		
		
	}
	
?>					

<script>
	$(".table").on('click', '.remove-btn', function () {
		var $data_url = $(this).data("url");
		Swal.fire({
			title: 'Emin Misiniz?',
			text: "Bu içeriğiniz Silinecek!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			cancelButtonText: 'Hayır!',
			confirmButtonText: 'Evet, Sil!'
			
			}).then((result) => {
			if (result.isConfirmed) {
				window.location.href = $data_url;
			}
		});
	});
</script>