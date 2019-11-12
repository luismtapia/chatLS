
<?php
    include ('lynxspace.class.php');
    include('config.php');

    $id_usuario=$_SESSION['id_usuario'];
    $sitio->validar_rol(array('usuario'));

    if(isset($_POST['actualizar'])){
      $data=$_POST;
      $data['id_usuario']=$id_usuario;
      $sitio->perfil($data);
      die();
    }
    //$data= $sitio->persona('id_usuario');
    $data= $sitio->persona($id_usuario);
 ?>

<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  	<link rel="stylesheet" type="text/css" href="css/estilo.css">
  	<title>LynxSpace - Perfil</title>
  </head>
  <body>

    	<div class="container">
    	    <div class="row" id="encabezado">
    	        <div class="col-sm-3">
    	            <img src="images/LynxSpace_.png" class="img-fluid" alt="logo"/>
    	        </div>
    	 	</div>
    	</div>

    	<div class="container">
    	  <div class="row">
    	    <div class="col-sm">

    	    </div>

    	    <div class="col-sm">
    	      <h1>Perfil</h1>


    			<form method="POST" action="perfil.php" enctype="multipart/form-data">
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
                    <input type="file" class="form-control-file" name="foto_perfil" id="">
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
    					<br>

      				<button type="submit" class="btn btn-outline-success my-2 my-sm-0" name="actualizar" value="actualizar">Guardar</button>
      			</form>
    	    </div>
    	  </div>
    	</div>
  </body>
</html>
