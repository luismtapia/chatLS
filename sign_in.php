<?php
	include('lynxspace.class.php');
	include('config.php');
	if (isset($_POST['registrar'])) {
		$data = $_POST;
		$sitio->sign_in($data);
		die();
	}
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>
		<link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
	<title>Registrarse</title>
</head>
<body>
	<div class="container">
		<h1 class="text-center">Registrate</h1>
		<hr>
		<form class="registration-form" method="POST" action="sign_in.php">
			<div class="form-row">
				<div class="col">
					<input type="text" class="form-control" name="nombre" placeholder="Nombre">
				</div>
				<div class="col">
					<input type="text" class="form-control" name="apellidos" placeholder="Apellidos">
				</div>
			</div>
			<br>

			<div class="form-row">
				<div class="col-sm-6">
					<input type="text" class="form-control" name="apodo" placeholder="Apodo">
				</div>
			</div>
			<br>

			<div class="form-row">
				<div class="col">
					<input type="text" class="form-control" name="email" placeholder="Correo Elentronico" required>
				</div>
				<div class="col">
					<input type="text" class="form-control" name="contrasena" placeholder="Contraseña" required>
				</div>
			</div>
			<br>

			<div class="form-row">
				<div class="col">
					<h4>Fecha de Nacimiento</h4>
						<select name="dia" id="dia">
							<?php
								for ($i = 1; $i < 32 ; $i++) {
									echo "<option value = '$i'>$i</option>";
								}
							?>
						</select>
						<select name="mes">
							<?php
								foreach ($meses as $value => $mes) {
									echo "<option value='$value'>$mes</option>";
								}
							?>
						</select>
						<select name="anio">
							<?php
								for ($i = (int)(date('Y'))-70; $i < (int)(date('Y'))-17; $i++) {
									echo "<option value = '$i'>$i</option>";
								}
							?>
						</select>
				 </div>
				 <div class="col">
				 </div>
			</div>
			<br>

			<div class="form-row">
					<div class="col">

					</div>
					<div class="col">
						<button type="submit" class="iconos btn btn-success my-2" name="registrar">Guardar</button>
						<a class="iconos btn btn-success" href="log_in.php"> Atras <span class='fa fa-arrow-circle-left'></span></a>
					</div>
			</div>


		</form>
	</div>
</body>
</html>
