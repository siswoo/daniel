<?php
include('script/conexion.php');
$id_usuario = $_POST['id_usuario'];
$condicion = $_POST['condicion'];

if($condicion=='editar'){
	$sql = "SELECT * FROM usuarios WHERE id = ".$id_usuario;
	$consulta = mysqli_query($conexion,$sql);
	while($row = mysqli_fetch_array($consulta)) {
		$datos = [
			"id" => $row['id'],
			"usuario" => $row['usuario'],
			"correo" => $row['correo'],
			"rol" => $row['rol'],
			"sede" => $row['sede'],
			"fecha_inicio" => $row['fecha_inicio'],
		];

		echo json_encode($datos);
	}
}

?>