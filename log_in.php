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
					<link rel="stylesheet" href="css/login.css">
		    	<link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
	<title>Iniciar sesion</title>
</head>

<body>
    <div class="caja">
      <form class="" action="log_in.php" method="post" >
        <div class="iniciar_sesion">
					<h3 class="form-titulo" id="iniciar_sesion">Iniciar sesion</h3>
      		<div class="form-cuerpo">
      			<input type="text" name="email" class="input" placeholder="Correo" title=""/>
      			<input type="password" name="contrasena" class="input" placeholder="Contraseña" />
      		</div>
      	</div>
        <div class="centrado">
          <button type="submit" name="enviar" class="boton">Iniciar sesion</button>
        </div>

        <div class="animacion1">
          <h5 class="logo">
		<a href="#">
			<img src="image/Logo.png" alt="Lynxspace">
		</a>
	  </h5>
        </div>
        <div class="botonera">
            <a class="iconos" href="sign_in.php">Registrate <span class="fa fa-arrow-circle-right"></span> </a>
        </div>
      </form>
    </div>
  </body>
</html>
