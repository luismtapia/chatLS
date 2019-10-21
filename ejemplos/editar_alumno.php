<?php
$mysqli = new mysqli('localhost', 'nair', '1234', 'alumnos');
$id=$_GET['id'];
$resultado=$mysqli->query("UPDATE from alumnos where id=$id");
$fila = $resultado->fetch_assoc();
	$alumnos[$fila['id']]['nombre'] = $fila['nombre'];
	$alumnos[$fila['id']]['calificacion'] = $fila['calificacion'];
header('Location: alumnos.php');
?>
<!DOCTYPE html>
<html lang="">
<head>
<meta charset="utf-8">
<meta name="viewport">
<meta http-equiv="X-UA-Compatible" content="ie-edge">
	<title>Document</title>
</head>
<body>
	<h1>Nuevo Alumno</h1>
		<form method="POST" action="actualizar_alumno.php">
			<input type="hidden" name="id" value=""<?php echo $fila['id']?> />
			<label>Nombre</label>
			<input type="text" name="nombre" value=""<?php echo $alumnos[$fila]['nombre']?> />
			<label>Calificacion</label>
			<input type="text" name="calificacion" value=""<?php echo $alumnos[$fila]['nombre']?>/>
			<input type="submit" name="guardar" value="guardar"/>
		</form>
</body>
</html>