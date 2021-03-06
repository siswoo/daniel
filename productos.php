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
	$ubicacion = "productos";
	include('navbar.php');
?>
	
	<div class="ml-12 mt-3 mb-3 text-center" style="font-size: 24px; font-weight: bold; text-transform: uppercase;">Productos</div>

	<div class="col-12 text-right mt-3 mb-3">
		<input type="submit" class="btn btn-success" value="Nuevo Registro" data-toggle="modal" data-target="#Modal_new">
	</div>

	<div class="ml-3 mr-3">
		<table id="example" class="table row-border hover table-bordered" style="font-size: 12px;">
			<thead>
				<tr>
					<th class="text-center">ID</th>
					<th class="text-center">Descripción</th>
					<th class="text-center">Marca</th>
					<th class="text-center">Referencia</th>
					<th class="text-center">Cantidad</th>
					<th class="text-center">Precio</th>
					<th class="text-center">Categoría</th>
					<th class="text-center">Fecha Ingresado</th>
					<th class="text-center">Opciones</th>
				</tr>
			</thead>
			
			<tbody id="resultados">
				<?php
				$consulta2 = "SELECT * FROM productos";
				$resultado2 = mysqli_query( $conexion, $consulta2 );
				while($row2 = mysqli_fetch_array($resultado2)) {
					$productos_id 				= $row2['id'];
					$productos_descripcion 		= $row2['descripcion'];
					$productos_marca 			= $row2['marca'];
					$productos_referencia 		= $row2['referencia'];
					$productos_cantidad 		= $row2['cantidad'];
					$productos_precio 			= $row2['precio'];
					$productos_imagen 			= $row2['imagen'];
					$productos_categoria 		= $row2['categoria'];
					$productos_fecha_inicio 	= $row2['fecha_inicio'];

					$consulta3 = "SELECT * FROM categorias WHERE id = ".$productos_categoria;
					$resultado3 = mysqli_query($conexion,$consulta3);
					while($row3 = mysqli_fetch_array($resultado3)) {
						$categoria_nombre = $row3['nombre'];
					}

					echo '
						<tr>
						    <td class="text-center">'.$productos_id.'</td>
							<td class="text-center">'.$productos_descripcion.'</td>
							<td class="text-center">'.$productos_marca.'</td>
							<td class="text-center">'.$productos_referencia.'</td>
							<td class="text-center">'.$productos_cantidad.'</td>
							<td class="text-center">'.$productos_precio.'</td>
							<td class="text-center">'.$categoria_nombre.'</td>
							<td class="text-center">'.$productos_fecha_inicio.'</td>
							<td class="text-center">
					';

					echo '
						<i class="fas fa-edit" style="color:#0095ff; cursor:pointer;" title="" value="'.$productos_id.'" data-toggle="modal" data-target="#Modal_editar" onclick="modal_edit('.$productos_id.');"></i>
						<i class="fas fa-trash-alt ml-3" style="color:red; cursor:pointer;" data-toggle="popover-hover" onclick="eliminar('.$productos_id.');" value="'.$productos_id.'"></i>
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
							    <label for="edit_marca">Marca</label>
							    <input type="text" name="edit_marca" id="edit_marca" value="" class="form-control" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_referencia">Referencia</label>
							    <input type="text" name="edit_referencia" id="edit_referencia" value="" class="form-control" required>
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
					    </div>
					</div>
					<div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				        <button type="submit" class="btn btn-success" id="edit_submit">Guardar</button>
			      	</div>
		      	</form>
	    	</div>
	  	</div>
	</div>
<!-- FIN Modal Editar Producto -->


<!-- Modal Nuevo -->
	<div class="modal fade" id="Modal_new" tabindex="-1" role="dialog" aria-labelledby="Modal_new" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form action="#" method="POST" id="form_modal_new" style="">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Nuevo Producto</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					    <div class="row">
						    <div class="col-6 form-group form-check">
							    <label for="new_descripcion">Descripción</label>
							    <input type="text" name="new_descripcion" id="new_descripcion" value="" class="form-control" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="new_marca">Marca</label>
							    <input type="text" name="new_marca" id="new_marca" value="" class="form-control" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="new_referencia">Referencia</label>
							    <input type="text" name="new_referencia" id="new_referencia" value="" class="form-control" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="new_cantidad">Cantidad</label>
							    <input type="text" name="new_cantidad" id="new_cantidad" value="" class="form-control" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="new_precio">Precio</label>
							    <input type="text" name="new_precio" id="new_precio" value="" class="form-control" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="new_categoria">Categoría</label>
							    <select id="new_categoria" class="form-control" required>
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
							    <label for="new_fecha_inicio">Fecha de Ingreso</label>
							    <input type="date" name="new_fecha_inicio" id="new_fecha_inicio" value="" class="form-control" required>
						    </div>
					    </div>
					</div>
					<div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				        <button type="submit" class="btn btn-success" id="new_submit">Guardar</button>
			      	</div>
		      	</form>
	    	</div>
	  	</div>
	</div>
<!-- FIN Modal Nuevo -->


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
				$('#edit_marca').val(respuesta['marca']);
				$('#edit_referencia').val(respuesta['referencia']);
				$('#edit_cantidad').val(respuesta['cantidad']);
				$('#edit_precio').val(respuesta['precio']);
				$('#edit_categoria').val(respuesta['categoria']);
				$('#edit_fecha_inicio').val(respuesta['fecha_inicio']);
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

	$("#form_modal_new").on("submit", function(e){
		e.preventDefault();
		var descripcion = $('#new_descripcion').val();
		var marca = $('#new_marca').val();
		var referencia = $('#new_referencia').val();
		var cantidad = $('#new_cantidad').val();
		var precio = $('#new_precio').val();
		var categoria = $('#new_categoria').val();
		var fecha_inicio = $('#new_fecha_inicio').val();
		var condicion = 'nuevo';
	    $.ajax({
			type: 'POST',
			url: 'crud_productos.php',
			data: {
				"descripcion": descripcion,
				"marca": marca,
				"referencia": referencia,
				"cantidad": cantidad,
				"precio": precio,
				"categoria": categoria,
				"fecha_inicio": fecha_inicio,
				"condicion": condicion,
			},
			dataType: "JSON",
			success: function(respuesta) {
				//console.log(respuesta);
				$('#new_submit').addClass('d-none');
				Swal.fire({
					position: 'center',
					icon: 'success',
					title: 'Creado exitosamente...!',
					showConfirmButton: false,
					timer: 2000
				});
				setTimeout(function() {
					window.location.href = "productos.php";
				},2100);
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	});

	$("#form_modal_edit").on("submit", function(e){
		e.preventDefault();
		var id = $('#edit_id').val();
		var descripcion = $('#edit_descripcion').val();
		var marca = $('#edit_marca').val();
		var referencia = $('#edit_referencia').val();
		var cantidad = $('#edit_cantidad').val();
		var precio = $('#edit_precio').val();
		var categoria = $('#edit_categoria').val();
		var fecha_inicio = $('#edit_fecha_inicio').val();
		var condicion = 'editar';
	    $.ajax({
			type: 'POST',
			url: 'crud_productos.php',
			data: {
				"id": id,
				"descripcion": descripcion,
				"marca": marca,
				"referencia": referencia,
				"cantidad": cantidad,
				"precio": precio,
				"categoria": categoria,
				"fecha_inicio": fecha_inicio,
				"condicion": condicion,
			},
			dataType: "JSON",
			success: function(respuesta) {
				//console.log(respuesta);
				$('#edit_submit').addClass('d-none');
				Swal.fire({
					position: 'center',
					icon: 'success',
					title: 'Modificado exitosamente...!',
					showConfirmButton: false,
					timer: 2000
				});
				setTimeout(function() {
					window.location.href = "productos.php";
				},2100);
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	});

	function eliminar(variable){
		var condicion = 'eliminar';
		Swal.fire({
		  title: 'Estas seguro?',
		  text: "Esta acción no podra revertirse",
		  icon: 'warning',
		  showConfirmButton: true,
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Si, Eliminar registro!',
		  cancelButtonText: 'Cancelar'
		}).then((result) => {
		  if (result.value) {
		    $.ajax({
				type: 'POST',
				url: 'crud_productos.php',
				data: {
					"id": variable,
					"condicion": condicion,
				},
				dataType: "JSON",
				success: function(respuesta) {
					Swal.fire({
					    title: 'Registro Eliminado!',
					    text: 'Redirigiendo...',
					    icon: 'success',
					    showConfirmButton: false
				    });setTimeout(function() {
			      		window.location.href = "productos.php";
			    	},3500);
				},

				error: function(respuesta) {
					console.log("error..."+respuesta);
				}
			});
		  }
		})
	}


</script>
