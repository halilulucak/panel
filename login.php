<?php 
ob_start();
session_start();

$my_user="nihal";
$my_pass="nnn";

	
if(!empty($_POST['username'] ||  $_POST['pass'])){
	if($my_user==$_POST['username'] && $my_pass=$_POST['pass'])
	{
	$_SESSION['username']= $_POST['username'];
	$_SESSION['pass']=$_POST['pass'];
	header("Location: blank.php");
die(); 
}
else{
	echo "giriş denemesi başarısız";
	header("Refresh: 3; url=index.php"); 
}
}
else{
	echo "bilgiler boş";
}

?>
