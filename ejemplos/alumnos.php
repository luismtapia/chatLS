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

<?php
//CONSULTA DE LA INFORMACION DE MysqlndUhConnection
$mysqli = new mysqli('localhost', 'nair', '1234', 'alumnos');
	$resultado = $mysqli->query("select * from alumnos");
	while ($fila = $resultado->fetch_assoc()) {
		$alumnos[$fila['id']]['nombre'] = $fila['nombre'];
		$alumnos[$fila['id']]['calificacion'] = $fila['calificacion'];
	}
//AQUI VA MI NAVBAR DIJE AQUI
echo '
<div class="navbar">
	<a class="btn btn-success" href="nuevo_alumno.html" role="button">Nuevo</a>
	<a class="btn btn-success" href="alumnos.txt" role="button">Ver txt</a>
</div>';

//NO MOVER NADA APARTIR DE ESTA LINEA

$promedio=0;
$tam=0;

$colores['reprobado']['minimo']=0;
$colores['reprobado']['maximo']=69;
$colores['reprobado']['color']="red";
$colores['regular']['minimo']=70;
$colores['regular']['maximo']=84.55;
$colores['regular']['color']="orange";
$colores['aprobado']['minimo']=85;
$colores['aprobado']['maximo']=100;
$colores['aprobado']['color']="green";
echo"<h1>Listado de Calificaciones</h1>"
echo "<table style='display: flex; justify-content: center;'>";
echo "<tr>";
echo "<th>ALUMNO</th>";
echo "<th>CALIFICACION</th>";
echo "</tr>";
foreach ($alumnos as $id => $alumno) {
	echo "<tr>";

	if (!is_numeric($alumno['calificacion'])){
		$alumno['calificacion']=0;
	}

	if ($alumno['calificacion'] >= $colores['reprobado']['minimo'] && $alumno['calificacion'] <= $colores['reprobado']['maximo']){
		echo "<td>"."<font color='red'>".$alumno['nombre']."</font>"."</td>"."<td>"."<font color='red'>".$alumno['calificacion']."</td>"."</font>"."<br>";
	}

	if($alumno['calificacion'] >= $colores['regular']['minimo'] && $alumno['calificacion'] <= $colores['regular']['maximo']  ){
		echo "<td>"."<font color='orange'>".$alumno['nombre']."</font>"."</td>"."<td>"."<font color='orange'>".$alumno['calificacion']."</td>"."</font>"."<br>";
	}

	if($alumno['calificacion'] >= $colores['aprobado']['minimo'] && $alumno['calificacion'] <= $colores['aprobado']['maximo']){
		echo "<td>"."<font color='green'>".$alumno['nombre']."</font>"."</td>"."<td>"."<font color='green'>".$alumno['calificacion']."</td>"."</font>"."<br>";
	}
	for ($i=0; $i <sizeof($alumno) ; $i++) {
		$promedio=$promedio+$alumno['calificacion'];
		$tam=$tam+1;
	}
echo "<td><a href='editar_alumno.php?id=$id'><img src='edit.png'/></a></td>";
echo "<td><a href='eliminar_alumno.php?id=$id'><img src='trash.png'/></a></td>";
echo "</tr>";
}
echo "</table>";
	$promedio=$promedio/$tam;

	if($promedio>=0 && $promedio<=69){
		echo "El promedio es: <font color='red'>".$promedio."</font>"."<br>";
	}

	if($promedio>=70 && $promedio<=84.99){
		echo "El promedio es: <font color='orange'>".$promedio."</font>"."<br>";
	}

	if($promedio>=85 && $promedio<=100){
		echo "El promedio es: <font color='green'>".$promedio."</font>"."<br>";
	}
</body>
</html>
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
