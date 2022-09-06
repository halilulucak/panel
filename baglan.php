<?php
$servername = "localhost";
$username = "u933077069_gundogdu";
$password = "Hu14531071.";
$dbname="u933077069_gundogdu";
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$back_url=$_SERVER['HTTP_REFERER'];
$page_url=str_replace("/nihal/", "",$_SERVER['PHP_SELF'] );
$set = $conn->query("SELECT * FROM ayarlar  ");
$settings= $set->fetch_assoc();		
?>

