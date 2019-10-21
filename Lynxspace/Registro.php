<?php
	include('lynsxpace.class.php');
	if(isset($_POST['registrar'])){
		$data = $_POST;
		$sitio->registro($data);
		die();
	}
	
?>
<!DOCTYPE html>
<html >
<head>
<meta charset="utf-8">
<meta name="viewport" content="">
<meta http-equiv="X-UA-Compatible" content="">
	<title>Abre una Cuenta</title>
</head>
<body>
<h1>Abre una Cuenta</h1>
<h3>Es rápido y fácil</h3>
<form method="POST" action="registro.php">
	<input type="text" name="nombre" placeholder="Nombre">
	<input type="text" name="apellidos" placeholder="Apellidos">
	<input type="text" name="correo_electronico" placeholder="Correo ELectronico">
	<input type="password" name="contrasena" placeholder="Contraseña">
	<input type="date" name="nacimiento">
	<input type="submit" name="registrar" placeholder="Registrar">
</form>

</body>
</html>