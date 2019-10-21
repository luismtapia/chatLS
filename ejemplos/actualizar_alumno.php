<?php
$id=$_POST['id'];
$nombre=$_POST['nombre'];
$calificacion=$_POST['calificacion'];
$mysqli = new mysqli('localhost', 'nair', '1234', 'alumnos');
$mysqli->query("UPDATE alumnos SET nombre='$nombre', calificacion=$calificacion WHERE id='$id'");
header('Location: alumnos.php');
?>