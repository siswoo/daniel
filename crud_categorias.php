<?php
include('script/conexion.php');
$condicion = $_POST['condicion'];

if($condicion=='editar'){
	$id = $_POST['id'];
	$nombre = $_POST['nombre'];
	$fecha_inicio = $_POST['fecha_inicio'];
	$sql1 = "UPDATE categorias SET nombre = '".$nombre."', fecha_inicio = '".$fecha_inicio."' WHERE id = ".$id;
	$editar1 = mysqli_query($conexion,$sql1);
}

if($condicion=='eliminar'){
	$id = $_POST['id'];
	$sql1 = "DELETE FROM categorias WHERE id = ".$id;
	$eliminar = mysqli_query($conexion,$sql1);
}

if($condicion=='nuevo'){
	$nombre = $_POST['nombre'];
	$fecha_inicio = $_POST['fecha_inicio'];
	$sql1 = "INSERT INTO categorias (nombre,fecha_inicio) VALUES ('$nombre','$fecha_inicio')";
	$nuevo = mysqli_query($conexion,$sql1);
}

$datos = [
	"sql" => $sql1,
];

echo json_encode($datos);

?>