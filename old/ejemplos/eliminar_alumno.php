<?php
$mysqli = new mysqli('localhost', 'nair', '1234', 'alumnos');
$id=$_GET['id'];
$mysqli->query("DELETE from alumnos where id=$id");
header('Location: alumnos.php');
?>
