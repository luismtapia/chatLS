<?php
	include('lynxspace.class.php');
    $sitio->validar_rol(array('Administrador'));
    $id_usuario=$_SESSION['id_usuario'];
    $datos = $sitio->persona($id_usuario);
    $foto = $datos['foto']; 

    if (isset($_POST['nuevo_privilegio'])) {
      $data = $_POST;
      $sitio->nuevo_privilegio($data);
      die();
    } 
?>
<html>
<head>
    <title>Lynx-Space | Nuevo Rol</title>
    <link rel="stylesheet" type="text/css" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap2.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://www.clubdesign.at/floatlabels.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #008080;">
                    <a href="index.php"><img src="image/Logo.png" width="70" height="50" style="margin-left: 30px;"></a>
                    <div class="collapse navbar-collapse" id="navbarColor01" style="margin-right: 90px;">
                        <ul class="navbar-nav ml-auto" style="font-size: 17px;">
                            <li class="nav-item active">
                                <a class="nav-link" href="index.php">
                                <?php
                                if (is_null($datos['foto'])) {
                                    echo "<img src='uploads/default.png' height='30' width='30' class='rounded-circle'>";
                                }else{
                                    echo "<img src='uploads/$foto' height='30' width='30' class='rounded-circle'>";
                                }
                                ?>
                                <?php echo $datos['nombre']." ".$datos['apellidos']." (".$datos['apodo'].")"; ?>
                                </a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="index.php">Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="amigos.php">Amigos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="sugerencias.php">Sugerencias</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">+ Opciones
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="editar_perfil.php">Editar Perfil</a>
                                    <a class="dropdown-item" href="seguridad.php">Roles y Privilegios</a>
                                    <a class="dropdown-item" href="admi_seguridad.php">Administrador</a>
                                    <a class="dropdown-item" href="log_out.php">Salir</a>
                                </div>
                            </li>
                        </ul> 
                    </div>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <h1>Nuevo Rol</h1>
                <form method="POST" action="nuevo_privilegio.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Privilegio</label>
                        <input type="text" class="form-control" placeholder="Descripcion del privilegio" name="privilegio">
                    </div>
                    <div class="form-group">
                        <label>ID Rol</label>
                        <input type="number" class="form-control" placeholder="ID del rol" name="id_rol">
                    </div>
                    <input type="submit" name="nuevo_privilegio" value="Agregar" class="btn btn-primary btn-lg btn-block"/>
                </form>
            	</br>
            	<h2>Lista de roles existentes</h2>
				<?php
                    $roles = $sitio->listaRoles();
                    echo "<table class='table'>";
                    echo "<thead class='thead-dark'>";
                    echo "<tr>";
                    echo "<th>ID</th>";
                    echo "<th>Rol</th>";
                   	echo "</tr>";
                    foreach($roles as $clave => $rol){
                        echo "<tr>";
                        echo "<td>".$rol['id_rol']."</td>";
                        echo "<td>".$rol['rol']."</td>";
                        echo "</tr>";        
                    }
                    echo "</table>";
                ?>  
                </br>
                </br>
            </div>
        </div>
    </div>
</body>
</html>
