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
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
	<title>Lynx-Space|Registrarse</title>
</head>
<body>
	<div class="container">
		<header>
			<h1>
				<a href="#">
					<img src="image/Logo.png" alt="Lynxspace">
				</a>
			</h1>
		</header>
		<h1 class="text-center">Registrate</h1>
		<form class="registration-form" method="POST" action="sign_in.php">
			<label class="col-one-half">
				<span class="label-text">Nombre/s</span>
				<input type="text" name="nombre">
			</label>
			<label class="col-one-half">
				<span class="label-text">Apellidos</span>
				<input type="text" name="apellidos">
			</label>
			<label>
				<span class="label-text">Apodo</span>
				<input type="text" name="apodo">
			</label>
			<label>
				<span class="label-text">Fecha de Nacimiento</span>
				<select name="dia">
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
			</label>
			<label>
				<span class="label-text">Email</span>
				<input type="email" name="email">
			</label>
			<label class="password">
				<span class="label-text">Contraseña</span>
				<button class="toggle-visibility" title="toggle password visibility" tabindex="-1">
					<span class="glyphicon glyphicon-eye-close"></span>
				</button>
				<input type="password" name="contrasena">
			</label>
			<div class="text-center">
				<input type="submit" class="submit" name="registrar" value="Registrar"/>
			</div>
		</form>
	</div>
</body>
</html>