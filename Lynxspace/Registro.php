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

	<select name="dia" id="dia">
	<?php
		for ($i=1; $i<32 ; $i++) {
			echo "<option value=''$i'>$i</option>";
		}
	 ?>
 </select>
 <select name="mes" id="mes">
 		<?php
			foreach ($meses as $value=>$mes) {
				echo "<option value='$value'>$mes</option>";
			}
		 ?>
 </select>
 <select name="anio" id="anio">
 		<?php
			for ($i=(int)(date('Y'))-70; $i < (int)(date('Y'))-17; $i++) {
				 echo "<option value='$i'>$i</option>";
			}
		 ?>
 </select>
	<input type="submit" name="registrar" placeholder="Registrar">
</form>

</body>
</html>
