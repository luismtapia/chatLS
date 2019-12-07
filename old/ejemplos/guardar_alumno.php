<?php
	echo $_POST['nombre'];
	echo $_POST['calificacion'];
	$linea=$_POST['nombre']."|".$_POST['calificacion'];
	//AQUI DEBO ALMACENAR LA LINEA EN MI ARCHIVO alumnos.txt
	$myfile = fopen("alumnos.txt", "a+") or die("No se puede acceder al archivo!");
	fwrite($myfile, $linea);
	fclose($myfile);
?>

<div class="">
		<h1>DATOS INSERTADOS</h1>
		<a href="alumnos.php">REGRESAR</a>
</div>
