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
	$ubicacion = "usuarios";
	include('navbar.php');
?>
	
	<div class="ml-12 mt-3 mb-3 text-center" style="font-size: 24px; font-weight: bold; text-transform: uppercase;">Usuarios</div>

	<div class="col-12 text-right mt-3 mb-3">
		<input type="submit" class="btn btn-success" value="Nuevo Registro" data-toggle="modal" data-target="#Modal_new">
	</div>

	<div class="ml-3 mr-3">
		<table id="example" class="table row-border hover table-bordered" style="font-size: 12px;">
			<thead>
				<tr>
					<th class="text-center">ID</th>
					<th class="text-center">Usuario</th>
					<th class="text-center">Correo</th>
					<th class="text-center">Rol</th>
					<th class="text-center">Sede</th>
					<th class="text-center">Fecha Ingresado</th>
					<th class="text-center">Opciones</th>
				</tr>
			</thead>
			
			<tbody id="resultados">
				<?php
				$consulta2 = "SELECT * FROM usuarios WHERE rol != 1";
				$resultado2 = mysqli_query( $conexion, $consulta2 );
				while($row2 = mysqli_fetch_array($resultado2)) {
					$usuarios_id 			= $row2['id'];
					$usuarios_usuario 		= $row2['usuario'];
					$usuarios_correo 		= $row2['correo'];
					$usuarios_rol 			= $row2['rol'];
					if($usuarios_rol=='1'){
						$usuarios_rol = 'Admin';
					}
					if($usuarios_rol=='2'){
						$usuarios_rol = 'Encargado';
					}
					if($usuarios_rol=='3'){
						$usuarios_rol = 'Empleado';
					}
					$usuarios_sede 			= $row2['sede'];
					$consulta3 = "SELECT * FROM sedes WHERE id =".$usuarios_sede;
					$resultado3 = mysqli_query( $conexion, $consulta3 );
					while($row3 = mysqli_fetch_array($resultado3)) {
						$sede = $row3['nombre'];
					}
					$usuarios_fecha_inicio 	= $row2['fecha_inicio'];

					echo '
						<tr>
						    <td class="text-center">'.$usuarios_id.'</td>
							<td class="text-center">'.$usuarios_usuario.'</td>
							<td class="text-center">'.$usuarios_correo.'</td>
							<td class="text-center">'.$usuarios_rol.'</td>
							<td class="text-center">'.$sede.'</td>
							<td class="text-center">'.$usuarios_fecha_inicio.'</td>
							<td class="text-center">
					';

					echo '
						<i class="fas fa-edit" style="color:#0095ff; cursor:pointer;" title="" value="'.$usuarios_id.'" data-toggle="modal" data-target="#Modal_editar" onclick="modal_edit('.$usuarios_id.');"></i>
						<i class="fas fa-trash-alt ml-3" style="color:red; cursor:pointer;" data-toggle="popover-hover" onclick="eliminar('.$usuarios_id.');" value="'.$usuarios_id.'"></i>
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
						<h5 class="modal-title">Editar Usuarios</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					    <div class="row">
						    <div class="col-6 form-group form-check">
							    <label for="edit_usuario">Usuario</label>
							    <input type="text" name="edit_usuario" id="edit_usuario" value="" class="form-control" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_clave">Clave</label>
							    <input type="password" name="edit_clave" id="edit_clave" value="" class="form-control" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_correo">Correo</label>
							    <input type="email" name="edit_correo" id="edit_correo" value="" class="form-control" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_rol">Rol</label>
							    <select id="edit_rol" class="form-control" required>
							    	<option value="2">Encargado</option>
							    	<option value="3">Empleado</option>
							    </select>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="edit_sede">Sede</label>
							    <select id="edit_sede" class="form-control" required>
							    	<?php
							    	$sql_sedes = "SELECT * FROM sedes";
							    	$consulta_sedes = mysqli_query($conexion,$sql_sedes);
									while($row_sedes = mysqli_fetch_array($consulta_sedes)) {
										echo '<option value="'.$row_sedes["id"].'">'.$row_sedes["nombre"].'</option>';
									}
									?>
							    </select>
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
	<div class="modal fade" id="Modal_new" tabindex="-1" role="dialog" aria-labelledby="Modal_new" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form action="#" method="POST" id="form_modal_new" style="">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Nuevo Usuarios</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					    <div class="row">
						    <div class="col-6 form-group form-check">
							    <label for="new_usuario">Usuario</label>
							    <input type="text" name="new_usuario" id="new_usuario" value="" class="form-control" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="new_clave">Clave</label>
							    <input type="password" name="new_clave" id="new_clave" value="" class="form-control" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="new_correo">Correo</label>
							    <input type="email" name="new_correo" id="new_correo" value="" class="form-control" required>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="new_rol">Rol</label>
							    <select id="new_rol" class="form-control" required>
							    	<option value="2">Encargado</option>
							    	<option value="3">Empleado</option>
							    </select>
						    </div>
						    <div class="col-6 form-group form-check">
							    <label for="new_sede">Sede</label>
							    <select id="new_sede" class="form-control" required>
							    	<?php
							    	$sql_sedes = "SELECT * FROM sedes";
							    	$consulta_sedes = mysqli_query($conexion,$sql_sedes);
									while($row_sedes = mysqli_fetch_array($consulta_sedes)) {
										echo '<option value="'.$row_sedes["id"].'">'.$row_sedes["nombre"].'</option>';
									}
									?>
							    </select>
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


	function modal_edit(id_usuario){
		var condicion = 'editar';
		$.ajax({
			type: 'POST',
			url: 'usuarios_modales.php',
			dataType: "JSON",
			data: {
				"id_usuario": id_usuario,
				"condicion": condicion,
			},

			success: function(respuesta) {
				//console.log(respuesta);
				$('#edit_id').val(respuesta['id']);
				$('#edit_usuario').val(respuesta['usuario']);
				$('#edit_correo').val(respuesta['correo']);
				$('#edit_rol').val(respuesta['rol']);
				$('#edit_sede').val(respuesta['sede']);
				$('#edit_fecha_inicio').val(respuesta['fecha_inicio']);
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

	$("#form_modal_new").on("submit", function(e){
		e.preventDefault();
		var usuario = $('#new_usuario').val();
		var clave = $('#new_clave').val();
		var correo = $('#new_correo').val();
		var rol = $('#new_rol').val();
		var sede = $('#new_sede').val();
		var fecha_inicio = $('#new_fecha_inicio').val();
		var condicion = 'nuevo';
	    $.ajax({
			type: 'POST',
			url: 'crud_usuarios.php',
			data: {
				"usuario": usuario,
				"clave": clave,
				"correo": correo,
				"rol": rol,
				"sede": sede,
				"fecha_inicio": fecha_inicio,
				"condicion": condicion,
			},
			dataType: "JSON",
			success: function(respuesta) {
				//console.log(respuesta);
				$('#new_submit').addClass('d-none');
				if(respuesta['sql']=='error'){
					Swal.fire({
						position: 'center',
						icon: 'error',
						title: 'Usuario o Correo ya existentes...!',
						showConfirmButton: false,
						timer: 2000
					});
					$('#new_submit').removeClass('d-none');
					return false;
				}
				Swal.fire({
					position: 'center',
					icon: 'success',
					title: 'Creado exitosamente...!',
					showConfirmButton: false,
					timer: 2000
				});
				setTimeout(function() {
					window.location.href = "usuarios.php";
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
		var usuario = $('#edit_usuario').val();
		var clave = $('#edit_clave').val();
		var correo = $('#edit_correo').val();
		var rol = $('#edit_rol').val();
		var sede = $('#edit_sede').val();
		var fecha_inicio = $('#edit_fecha_inicio').val();
		var condicion = 'editar';
	    $.ajax({
			type: 'POST',
			url: 'crud_usuarios.php',
			data: {
				"id": id,
				"usuario": usuario,
				"clave": clave,
				"correo": correo,
				"rol": rol,
				"sede": sede,
				"fecha_inicio": fecha_inicio,
				"condicion": condicion,
			},
			dataType: "JSON",
			success: function(respuesta) {
				//console.log(respuesta);
				$('#edit_submit').addClass('d-none');
				if(respuesta['sql']=='error'){
					Swal.fire({
						position: 'center',
						icon: 'error',
						title: 'Usuario o Correo ya existentes...!',
						showConfirmButton: false,
						timer: 2000
					});
					$('#edit_submit').removeClass('d-none');
					return false;
				}
				Swal.fire({
					position: 'center',
					icon: 'success',
					title: 'Modificado exitosamente...!',
					showConfirmButton: false,
					timer: 2000
				});
				setTimeout(function() {
					window.location.href = "usuarios.php";
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
				url: 'crud_usuarios.php',
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
			      		window.location.href = "usuarios.php";
			    	},1500);
				},

				error: function(respuesta) {
					console.log("error..."+respuesta);
				}
			});
		  }
		})
	}


</script>
