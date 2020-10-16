<?php
include('conexion.php');

$usuario = $_POST['usuario'];
$clave = md5($_POST["clave"]);
$pase = 0;

$consulta1 = "SELECT * FROM usuarios WHERE usuario = '".$usuario."' and clave = '".$clave."' LIMIT 1";
$resultado1 = mysqli_query( $conexion, $consulta1 );
$fila1 = mysqli_num_rows($resultado1);

if($fila1>=1){
	$pase = 1;
	while($row = mysqli_fetch_array($resultado1)) {
		$usuario_correo=$row['correo'];
		$usuario_usuario=$row['usuario'];
		$usuario_rol=$row['rol'];	
	}
}

if($pase==1){
	session_start();
	$_SESSION["usuario"] = $usuario_usuario;
	$_SESSION["correo"] = $usuario_correo;
	$_SESSION["rol"] = $usuario_rol;
}

echo $pase;

?>