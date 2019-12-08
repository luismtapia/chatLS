<?php
	include("lynxspace.class.php");
	$sitio->validar_rol(array('Usuario','Administrador'));
	$id_usuario=$_SESSION['id_usuario'];
	$data=$sitio->persona($id_usuario);
	$foto=$data['foto'];
?>
<html>
<head>
	<title>Seguridad</title>
	<link rel="stylesheet" href="css/bootstrap2.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="css/cajas.css">
</head>
<body>
	<div class="container" >
		<?php include 'menu.php'; ?>
	</div>
	<div class="cajas">
			<div class="cajas">
				<div class="row">
					<div class="col-sm-4"></div>
					<div class="col-sm-4" align="center">
						<h1>Seguridad</h1>
					</div>
					<div class="col-sm-4"></div>
					<br>
				</div>
				<br><br>
				<div class="row">
					<div class="col-sm-1"></div>
					<div class="col-sm-5">
						<label>Roles:</label>
						</br>
								<?php
				    				$sitio->rol_asignado($id_usuario);
				        ?>
				        <br>
					</div>
					<div class="col-sm-1"></div>
					<div class="col-sm-5">
				        <label>Privilegios:</label>
				        </br>
						<?php
				    		$sitio->privilegio_asignado($id_usuario);
				        ?>
					</div>
					<div class="col-sm-2"></div>
				</div>
			</div>
		</div>
</body>
</html>
