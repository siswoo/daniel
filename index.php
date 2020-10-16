<?php session_start(); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/validaciones.css">
    <title>System Crack</title>
  </head>
<body>
	<script src="js/jquery-3.5.1.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  	
  	<?php
		if(@$_SESSION['usuario']!=null){ ?>
			<script type="text/javascript">
				$(document).ready(function() {
					const swalWithBootstrapButtons = Swal.mixin({
					  customClass: {
					    confirmButton: 'btn btn-success mr-2',
					    cancelButton: 'btn btn-danger'
					  },
					  buttonsStyling: false
					})
					swalWithBootstrapButtons.fire({
 					title: 'Has vuelto al inicio',
 					text: "Aún esta logueado, desea cerrar sesión?",
 					icon: 'info',
 					position: 'center',
 					showConfirmButton: true,
 					showCancelButton: true,
 					confirmButtonText: 'Seguir en sesión',
 					cancelButtonText: 'Cerrar sesión',
					}).then((result) => {
						if (result.value) {
						    window.location.href = "index2.php";
						} else {
							window.location.href = "script/cerrar_sesion.php";
						}
					})
				});
			</script>
		<?php exit; ?>
			</script>
		<?php }
	?>

    <div class="seccion1">
	    <div class="row">
		    <div class="container">
			    <form action="#" method="POST" id="formulario1" style="margin-left: 30%; margin-right: 30%;">
				    <div class="col-12" class="text-center">
				    	<p class="text-center titulo1">Ingrese Datos de Ingreso</p>
				    </div>
				    <div class="form-group form-check">
					    <label for="usuario">Usuario o Correo</label>
					    <input type="text" class="form-control" name="usuario" id="usuario" placeholder="" value="">
					    <div class="ml-1 mt-1 error_texto1 d-none" id="error_texto1">Este campo no debe estar vacio.</div>
				    </div>

				    <div class="form-group form-check">
					    <label for="clave">Clave</label>
					    <input type="password" class="form-control" name="clave" id="clave" placeholder="" value="">
					    <div class="ml-1 mt-1 error_texto2 d-none" id="error_texto2"></div>
					    <small id="emailHelp" class="form-text text-muted">Los datos de ingreso son totalmente confidenciales.</small>
				    </div>
					<div class="row">
						<div class="col-md-6 form-group form-check text-center">
							<button type="submit" id="submit" class="btn btn-success">Ingresar</button>
						</div>
					</div>
			    </form>
		    </div>
	    </div>
    </div>

<form action="welcome.php" id="formulario2" method="POST">
	<input type="hidden" value="" id="usuario_nombre" name="usuario_nombre">
	<input type="hidden" value="" id="usuario_apellido" name="usuario_apellido">
	<input type="hidden" value="" id="usuario_correo" name="usuario_correo">
	<input type="hidden" value="" id="usuario_rol" name="usuario_rol">
	<input type="hidden" value="" id="usuario_telefono1" name="usuario_telefono1">
	<input type="hidden" value="" id="usuario_usuario" name="usuario_usuario">
</form>

  </body>
</html>

<script>
$("#formulario1").on("submit", function(e){
	e.preventDefault();
	var f = $(this);
	var usuario = $('#usuario').val();
	var clave = $('#clave').val();

	/*******VALIDACIONES********/
	if(usuario==''){
		$('#usuario').addClass('error1');
		$('#error_texto1').removeClass('d-none');
		$('#error_texto1').html('Este campo no debe estar vacio.');
		return false;
	}

	if(clave==''){
		$('#clave').addClass('error1');
		$('#error_texto2').removeClass('d-none');
		$('#error_texto2').html('Este campo no debe estar vacio.');
		return false;
	}
	/***************************/

    $.ajax({
		type: 'POST',
		url: 'script/login.php',
		data: $('#formulario1').serialize(),
		dataType: "JSON",
		success: function(respuesta) {
			console.log(respuesta);

			if(respuesta == 0){
				Swal.fire({
					position: 'center',
					icon: 'error',
					title: 'Usuario incorrecto...!',
					showConfirmButton: true,
					timer: 3000
				})
				return false;
			}

			Swal.fire({
 				title: 'Bienvenido usuario',
 				text: "Redirigiendo...!",
 				icon: 'success',
 				position: 'center',
 				showConfirmButton: true,
 				confirmButtonColor: '#3085d6',
 				confirmButtonText: 'No esperar!',
 				timer: 3000
			}).then((result) => {
 				if (result.value) {
   					window.location.href = "index2.php";
 				}
			})
			setTimeout(function() {
		    	window.location.href = "index2.php";
			},3500);
		},

		error: function(respuesta) {
			console.log(respuesta['responseText']);
		}
	});

});

$(document).ready(function(){
	/******VALIDACIONES EN TIEMPO REAL***********/
	$("#nombre").keyup(function(){
		var variable = $("#nombre").val();
    	var size = variable.length;
    	
    	if(size >= 4){
    		$('#nombre').removeClass('error1');
			$('#error_texto1').addClass('d-none');
    	}

    	if(size <= 3 && size != 0){
    		$('#nombre').removeClass('error1');
			$('#error_texto1').removeClass('d-none');
			$('#error_texto1').html('El campo debe contener al menos 4 caracteres.');
    	}

    	if(size == 0){
    		$('#nombre').addClass('error1');
			$('#error_texto1').removeClass('d-none');
			$('#error_texto1').html('Este campo no debe estar vacio.');
    	}
	});

	$("#clave").keyup(function(){
		var variable = $("#clave").val();
    	var size = variable.length;
    	
    	if(size >= 4){
    		$('#clave').removeClass('error1');
			$('#error_texto2').addClass('d-none');
    	}

    	if(size <= 3 && size != 0){
    		$('#clave').removeClass('error1');
			$('#error_texto2').removeClass('d-none');
			$('#error_texto2').html('El campo debe contener al menos 4 caracteres.');
    	}

    	if(size == 0){
    		$('#clave').addClass('error1');
			$('#error_texto2').removeClass('d-none');
			$('#error_texto2').html('Este campo no debe estar vacio.');
    	}
	});
/******************************************************************************************/
});

</script>