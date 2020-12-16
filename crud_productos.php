<?php
include('script/conexion.php');
$condicion = $_POST['condicion'];

if($condicion=='editar'){
	$id = $_POST['id'];
	$descripcion = $_POST['descripcion'];
	$marca = $_POST['marca'];
	$referencia = $_POST['referencia'];
	$cantidad = $_POST['cantidad'];
	$precio = $_POST['precio'];
	$categoria = $_POST['categoria'];
	$fecha_inicio = $_POST['fecha_inicio'];
	$sql1 = "UPDATE productos SET descripcion = '".$descripcion."', marca = '".$marca."', referencia = '".$referencia."', cantidad = '".$cantidad."', precio = '".$precio."', categoria = '".$categoria."', fecha_inicio = '".$fecha_inicio."' WHERE id = ".$id;
	$editar1 = mysqli_query($conexion,$sql1);
}

if($condicion=='eliminar'){
	$id = $_POST['id'];
	$sql1 = "DELETE FROM productos WHERE id = ".$id;
	$eliminar = mysqli_query($conexion,$sql1);
}

if($condicion=='nuevo'){
	$descripcion = $_POST['descripcion'];
	$marca = $_POST['marca'];
	$referencia = $_POST['referencia'];
	$cantidad = $_POST['cantidad'];
	$precio = $_POST['precio'];
	$categoria = $_POST['categoria'];
	$fecha_inicio = $_POST['fecha_inicio'];
	$sql1 = "INSERT INTO productos (descripcion,marca,referencia,cantidad,precio,categoria,fecha_inicio) VALUES ('$descripcion','$marca','$referencia','$cantidad','$precio','$categoria','$fecha_inicio')";
	$nuevo = mysqli_query($conexion,$sql1);
}

$datos = [
	"sql" => $sql1,
];

echo json_encode($datos);

?>