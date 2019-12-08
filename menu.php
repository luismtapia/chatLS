<div class="row">
			<div class="col-sm-12">
				<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #008080;">
				  	<a href="index.php"><img src="image/Logo.png" style="margin-left: 30px;" alt="logo"></a>
					<div class="collapse navbar-collapse" id="navbarColor01" style="margin-right: 90px;">
				    	<ul class="navbar-nav ml-auto" style="font-size: 17px;">
				    		<li class="nav-item active">
				    			<a class="nav-link" href="index.php">
							  	<?php
								if (is_null($data['foto'])) {
									echo "<img src='uploads/default.png' height='30' width='30' class='rounded-circle' alt='imagen_perfil'>";
								}else{
									echo "<img src='uploads/$foto' height='30' width='30' class='rounded-circle' alt='imagen_perfil'>";
								}
								?>
								<?php echo $data['nombre']." ".$data['apellidos']." (".$data['apodo'].")"; ?>
								</a>
				    		</li>
					      	<li class="nav-item active">
					        	<a class="nav-link" href="index.php" title="Inicio"><i class="material-icons">home</i></a>
					      	</li>
					      	<li class="nav-item">
			    				<a class="nav-link" href="amigos.php" title="Amigos"><i class="material-icons">group</i></a>
			  				</li>
					      	<li class="nav-item">
			    				<a class="nav-link" href="sugerencias.php" title="Sugerencias"><i class="material-icons">supervisor_account</i></a>
			  				</li>
					      	<li class="nav-item dropdown">
			      				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Opciones"><i class="material-icons">list</i></a>
			      				<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			      					<a class="dropdown-item" href="editar_perfil.php">Editar Perfil </a>
			        				<a class="dropdown-item" href="seguridad.php">Roles y Privilegios</a>
			        				<a class="dropdown-item" href="admi_seguridad.php">Administrador</a>
			        				<a class="dropdown-item" href="log_out.php">Salir</a>
			      				</div>
			    			</li>
				   	 	</ul>
				  	</div>
				</nav>
			</div>
		</div>