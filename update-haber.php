<?php include("baglan.php");

$id=$_GET["id"];


$result = $conn->query("SELECT * FROM haberler where id =$id");


?>

<?php 
if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
?>
		
		<form action="" method="post" >
				<div class="eposta">
					<input  type="text" placeholder="başlık Giriniz" name="title" value="<?php echo $row["title"]; ?>">
				</div>
				<div class="eposta">
					<input  type="text" placeholder="url Giriniz" name="url" value="<?php echo $row["url"]; ?>">
				</div>
				<textarea name="description"><?php echo $row["description"]; ?> </textarea>
				
				<input class="go" type="submit" value="Güncelle">
			</form>
		<?php 
		print_r($_POST);
		
		?>
		
		
		
<?php
	}
}
?>