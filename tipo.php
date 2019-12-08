<?php
	include('lynxspace.class.php');
	$sitio->log_out();
	$mensaje = "No se permite usar este tipo de archivos";
	$direccion = "<a href='editar_perfil.php'>Regresar</a>";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
	<title>Obsidian Food | Log-out</title>
</head>
<body>
	<div class="container">
		<header>
			<h1>
				<a href="#">
					<img src="image/Logo.png" alt="lynxspace">
				</a>
			</h1>
		</header>
		<h1 class="text-center"><?php echo $mensaje; ?></h1>
		<form class="registration-form" method="POST" action="excede.php">
			<h5>
				<?php
					echo $direccion;
				?>
			</h5>
		</form>
	</div>
</body>
</html>