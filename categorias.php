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
	$ubicacion = "categorias";
	include('navbar.php');
?>
	
	<div class="ml-12 mt-3 mb-3 text-center" style="font-size: 24px; font-weight: bold; text-transform: uppercase;">Categorías</div>

	<div class="col-12 text-right mt-3 mb-3">
		<input type="submit" class="btn btn-success" value="Nuevo Registro" data-toggle="modal" data-target="#modal_new">
	</div>

	<div class="ml-3 mr-3">
		<table id="example" class="table row-border hover table-bordered" style="font-size: 12px;">
			<thead>
				<tr>
					<th class="text-center">Nombre</th>
					<th class="text-center">Fecha Ingresado</th>
					<th class="text-center">Opciones</th>
				</tr>
			</thead>
			
			<tbody id="resultados">
				<?php
				$consulta2 = "SELECT * FROM categorias";
				$resultado2 = mysqli_query( $conexion, $consulta2 );
				while($row2 = mysqli_fetch_array($resultado2)) {
					$categorias_id 				= $row2['id'];
					$categorias_nombre 			= $row2['nombre'];
					$categorias_fecha_inicio 	= $row2['fecha_inicio'];

					echo '
						<tr>
						    <td class="text-center">'.$categorias_nombre.'</td>
							<td class="text-center">'.$categorias_fecha_inicio.'</td>
							<td class="text-center">
					';

					echo '
						<i class="fas fa-edit" style="color:#0095ff; cursor:pointer;" title="" value="'.$categorias_id.'" data-toggle="modal" data-target="#Modal_editar" onclick="modal_edit('.$categorias_id.');"></i>
						<i class="fas fa-trash-alt ml-3" style="color:red; cursor:pointer;" data-toggle="popover-hover" onclick="eliminar('.$categorias_id.');" value="'.$categorias_id.'"></i>
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

<!-- Modal Editar -->
	<div class="modal fade" id="Modal_editar" tabindex="-1" role="dialog" aria-labelledby="Modal_editar" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form action="#" method="POST" id="form_modal_edit" style="">
				<input type="hidden" name="edit_id" id="edit_id">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Editar Categoría</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					    <div class="row">
						    <div class="col-6 form-group form-check">
							    <label for="edit_nombre">Nombre</label>
							    <input type="text" name="edit_nombre" id="edit_nombre" value="" class="form-control" required>
						    </div>
						    <div class="col-6 form-group form-check">
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
<!-- FIN Modal Editar -->

<!-- Modal Nuevo -->
	<div class="modal fade" id="modal_new" tabindex="-1" role="dialog" aria-labelledby="modal_new" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form action="#" method="POST" id="form_modal_new" style="">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Nuevo Categoría</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					    <div class="row">
						    <div class="col-6 form-group form-check">
							    <label for="new_nombre">Nombre</label>
							    <input type="text" name="new_nombre" id="new_nombre" value="" class="form-control" required>
						    </div>
						    <div class="col-6 form-group form-check">
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
<!-- FIN Modal Editar -->


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


	function modal_edit(id_categoria){
		var condicion = 'editar';
		$.ajax({
			type: 'POST',
			url: 'categorias_modales.php',
			dataType: "JSON",
			data: {
				"id_categoria": id_categoria,
				"condicion": condicion,
			},

			success: function(respuesta) {
				console.log(respuesta);
				$('#edit_id').val(respuesta['id']);
				$('#edit_nombre').val(respuesta['nombre']);
				$('#edit_fecha_inicio').val(respuesta['fecha_inicio']);
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

	/**********FIN LLENAR FORM EDIT******************/

	$("#form_modal_edit").on("submit", function(e){
		e.preventDefault();
		var id = $('#edit_id').val();
		var nombre = $('#edit_nombre').val();
		var fecha_inicio = $('#edit_fecha_inicio').val();
		var condicion = 'editar';
	    $.ajax({
			type: 'POST',
			url: 'crud_categorias.php',
			data: {
				"id": id,
				"nombre": nombre,
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
					window.location.href = "categorias.php";
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
				url: 'crud_categorias.php',
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
			      		window.location.href = "categorias.php";
			    	},3500);
				},

				error: function(respuesta) {
					console.log("error..."+respuesta);
				}
			});
		  }
		})
	}


	$("#form_modal_new").on("submit", function(e){
		e.preventDefault();
		var nombre = $('#new_nombre').val();
		var fecha_inicio = $('#new_fecha_inicio').val();
		var condicion = 'nuevo';
	    $.ajax({
			type: 'POST',
			url: 'crud_categorias.php',
			data: {
				"nombre": nombre,
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
					window.location.href = "categorias.php";
				},2100);
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	});


</script>