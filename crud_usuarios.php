<?php
include('script/conexion.php');
$condicion = $_POST['condicion'];

if($condicion=='editar'){
	$id = $_POST['id'];
	$usuario = $_POST['usuario'];
	$clave = md5($_POST['clave']);
	$correo = $_POST['correo'];
	$rol = $_POST['rol'];
	$sede = $_POST['sede'];
	$fecha_inicio = $_POST['fecha_inicio'];

	$sql2 = "SELECT * FROM usuarios WHERE usuario = '".$usuario."' or correo = '".$correo."'";
	$consultar1 = mysqli_query($conexion,$sql2);
	$contador1 = mysqli_num_rows($consultar1);

	if($contador1>=1){
		$datos = [
			"sql" => "error",
		];

		echo json_encode($datos);
		exit;
	}

	$sql1 = "UPDATE usuarios SET usuario = '".$usuario."', clave = '".$clave."', correo = '".$correo."', rol = '".$rol."', sede = '".$sede."', fecha_inicio = '".$fecha_inicio."' WHERE id = ".$id;
	$editar1 = mysqli_query($conexion,$sql1);
}

if($condicion=='eliminar'){
	$id = $_POST['id'];
	$sql1 = "DELETE FROM usuarios WHERE id = ".$id;
	$eliminar = mysqli_query($conexion,$sql1);
}

if($condicion=='nuevo'){
	$usuario = $_POST['usuario'];
	$clave = md5($_POST['clave']);
	$correo = $_POST['correo'];
	$rol = $_POST['rol'];
	$sede = $_POST['sede'];
	$fecha_inicio = $_POST['fecha_inicio'];

	$sql2 = "SELECT * FROM usuarios WHERE usuario = '".$usuario."' or correo = '".$correo."'";
	$consultar1 = mysqli_query($conexion,$sql2);
	$contador1 = mysqli_num_rows($consultar1);

	if($contador1>=1){
		$datos = [
			"sql" => "error",
		];

		echo json_encode($datos);
		exit;
	}

	$sql1 = "INSERT INTO usuarios (usuario,clave,correo,rol,sede,fecha_inicio) VALUES ('$usuario','$clave','$correo','$rol','$sede','$fecha_inicio')";
	$nuevo = mysqli_query($conexion,$sql1);
}

$datos = [
	"sql" => $sql1,
];

echo json_encode($datos);

?>