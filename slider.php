<?php ob_start(); session_start();
include("baglan.php");

$table="slider";

$sql = "SELECT * FROM ".$table." ";
$result = $conn->query($sql);
?>
<?php include("header.php"); ?>
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
		<!-- Ekleme işlemi yapılacaksa boş form gözükecektir-->
		<?php if($_GET['table']==""){ ?>
			<form class="user" action="" method="post" >
				<div class="form-group row">
					<div class="col-sm-6 mb-3 mb-sm-0">
						<input type="text" class="form-control" id="exampleFirstName" name="title" placeholder=" Başlık">
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="exampleLastName" name="url" placeholder=" Url">
					</div>
				</div>
				<div class="form-group">
					<textarea name="description" id="editor1" rows="10" cols="80" data-sample-short></textarea>
				</div>
                <script>
                    CKEDITOR.replace( 'editor1' );                    
                </script>
				<button name="add" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-save"></i>
                    </span>
                    <span class="text"> Ekle</span>
                </button>
			</form>
		<?php }else{
			$id=$_GET["id"];
			$table=$_GET["table"];
			echo $_GET["table"]." tablosundaki ". $id." idli veri düzenleniyor";
			// get verisinden gelen tablo ismi ve idisi çağırılır ve formda gösterilir.
			$resul = $conn->query("SELECT * FROM ".$table." where id =$id");
			if($resul->num_rows > 0) {
			while($item = $resul->fetch_assoc()) {
				?>
				
		<!-- Eğer güncelleme işlemi yapılmak isteniyorsa bu form gözükecek-->		
			<form class="user" action="" method="post"  >
				<div class="form-group row">
					<div class="col-sm-6 mb-3 mb-sm-0">
						<input type="text" class="form-control" id="exampleFirstName" value="<?php echo $item["title"]; ?>" name="title" placeholder=" Başlık">
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="exampleLastName" value="<?php echo $item["url"]; ?>" name="url"  placeholder=" Url">
					</div>
				</div>
				<div class="form-group">
					<textarea name="description" id="editor1" rows="10" cols="80" data-sample-short><?php echo $item["description"]; ?></textarea>
				</div>
                <script>
                    CKEDITOR.replace( 'editor1' );                    
                </script>
				<button  name="update" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-save"></i>
                    </span>
                    <span class="text"> Güncelle</span>
                </button>
			</form>
			
			<?
			}}
		} ?>
		</div>
	</div>
	<!-- DataTales Example -->
	
	<!-- Page Heading -->
	<!-- Tümkayıtlar listeleniyor -->
	<div class="card shadow mb-4">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>İd</th>
							<th>Başlık</th>
							<th>URL</th>
							<th>Açıklama</th>
							<th style="width:150px;">Kayıt Tarihi</th>
							<th style="width:200px;">İşlem</th>
						</tr>
					</thead>
					<tbody>
						<?php if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) { ?>
							<tr>
								<td><?php echo $row["id"];?></td>
								<td><?php echo $row["title"];?></td>
								<td><?php echo $row["url"];?></td>
								<td><?php echo $row["description"];?></td>
								<td><?php echo $row["tarih"];?></td>
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

<?php include("footer.php"); ?>

<?php
	$title=$_POST["title"];
	$url=$_POST["url"];
	$description=$_POST["description"];
	// ekleme formu gönderildiğinde çalışacak blok
	if(isset($_POST["add"])){
		if($title!="" && $url!="" && $description!="")
		{
			$sql = "INSERT INTO ".$table." (title, url, description) VALUES ('$title', '$url', '$description')";
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
	
	// Güncelleme formu gönderildiğinde çalışacak blok
	if(isset($_POST["update"])){
		date_default_timezone_set('Europe/Istanbul');
		$tarih=date("Y-m-d H:i:s");
		
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