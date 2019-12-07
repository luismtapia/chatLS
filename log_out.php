<?php
	include('lynxspace.class.php');
	$sitio->log_out();
	$mensaje = "Gracias por usar el sistema";
	$direccion = "<a class='iconos' href='log_in.php'>Regresar <span class='fa fa-arrow-circle-left'></span></a>";
	if (isset($_GET['code'])) {
		$code = $_GET['code'];
		switch ($code) {
			case 0:
				$mensaje = "Usuario y/o contraseñas incorrectas";
				$direccion = "<a class='iconos' href='log_in.php'>Regresar <span class='fa fa-arrow-circle-left'></span></a>";
				break;
			case 1:
				$mensaje = "Usted no tiene un rol permitido";
				$direccion = "<a class='iconos' href='index.php'>Regresar <span class='fa fa-arrow-circle-left'></span> </a>";
				break;
			case 2:

				break;
			default:
				# code...
				break;
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>
    <link rel="stylesheet" type="text/css" href="css/login.css">
		<link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
	<title>Cerrar sesion</title>
</head>
<body>
	<div class="caja">
				<form class="" action="log_in.php" method="post" >
					<div class="iniciar_sesion">
						<h3 class="form-titulo" id="iniciar_sesion"><?php echo $mensaje; ?></h3>
					</div>

					<div class="animacion1">
						<h5 class="logo">
								<a href="#">
									<img src="image/Logo.png" alt="Lynxspace">
								</a>
						</h5>
					</div>
					<div class="botonera">
							<?php echo $direccion;?>
					</div>
				</form>
	</div>
</body>







</html>
