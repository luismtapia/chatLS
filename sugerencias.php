<?php
	include("lynxspace.class.php");
	$sitio->validar_rol(array('Usuario','Administrador'));
	$id_usuario=$_SESSION['id_usuario'];
	$data=$sitio->persona($id_usuario);
	$foto=$data['foto'];

	if(isset($_GET['accion'])){
        $accion=$_GET['accion'];
        switch($accion){
        	case 'agregar':
                $sitio->agregarAmigo($_GET['id_persona']);
            break;
            default:
            break;
         }
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sugerencias</title>
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
	<div class="cajas2">
		<div class="cajas2">
			<div class="row">
				<div class="col-sm-4"></div>
				<div class="col-sm-4" align="center">
					<h1>Sugerencias</h1>
					<br>
				</div>
				<div class="col-sm-4"></div>
			</div>
			<div class="row">
				<div class="col-sm-2"></div>
				<div class="col-sm-8">
					<?php  
			    		$sugerencias=$sitio->sugerencias($_SESSION['id_usuario']);
	                	foreach($sugerencias as $list=>$lista){
	                    	if($lista['foto'])
	                    		$archivo=$lista['foto'];
	                  		else
	                    		$archivo="default.png";
	                    	echo'<div class="shadow p-3 mb-5 bg-white rounded"  style="width: 18rem;">
	                    			<div class="card" >
	                    				<div class="card-body">
		                            		<div class="row">
				                                <div class="col-sm-6">
				                                    <h4 class="card-title">'.$lista['nombre'].' '.$lista['apellidos'].'</h4></br>
				                                    <h5 class="card-title">'.$lista['apodo'].'</h5>
				                                </div>
				                                <div class="col-sm-6">
				                                    <img class="rounded-circle" src="uploads/'.$archivo.'" width="90px" width="90px"/>
				                                </div>
		                            		</div>
				                            <div class="row">
				                                <div class="col-sm-12">
				                                    <a href="sugerencias.php?accion=agregar&id_persona='.$lista['id_persona'].'" class="btn btn-primary btn-lg btn-block">Agregar</a>
				                                </div>
				                            </div> 
		                        		</div>
		                    		</div>
		                		</div>';
		                 }
			        ?>    
				</div>
				<div class="col-sm-2"></div>
			</div>
		</div>
	</div>
</body>
</html>