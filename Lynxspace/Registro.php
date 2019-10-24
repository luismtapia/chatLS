<?php
	include('lynxspace.class.php');
	include('config.php');
	if (isset($_POST['registrar'])) {
		$data = $_POST;
		$sitio->registro($data);
		die();
	}
?>
<!DOCTYPE html>
<html >
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" type="text/css" href="../css/estilo.css">
	<title>LynxSpace - Registrarse</title>
</head>
<body>

<div class="container">
    <div class="row" id="encabezado">
        <div class="col-sm-3">
            <img src="../image/LynxSpace_.png" class="img-fluid" alt="logo"/>
        </div>
 	</div>
</div>

<div class="container">
  <div class="row">
    <div class="col-sm">
      
    </div>

    <div class="col-sm">
      <h1>Abre una Cuenta</h1>
	  <h3>Es rápido y fácil</h3>
		<form method="POST" action="Registro.php">
			<form>
			  <div class="form-row">
			    <div class="col">
			      <input type="text" class="form-control" name="nombre" placeholder="Nombre">
			    </div>
			    <div class="col">
			      <input type="text" class="form-control" name="apellidos" placeholder="Apellidos">
			    </div>
			  </div>
			</form><br>
			<form>
			  <div class="form-row">
			    <div class="col">
			      <input type="text" class="form-control" name="correo_electronico" placeholder="Correo Elentronico">
			    </div>
			    <div class="col">
			      <input type="text" class="form-control" name="contrasena" placeholder="Contraseña">
			    </div>
			  </div>
			</form><br>
		    <form>
			  <div class="form-row">
			    <div class="col">
			    	<h6>Fecha de Nacimiento</h6>
			      	<select name="dia" id="dia">
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
			    </div>
			     <div class="col">
			    </div>
			  </div>
			</form><br>
			<button type="submit" class="btn btn-outline-success my-2 my-sm-0" name="registrar" value="Registrarse">Registrarte</button>
		</form>
    </div>
  </div>
</div>
</body>
</html>