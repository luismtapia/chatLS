<?php
	include('lynxspace.class.php');
	include('config.php');
	$sitio->validar_rol(array('Usuario','Administrador'));
	$id_usuario = $_SESSION['id_usuario'];
	$id_persona = $_SESSION['id_persona'];
	if (isset($_GET['accion'])) {
		$accion = $_GET['accion'];
		switch ($accion) {
			case 'eliminar':
				$sitio->borrarPerfil();
				header('Location: login.php');
				break;
		}
	}
	if (isset($_POST['actualizar'])) {
		$data = $_POST;
		$data['id_usuario'] = $id_usuario;
		$sitio->editar_perfil($data);
		//print_r($data);
		die();
	}
	$data = $sitio->persona($id_usuario);
	$foto=$data['foto'];
	$fecha=$data['nacimiento'];
	$anio=substr($fecha, 0, 4);
	$el_mes=substr($fecha, 5, 2);
	$dia=substr($fecha, 8, 2);
//	print_r($data);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Editar Perfil</title>
	<link rel="stylesheet" type="text/css" href="css/all.min.css">
	<link rel="stylesheet" href="css/bootstrap2.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="css/cajas.css">
</head>
<body>
	<div class="container">
		<?php include 'menu.php'; ?>
	</div>


    	<div class="cajas">
    		<div class="cajas">
    			<div class="row">
	    	    <div class="col-sm">
							</br>
							<a href="perfil.php?accion=eliminar" class="btn btn-danger">Eliminar mi cuenta</a>
							</br>
	    	    </div>

	    	    <div class="col-sm">
	    	      <h1>Perfil</h1>
	    			<form method="POST" action="editar_perfil.php" enctype="multipart/form-data">
	    				  <div class="form-row">
	    				    <div class="col">
	    				      <input type="text" class="form-control" name="nombre" placeholder="Nombre" value="<?php echo $data['nombre']; ?>">
	    				    </div>
	    				    <div class="col">
	    				      <input type="text" class="form-control" name="apellidos" placeholder="Apellidos" value="<?php echo $data['apellidos']; ?>">
	    				    </div>
	    				  </div>
	    					<br>

	    					<div class="form-row">
	    				    <div class="col-sm-6">
	    				      <input type="text" class="form-control" name="apodo" placeholder="Apodo" value="<?php echo $data['apodo']; ?>">
	    				    </div>
	    				  </div>
	    					<br>

	    				  <div class="form-row">
	    				    <div class="col">
	    				      <input type="text" class="form-control" name="email" placeholder="Correo Elentronico" value="<?php echo $data['email']; ?>">
	    				    </div>
	    				    <div class="col">
	    				      <input type="text" class="form-control" name="contrasena" placeholder="Contraseña" >
	    				    </div>
	    				  </div>
	    					<br>

	                <div class="form-row">
	    				<div class="col">
							<div class="form-group">
								<label>Foto de perfil</label>
								<input type="file" class="form-control-file" name="foto">
							</div>
	    				</div>
	    			</div>
	    			<br>

	              <div class="form-row">
	    				    <div class="col">
	    				    	<h6>Fecha de Nacimiento</h6>
	    				      	<select name="dia" id="dia">
	        							<?php
	        								for ($i = 1; $i < 32 ; $i++) {
														echo ($dia==$i) ? "<option value = '$i' selected>$i</option>":"<option value = '$i'>$i</option>";
	        									//echo "<option value = '$i'>$i</option>";
	        								}
	        							?>
	        						</select>
	        						<select name="mes">
	        							<?php
	        								foreach ($meses as $value => $mes) {
														echo ($el_mes==$value) ? "<option value='$value' selected>$mes</option>":"<option value='$value'>$mes</option>";
	        									//echo "<option value='$value'>$mes</option>";
	        								}
	        							?>
	        						</select>
	        						<select name="anio">
	        							<?php
	        								for ($i = (int)(date('Y'))-70; $i < (int)(date('Y'))-17; $i++) {
														echo ($anio==$i) ? "<option value = '$i' selected>$i</option>":"<option value = '$i'>$i</option>";
	        									//echo "<option value = '$i'>$i</option>";
	        								}
	        							?>
	        						</select>
	    				    </div>
	    				    <div class="col">
	    				    </div>
	    				  </div>
	    					<br>

	      				<button type="submit" class="btn btn-success my-2 my-sm-0" name="actualizar" value="actualizar">Guardar</button>
	      			</form>
	    	    </div>
	    	  </div>
    		</div>
    	</div>




</body>
</html>
