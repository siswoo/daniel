<?php
include('script/conexion.php');
$id_producto = $_POST['id_producto'];
$condicion = $_POST['condicion'];

if($condicion=='editar'){
	$sql = "SELECT * FROM productos WHERE id = ".$id_producto;
	$consulta = mysqli_query($conexion,$sql);
	while($row = mysqli_fetch_array($consulta)) {
		$datos = [
			"id" => $row['id'],
			"descripcion" => $row['descripcion'],
			"cantidad" => $row['cantidad'],
			"precio" => $row['precio'],
			"imagen" => $row['imagen'],
			"categoria" => $row['categoria'],
			"fecha_inicio" => $row['fecha_inicio'],
		];

		echo json_encode($datos);
	}
}

?>