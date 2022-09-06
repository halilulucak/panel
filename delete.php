<?php
session_start();
include("baglan.php");
$id=$_GET["id"];
$table=$_GET["table"];
$sql = "DELETE FROM ".$table." WHERE id=".$id;

if ($conn->query($sql) === TRUE) {
				$_SESSION['alert']="Silme işlemi başarılı";
				$_SESSION['type']="success";
				$_SESSION['icon']="trash";
				header("location:".$back_url);
} else {
				$_SESSION['alert']=$conn->error;
				$_SESSION['type']="danger";
				$_SESSION['icon']="remove";
				header("location:".$back_url);

}
?>