<?php 
ob_start(); 
session_start();
include("baglan.php");

$table="kullanicilar";
$sql = "SELECT * FROM ".$table." ";
$result = $conn->query($sql);
include("header.php"); 

$width=1040;
$height=761;

?>
<script src="ckeditor/ckeditor.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>
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
		<?php if($_GET['table']==""){ ?>
			<form class="user" action="" method="post" enctype="multipart/form-data" >
				<div class="form-group row">
					<div class="col-sm-4 mb-3 mb-sm-0">
						<input type="text" class="form-control" id="exampleFirstName" name="username" placeholder="KullanıcıAdı">
					</div>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="exampleLastName" name="email" placeholder="Email">
					</div>
					<div class="col-sm-2">
						<input type="password" class="form-control" id="exampleLastName" name="password" placeholder="Şifre">
					</div>
					<div class="col-sm-2">
						<input type="password" class="form-control" id="exampleLastName" name="re_password" placeholder="Şifre Tekrar">
					</div>
				</div>
				
				<button name="add" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-save"></i>
                    </span>
                    <span class="text">Ekle</span>
                </button>
			</form>
		<?php }else{
			$id=$_GET["id"];
			$table=$_GET["table"];
			echo $_GET["table"]." tablosundaki ". $id." idli veri düzenleniyor";
			$resul = $conn->query("SELECT * FROM ".$table." where id =$id");
			if($resul->num_rows > 0) {
			while($item = $resul->fetch_assoc()) {
				?>
				
				
			<form class="user" action="" method="post" enctype="multipart/form-data" >
				<div class="form-group row">
					<div class="col-sm-4 mb-3 mb-sm-0">
						<input type="text" class="form-control" id="exampleFirstName" value="<?php echo $item["username"]; ?>" name="username" placeholder="Kullanıcı Adı">
					</div>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="exampleLastName" value="<?php echo $item["email"]; ?>" name="email"  placeholder=" Email">
					</div>
					<div class="col-sm-4">
						<input type="password" class="form-control" id="exampleLastName" value="<?php echo $item["password"]; ?>" name="url"  placeholder=" Şifre">
					</div>
				</div>
				
				<button  name="update" class="btn btn-primary btn-icon-split">
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
	
	<!-- Page Heading -->

	<div class="card shadow mb-4">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>İd</th>
							<th>UserName</th>
							<th>Email</th>
							<th>Sha1-Şifre</th>
							<th style="width:150px;">Kayıt Tarihi</th>
							<th style="width:200px;">İşlem</th>
						</tr>
					</thead>
					<tbody>
					
					<?php 
					
					
					
					
					if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {?>

						<tr>
							<td><?php echo $row["id"];?></td>
							<td><?php echo $row["username"];?></td>
							<td><?php echo $row["email"];?></td>
							<td><?php echo $row["password"];?></td>
							<td><?php echo $row["createdAt"];?></td>
							<td>
								<?php include("butonlar.php"); ?>					
							</td>
						</tr>
						
						<?php }} ?>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>
<!-- /.container-fluid -->

<?php 
	include("footer.php");
	
	$username=$_POST["username"];
	$email=$_POST["email"];
	$pass=sha1($_POST["password"]);
	if($_POST["password"]==$_POST["re_password"]){
		if(isset($_POST["add"])){
			if($username!="" && $email!="" && $pass!="")
			{
				
			$sql = "INSERT INTO ".$table." (username, email, password) VALUES ('$username', '$email', '$pass')";
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
	}else{
		$_SESSION['alert']="Şifreler Uyuşmuyor";
				$_SESSION['type']="danger";
				$_SESSION['icon']="key";
				header("Location:".$back_url);
		
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
					resize_crop_image($width, $height, $path.$newfilename, $path.$newfilename);
					$sql = "UPDATE ".$table." SET title='$title', url='$url', description='$description',img_url='$newfilename', tarih='$tarih' WHERE id=$id";

					if ($conn->query($sql) === TRUE) {
							$_SESSION['alert']="Güncelleme işlemi başarılı";
							$_SESSION['type']="success";
							$_SESSION['icon']="edit";
							header("Location:".$back_url);
					} else {
					  echo "Error updating record: " . $conn->error;
					}
					
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
			$sql = "UPDATE ".$table." SET title='$title', url='$url', description='$description', tarih='$tarih' WHERE id=$id";

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