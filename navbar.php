<nav class="navbar navbar-expand-lg navbar-light bg-light">
<a class="navbar-brand" id="navbar-home" href="index2.php" style="font-weight: bold; border: 2px solid black; padding: 6px 12px; border-radius: 5px;">Inicio</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
  	</button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item" id="li-productos">
	        	<a class="nav-link navbar-active-a" href="productos.php" id="a-productos">Productos</a>
	      	</li>
	      	<li class="nav-item" id="li-servicios">
	        	<a class="nav-link navbar-active-a" href="servicios.php" id="a-servicios">Servicios</a>
	      	</li>
	      	<li class="nav-item" id="li-categorias">
	        	<a class="nav-link navbar-active-a" href="categorias.php" id="a-categorias">Categorías</a>
	      	</li>
	      	<li class="nav-item" id="li-usuarios">
	        	<a class="nav-link navbar-active-a" href="usuarios.php" id="a-usuarios">Usuarios</a>
	      	</li>
	    </ul>

	    <ul class="nav navbar-nav flex-row justify-content-between ml-auto">
            <li class="dropdown order-1">
				<button type="button" id="dropdownMenu1" data-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle"> 
					<?php echo $_SESSION['usuario']; ?>
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu dropdown-menu-right mt-2">
					<li class="px-3 py-2">
                        <form class="form" role="form">
							<div class="form-group">
								<a href="script/cerrar_sesion.php" id="navbar-cerrarSesion" style="color:black;font-weight: bold;">Cerrar Sesión</a>
							</div>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
	</div>
</nav>