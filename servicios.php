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
	<link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
	<link href="resources/fontawesome/css/all.css" rel="stylesheet">
	<title>System Crack</title>
</head>
<body>
<?php
	include('script/conexion.php');
	$ubicacion = "welcome";
	include('navbar.php');
?>
	
	<div class="col-12 text-right mt-3 mb-3">
		<input type="submit" class="btn btn-success" value="Nuevo Registro" data-toggle="modal" data-target="#modalCrear">
	</div>

	<div class="ml-3 mr-3">
		<table id="example" class="table row-border hover table-bordered" style="font-size: 12px;">
			<thead>
				<tr>
					<th class="text-center">ID</th>
					<th class="text-center">Tipo</th>
					<th class="text-center">Documento</th>
					<th class="text-center">Cliente</th>
					<th class="text-center">Teléfono</th>
					<th class="text-center">Producto</th>
					<th class="text-center">Marca</th>
					<th class="text-center">Modelo</th>
					<!--
					<th class="text-center">Falla</th>
					<th class="text-center">Abono</th>
					-->
					<!--
					<th class="text-center">V Reparación</th>
					<th class="text-center">V Revisión</th>
					<th class="text-center">P Reparación</th>
					<th class="text-center">P Reparación</th>
					-->
					<th class="text-center">Estado</th>
					<!--<th class="text-center">Usuario</th>-->
					<th class="text-center">Fecha Ingresado</th>
					<th class="text-center">Opciones</th>
				</tr>
			</thead>
			
			<tbody id="resultados">
				<?php
				$consulta2 = "SELECT * FROM servicios";
				$resultado2 = mysqli_query( $conexion, $consulta2 );
				while($row2 = mysqli_fetch_array($resultado2)) {
					$servicios_id 					= $row2['id'];
					$servicios_tipo 				= $row2['tipo'];
					$productos_id_cliente 			= $row2['id_cliente'];
					$servicios_producto 			= $row2['producto'];
					$servicios_marca 				= $row2['marca'];
					$servicios_modelo 				= $row2['modelo'];
					$servicios_falla 				= $row2['falla'];
					$servicios_observaciones 		= $row2['observaciones'];
					$servicios_abono 				= $row2['abono'];
					$servicios_valor_reparacion 	= $row2['valor_reparacion'];
					$servicios_valor_revision 		= $row2['valor_revision'];
					$servicios_pago_reparacion 		= $row2['pago_reparacion'];
					$servicios_pago_revision 		= $row2['pago_revision'];
					$servicios_estado_reparacion 	= $row2['estado_reparacion'];
					$productos_fecha_inicio 		= $row2['fecha_inicio'];
					$productos_id_usuario 			= $row2['id_usuario'];

					$consulta3 = "SELECT * FROM clientes WHERE id = ".$productos_id_cliente;
					$resultado3 = mysqli_query($conexion,$consulta3);
					while($row3 = mysqli_fetch_array($resultado3)) {
						$cliente_nombre = $row3['nombre'];
						$cliente_telefono = $row3['telefono'];
						$cliente_numero_identificacion = $row3['numero_identificacion'];
					}

					$consulta4 = "SELECT * FROM usuarios WHERE id = ".$productos_id_usuario;
					$resultado4 = mysqli_query($conexion,$consulta4);
					while($row4 = mysqli_fetch_array($resultado4)) {
						$usuario_usuario = $row4['usuario'];
					}

					echo '
						<tr>
						    <td class="text-center">'.$servicios_id.'</td>
							<td class="text-center">'.$servicios_tipo.'</td>
							<td class="text-center">'.$cliente_numero_identificacion.'</td>
							<td class="text-center">'.$cliente_nombre.'</td>
							<td class="text-center">'.$cliente_telefono.'</td>
							<td class="text-center">'.$servicios_producto.'</td>
							<td class="text-center">'.$servicios_marca.'</td>
							<td class="text-center">'.$servicios_modelo.'</td>
							<!--
							<td class="text-center">'.$servicios_falla.'</td>
							<td class="text-center">'.$servicios_abono.'</td>
							-->

							<!--
							<td class="text-center">'.$servicios_valor_reparacion.'</td>
							<td class="text-center">'.$servicios_valor_revision.'</td>
							<td class="text-center">'.$servicios_pago_reparacion.'</td>
							<td class="text-center">'.$servicios_pago_revision.'</td>
							-->
							<td class="text-center">'.$servicios_estado_reparacion.'</td>
							<!--<td class="text-center">'.$usuario_usuario.'</td>-->
							<td class="text-center">'.$productos_fecha_inicio.'</td>
							<td class="text-center">
					';

					echo '
						<i class="fas fa-edit" style="color:#0095ff; cursor:pointer;" title="" value="'.$servicios_id.'" data-toggle="modal" data-target="#Modal_editar" onclick="modal_edit('.$servicios_id.');"></i>
						<i class="fas fa-trash-alt ml-3" style="color:red; cursor:pointer;" data-toggle="popover-hover" onclick="eliminar('.$servicios_id.');" value="'.$servicios_id.'"></i>
					';

					echo '
							</td>
						</tr>
					';

				}
				?>
			</tbody>
		</table>
	</div>

</body>
</html>

<!--------------------MODALES-------------------------->

<!-- Modal Editar Producto -->
	<div class="modal fade" id="Modal_editar" tabindex="-1" role="dialog" aria-labelledby="Modal_editar" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form action="#" method="POST" id="form_modal_edit" style="">
				<input type="hidden" name="edit_id" id="edit_id">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Editar Producto</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					    <div class="row">
						    <div class="col-6 form-group form-check">
							    <label for="edit_descripcion">Descripción</label>
							    <input type="text" name="edit_descripcion" id="edit_descripcion" value="" class="form-control" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_cantidad">Cantidad</label>
							    <input type="text" name="edit_cantidad" id="edit_cantidad" value="" class="form-control" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_precio">Precio</label>
							    <input type="text" name="edit_precio" id="edit_precio" value="" class="form-control" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_categoria">Categoría</label>
							    <select id="edit_categoria" class="form-control" required>
							    	<?php
							    	$sql_categoria = "SELECT * FROM categorias";
							    	$consulta_categoria = mysqli_query($conexion,$sql_categoria);
									while($row_categoria = mysqli_fetch_array($consulta_categoria)) {
										echo '<option value="'.$row_categoria["id"].'">'.$row_categoria["nombre"].'</option>';
									}
									?>
							    </select>
						    </div>
						    <div class="col-12 form-group form-check">
							    <label for="edit_fecha_inicio">Fecha de Ingreso</label>
							    <input type="date" name="edit_fecha_inicio" id="edit_fecha_inicio" value="" class="form-control" required>
						    </div>
						    <!--
						    <div class="col-12 form-group text-center">
								<p>Imagen Actual</p>
							    <img src="" style="width: 150px;" id="edit_imagen">
						    </div>
						    <div class="col-12 form-group text-center">
								<p>Reemplazar Imagen</p>
							    <input type="file" name="edit_new_imagen" id="edit_new_imagen" class="form-control">
						    </div>
							-->
					    </div>
					</div>
					<div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				        <button type="submit" class="btn btn-success">Guardar</button>
			      	</div>
		      	</form>
	    	</div>
	  	</div>
	</div>
<!-- FIN Modal Editar Producto -->


<!-- Modal Crear Registro -->
	<div class="modal fade" id="modalCrear" tabindex="-1" role="dialog" aria-labelledby="modalCrear" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form action="#" method="POST" id="form_modal_crear" style="">
				<input type="hidden" name="edit_id" id="edit_id">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Crear Servicio</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					    <div class="row">
					    	<div class="col-12 text-center mb-2" style="background-color: black; color:white; font-size: 20px;">Cliente</div>
						    <div class="col-6 form-group form-check">
							    <label style="font-weight: bold;" for="edit_numero_identificacion"># Identificación</label>
							    <input type="text" name="edit_numero_identificacion" id="edit_numero_identificacion" value="" class="form-control" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label style="font-weight: bold;" for="edit_tipo_identificacion">Tipo Identificación</label>
							    <select name="edit_tipo_identificacion" id="edit_tipo_identificacion" class="form-control" required>
							    	<option value="">Seleccione</option>
							    	<option value="C.C">C.C</option>
							    	<option value="C.E">C.E</option>
							    	<option value="NIT">NIT</option>
							    </select>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label style="font-weight: bold;" for="edit_nombre">Nombre</label>
							    <input type="text" name="edit_nombre" id="edit_nombre" value="" class="form-control" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label style="font-weight: bold;" for="edit_telefono">Teléfono</label>
							    <input type="text" name="edit_telefono" id="edit_telefono" value="" class="form-control">
						    </div>
						    <div class="col-6 form-group form-check">
							    <label style="font-weight: bold;" for="edit_correo">Correo</label>
							    <input type="text" name="edit_correo" id="edit_correo" value="" class="form-control">
						    </div>
						    <div class="col-6 form-group form-check">
							    <label style="font-weight: bold;" for="edit_ciudad">Ciudad</label>
							    <input type="text" name="edit_ciudad" id="edit_ciudad" value="" class="form-control">
						    </div>
					    </div>

						<div class="row">
					    	<div class="col-12 text-center mb-2" style="background-color: black; color:white; font-size: 20px;">Característica Producto</div>
						    <div class="col-6 form-group form-check">
							    <label style="font-weight: bold;" for="edit_producto">Producto</label>
							    <select class="form-control" name="edit_producto" id="edit_producto" required>
							    	<option value="">Seleccione</option>
							    	<option value="Aspiradora Doméstica">Aspiradora Doméstica</option>
							    	<option value="Aspiradora Industrial">Aspiradora Industrial</option>
							    	<option value="Licuadora">Licuadora</option>
							    	<option value="Plancha">Plancha</option>
							    	<option value="Cafetera">Cafetera</option>
							    	<option value="Capuchinera">Capuchinera</option>
							    	<option value="Hidrolavadora Doméstica">Hidrolavadora Doméstica</option>
							    	<option value="Hidrolavadora Industrial">Hidrolavadora Industrial</option>
							    	<option value="Brilladora Doméstica">Brilladora Doméstica</option>
							    	<option value="Brilladora Industrial">Brilladora Industrial</option>
							    	<option value="Extractor">Extractor</option>
							    	<option value="Exprimidor">Exprimidor</option>
							    	<option value="Horno Microondas">Horno Microondas</option>
							    	<option value="Horno Tostador">Horno Tostador</option>
							    	<option value="Batidora de Inmersión">Batidora de Inmersión</option>
							    	<option value="Procesador de Alimentos">Procesador de Alimentos</option>
							    	<option value="Secador">Secador</option>
							    	<option value="Ventilador">Ventilador</option>
							    	<option value="Plancha de Cabello">Plancha de Cabello</option>
							    	<option value="Calefactor">Calefactor</option>
							    </select>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label style="font-weight: bold;" for="edit_marca">Marca</label>
							    <input type="text" name="edit_marca" id="edit_marca" value="" class="form-control" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label style="font-weight: bold;" for="edit_modelo">Modelo</label>
							    <input type="text" name="edit_modelo" id="edit_modelo" value="" class="form-control">
						    </div>
						    <div class="col-6 form-group form-check">
							    <label style="font-weight: bold;" for="edit_falla">Falla</label>
							    <input type="text" name="edit_falla" id="edit_falla" value="" class="form-control" required>
						    </div>
						    <div class="col-12 form-group form-check">
							    <label style="font-weight: bold;" for="edit_observaciones">Observaciones</label>
							    <textarea class="form-control" name="edit_observaciones" id="edit_observaciones" required></textarea>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label style="font-weight: bold;" for="edit_falla">Cancela Revisión</label>
							    <select class="form-control" name="edit_falla" id="edit_falla" required>
							    	<option value="">Seleccione</option>
							    	<option value="Si">Si</option>
							    	<option value="No">No</option>
							    </select>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label style="font-weight: bold;" for="edit_reparacion">Cancela Reparación</label>
							    <select class="form-control" name="edit_reparacion" id="edit_reparacion" required>
							    	<option value="">Seleccione</option>
							    	<option value="Si">Si</option>
							    	<option value="No">No</option>
							    </select>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label style="font-weight: bold;" for="edit_revision">Valor Revisión</label>
							    <input type="text" name="edit_revision" id="edit_revision" value="" class="form-control" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label style="font-weight: bold;" for="edit_reparacion">Valor Reparación</label>
							    <input type="text" name="edit_reparacion" id="edit_reparacion" value="" class="form-control" required>
						    </div>
						    <div class="col-12 form-group form-check">
							    <label style="font-weight: bold;" for="edit_abono">Abono</label>
							    <input type="text" name="edit_abono" id="edit_abono" value="" class="form-control" required>
						    </div>
					    </div>
					</div>

					<div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				        <button type="submit" class="btn btn-success">Guardar</button>
			      	</div>
		      	</form>
	    	</div>
	  	</div>
	</div>
<!-- FIN Modal Editar Producto -->


<!----------------------------------------------------->

<script src="js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="js/popper.js"></script>
<script src="js/bootstrap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="js/navbar.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
    	var table = $('#example').DataTable( {
        	//"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
        	"lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],

        	"language": {
	            "lengthMenu": "Mostrar _MENU_ Registros por página",
	            "zeroRecords": "No se ha encontrado resultados",
	            "info": "Ubicado en la página <strong>_PAGE_</strong> de <strong>_PAGES_</strong>",
	            "infoEmpty": "Sin registros actualmente",
	            "infoFiltered": "(Filtrado de <strong>_MAX_</strong> total registros)",
	            "paginate": {
			        "first":      "Primero",
			        "last":       "Última",
			        "next":       "Siguiente",
			        "previous":   "Anterior"
			    },
			    "search": "Buscar",
        	},

        	"paging": true

    	} );

	} );

	$('#myModal').on('shown.bs.modal', function () {
	  	$('#myInput').trigger('focus')
	});


	function modal_edit(id_producto){
		var condicion = 'editar';
		$.ajax({
			type: 'POST',
			url: 'productos_modales.php',
			dataType: "JSON",
			data: {
				"id_producto": id_producto,
				"condicion": condicion,
			},

			success: function(respuesta) {
				//console.log(respuesta);
				$('#edit_id').val(respuesta['id']);
				$('#edit_descripcion').val(respuesta['descripcion']);
				$('#edit_cantidad').val(respuesta['cantidad']);
				$('#edit_precio').val(respuesta['precio']);
				//$('#edit_imagen').val(respuesta['imagen']);
				//$('#edit_imagen').attr('src','img/'+respuesta['imagen']);
				$('#edit_categoria').val(respuesta['categoria']);
				$('#edit_fecha_inicio').val(respuesta['fecha_inicio']);
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}


</script>

