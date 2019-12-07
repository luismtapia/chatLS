<?php
	include('lynxspace.class.php');
	include('config.php');
	if (isset($_POST['enviar'])) {
		$data = $_POST;
		$sitio->log_in($data['email'], $data['contrasena']);
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
	<title>Lynx-Space|Log-In</title>
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
		<h1 class="text-center">Log-In</h1>
		<form class="registration-form" method="POST" action="log_in.php">
			<label>
				<span class="label-text">Email</span>
				<input type="email" name="email">
			</label>
			<label class="password">
				<span class="label-text">Contraseña</span>
				<input type="password" name="contrasena">
			</label>
			<div class="text-center">
				<input type="submit" class="submit" name="enviar" value="Log-In"/>
			</div>
		</form>
		<a href="sign_in.php">Regitrarse</a>
	</div>
</body>
</html>