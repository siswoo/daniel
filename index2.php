<?php
	session_start();
	if(!isset($_SESSION['usuario'])){
		header("Location: index.php");
		exit;
	}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/welcome.css">
	<title>Camaleon Sistem</title>
</head>
<body>
<?php
	include('script/conexion.php');
	$ubicacion = "welcome";
	include('navbar.php');
?>
	
	<div class="container">
		<div class="row">
			<div class="col-12 text-center mt-3" style="font-size: 30px; font-weight: bold; color: #6d0808c7;">
				Sistema Crack Versión 1.0
			</div>
		</div>
	</div>

</body>
</html>

<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="js/navbar.js"></script>