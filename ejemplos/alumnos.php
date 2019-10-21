<?php
//LECTURA DEL ARCHIVO DE DATOS

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

echo "<table style='display: flex; justify-content: center;'>";
echo "<tr>";
echo "<th>ALUMNO</th>";
echo "<th>CALIFICACION</th>";
echo "</tr>";
foreach ($alumnos as $alumno) {
	echo "<tr>";
	if (!is_numeric($alumno['calificacion'])){
		$alumno['calificacion']=0;
	}

	if ($alumno['calificacion'] >= $colores['reprobado']['minimo'] && $alumno['calificacion'] <= $colores['reprobado']['maximo']){
		echo "<td>"."<font color='red'>".$alumno['nombre']."</font>"."</td>"."<td align='right'>"."<font color='red'>".$alumno['calificacion']."</td>"."</font>"."<br>";
	}

	if($alumno['calificacion'] >= $colores['regular']['minimo'] && $alumno['calificacion'] <= $colores['regular']['maximo']  ){
		echo "<td>"."<font color='orange'>".$alumno['nombre']."</font>"."</td>"."<td align='right'>"."<font color='orange'>".$alumno['calificacion']."</td>"."</font>"."<br>";
	}

	if($alumno['calificacion'] >= $colores['aprobado']['minimo'] && $alumno['calificacion'] <= $colores['aprobado']['maximo']){
		echo "<td>"."<font color='green'>".$alumno['nombre']."</font>"."</td>"."<td align='right'>"."<font color='green'>".$alumno['calificacion']."</td>"."</font>"."<br>";
	}
	for ($i=0; $i <sizeof($alumno) ; $i++) {
		$promedio=$promedio+$alumno['calificacion'];
		$tam=$tam+1;
	}
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
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
