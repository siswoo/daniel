<?php
include('script/conexion.php');
$id_categoria = $_POST['id_categoria'];
$condicion = $_POST['condicion'];

if($condicion=='editar'){
	$sql = "SELECT * FROM categorias WHERE id = ".$id_categoria;
	$consulta = mysqli_query($conexion,$sql);
	while($row = mysqli_fetch_array($consulta)) {
		$datos = [
			"id" => $row['id'],
			"nombre" => $row['nombre'],
			"fecha_inicio" => $row['fecha_inicio'],
		];

		echo json_encode($datos);
	}
}

?>