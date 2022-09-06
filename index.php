<?php 
ob_start();
session_start();
include("baglan.php");
?>


<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>XMobil Css Screen</title>
	
		<style>
		body{
		background-image: url(https://img.freepik.com/free-vector/hand-painted-watercolor-pastel-sky-background_23-2148902771.jpg?w=2000);
		}
			.kutu{
				    width: 400px;
					height: 400px;
					border-radius: 20px;
					margin: auto;
					margin-top: 120px;
					padding: 30px;
					background: linear-gradient(1deg, #429dd3, #166c68);
					box-shadow: 5px 5px 5px #ffffff78;
					animation-name:example;
					animation-duration:4s;
					animation-iteration-count:infinite;
			}
			@keyframes example{
			0%{
			margin-top:120px;
			border-radius:20px;
			}
			30%{
			
			border-radius:40px;
			transform: translate(0px, 0px) skew(1deg, 1deg);
			}
			
			60%{
			
			border-radius:40px;
			transform: translate(0px, 0px) skew(-1deg, -1deg);
			}
			100%{
			margin-top:120px;
			border-radius:20px;
			}
			}
			input{
				width:100%;
				height:60px;
				padding:5px;
				
				margin:15px 5px;
				font-family:arial;
				background:lightblue;
				color:#fff;
				font-size:20px;
				border:none;
				text-align:center;
				border-radius:30px;
				
			
			}
			input:focus{
				outline: none;
			}
			.go{
			width: 50%;
			margin: auto;
			display: block;
			border-radius: 30px;
			border-bottom: 5px dashed #fff;
			background: radial-gradient(#166a8b, #5cc6d7);
			margin-top: 25px;
		
			}
			p{
				display:none;
			}
			
			@media only screen and (max-width: 1200px) {
			
				.kutu{
					
				}
			}
			
			@media only screen and (max-width: 900px) {
			
				.kutu{
					
				}
			}
			
			
			@media only screen and (max-width: 485px) {
				.kutu{
					width:85%;background:red;
				}
				p{
					display:block;
				}
			}
			
			::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
			color: white;
			opacity: 1; /* Firefox */
			}
			h1, h4, a{
			text-align:center;
			color:#fff;
			font-family:arial;
			
			}
			form a{
			float:right;
			}
			
			li{
				list-style:none;
			}
			
			.eposta::before{
				    content: "\1F464";
					color: black;
					position: absolute;
					padding-left: 20px;
					margin-top: 20px;
					font-size: xx-large;
					
			}
			.sifre::before{
				    content: "\1F512";
					color: black;
					position: absolute;
					padding-left: 20px;
					margin-top: 20px;
					font-size: xx-large;
			}
			
			input:focus{
			box-shadow:0px 5px 5px #fff;
			}
			input:hover{
			box-shadow:5px 5px 5px #111;
			}
			
			.go:hover{
					background: linear-gradient(1deg, #429dd3, #166c68);
					box-shadow: 5px 5px 5px #ffffff78;
			}
			
			
		</style>
	</head>
	<body>
	
		<?php

		if($_SESSION['username']){
			echo $_SESSION['username']."hosgeldiniz";
			//echo"<a href='logout.php'>Çıkış yap</a>";
			
		}else{	?>
		<div class="kutu">
		<h1>Hemen Giriş Yapın</h1>
		
		<!-- <h4>Hemen Giriş Yapın</h4>-->
		<hr>
			<form action="" method="post" >
				<div class="eposta">
					<input  type="text" placeholder="E-posta Giriniz" name="username">
				</div>
				<div class="sifre">
				<input type="password" placeholder="Parola Giriniz" name="pass">
				</div>
				<a href="">Hesabın Var mı?</a>
				<input class="go" type="submit" value="Giriş Yap">
			</form>
		</div>
		<?php } ?>
	</body>
</html>
<?php 
if(isset($_POST['username'])){
	$my_user=$_POST['username'];
	$my_pass=sha1($_POST['pass']);
	print_r($_POST);
	
	$result = $conn->query("SELECT * FROM kullanicilar where email='$my_user' and password='$my_pass' " );
	if($result->num_rows > 0) {
	
		$_SESSION['username']= $_POST['username'];
		$_SESSION['pass']=$_POST['pass'];
		header("Location: blank.php");
		die(); 
	}else{
		echo "giriş denemesi başarısız";
		header("Refresh: 3; url=index.php"); 
	}
	
}

?>






