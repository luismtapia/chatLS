<?php
    session_start();
	class LynxSpace{
		var $conexion = null;

		function __construct(){

		}

		function conexion(){
			include('config.php');
			$this->conexion = new PDO($sgbd.':host='.$bdhost.';dbname='.$bdname, $bdusuario, $bdpassword);
		}

		function fecha($dia, $mes, $anio){
			$fecha = $anio.'-'.$mes.'-'.$dia;
			return $fecha;
		}

		function sign_in($data){
			$this->conexion($data);
			$this->conexion->beginTransaction();
			$fecha = $this->fecha($data['dia'],$data['mes'],$data['anio']);
			try{
				$sql = 'INSERT INTO usuario(email, contrasena) VALUES (:email, :contrasena)';
				$sentencia = $this->conexion->prepare($sql);
				$sentencia->bindParam(':email', $data['email']);

				$data['contrasena'] = md5($data['contrasena']);
				$sentencia->bindParam(':contrasena', $data['contrasena']);
				$sentencia->execute();

				$sql = 'SELECT * FROM usuario WHERE email = :email';
				$sentencia = $this->conexion->prepare($sql);
				$sentencia->bindParam(':email', $data['email']);
				$sentencia->execute();
				$fila = $sentencia->fetch();

				$sql = 'INSERT INTO persona(nombre, apellidos, apodo, nacimiento, id_usuario) VALUES (:nombre, :apellidos, :apodo, :nacimiento, :id_usuario)';
				$sentencia = $this->conexion->prepare($sql);
				$sentencia->bindValue(':nombre', $data['nombre']);
				$sentencia->bindValue(':apellidos', $data['apellidos']);
				$sentencia->bindValue(':apodo', $data['apodo']);
				$sentencia->bindValue(':nacimiento', $fecha);
				$sentencia->bindValue(':id_usuario', $fila['id_usuario']);
				$sentencia->execute();

                $rol = 2;
                $sql = 'INSERT INTO rol_usuario(id_rol, id_usuario) VALUES (:id_rol, :id_usuario)';
                $sentencia = $this->conexion->prepare($sql);
                $sentencia->bindValue(':id_rol', $rol);
                $sentencia->bindValue(':id_usuario', $fila['id_usuario']);
                $sentencia->execute();

				$this->conexion->commit();
				header('Location: log_in.php');
			}catch(Exception $e){
				$this->conexion->rollBack();
				header('Location: sign_in.php');
			}
		}

		function log_in($email,$contrasena){
			$this->conexion();
			$contrasena = md5($contrasena);
			$sql = 'SELECT email, contrasena, id_persona, id_usuario, apodo FROM usuario INNER JOIN persona using(id_usuario) where email = :email and contrasena = :contrasena';
			$sentencia = $this->conexion->prepare($sql);
			$sentencia->bindParam(':email', $email);
			$sentencia->bindParam(':contrasena', $contrasena);
			$sentencia->execute();
			$fila = $sentencia->fetch(PDO::FETCH_ASSOC);
			if (isset($fila['email'])) {
				$_SESSION = $fila;
				$_SESSION['validado'] = true;
				$_SESSION['roles'] = $this->rol($fila['id_usuario']);
				$_SESSION['privilegios'] = $this->privilegio($_SESSION['roles']);
				header('Location: index.php');
			}else{
				$this->log_out();
				header('Location: log_out.php?code=0');
			}
		}

		function log_out(){
			session_destroy();
			unset($_SESSION);
			$_SESSION['validado'] = false;
		}

		function validar_rol($roles_permitidos){
			$roles_usuario = $_SESSION['roles'];
			$rol_valido = false;
			foreach ($roles_usuario as $rol) {
				if (in_array($rol['rol'], $roles_permitidos)) {
					$rol_valido = true;
				}
			}
			if (!$rol_valido) {
				header('Location: log_out.php?code=1');
			}
		}

		function rol($id_usuario){
			$this->conexion();
			$sql = 'SELECT rol, id_rol FROM rol_usuario INNER JOIN rol using(id_rol) where id_usuario = :id_usuario';
			$sentencia = $this->conexion->prepare($sql);
			$sentencia->bindParam(':id_usuario', $id_usuario);
			$sentencia->execute();
			$i = 0;
			$roles = array();
			while ($fila = $sentencia->fetch(PDO::FETCH_ASSOC)) {
				$roles[$i]['rol'] = $fila['rol'];
				$roles[$i]['id_rol'] = $fila['id_rol'];
				$i++;
			}
			return $roles;
		}

		function privilegio($roles){
    		$this->conexion();
    		$sql = 'SELECT p.privilegio,p.id_privilegio FROM privilegio p inner join rol_privilegio r on p.id_privilegio = r.id_privilegio where r.id_rol = :id_rol';
   			$i = 0;
   			$privilegios = array();
    		foreach ($roles as $key => $rol) {
			    $sentencia=$this->conexion->prepare($sql);
			    $sentencia->bindValue(':id_rol',$rol['id_rol']);
			    $sentencia->execute();
			    while($fila = $sentencia->fetch(PDO::FETCH_ASSOC)){
			    	$privilegios[$i]['privilegio'] = $fila['privilegio'];
			        $privilegios[$i]['id_privilegio'] = $fila['id_privilegio'];
			        $i++;
			    }
    		}
    		return $privilegios;
  		}

  		function persona($id_usuario){
			$this->conexion();
			$sql = 'SELECT * FROM persona inner join usuario USING (id_usuario) WHERE id_usuario = :id_usuario';
			$sentencia = $this->conexion->prepare($sql);
			$sentencia->bindParam(':id_usuario', $id_usuario);
			$sentencia->execute();
			return $sentencia->fetch();
		}

		function eliminar_cuenta($id){
            $this->conexion();
            $sql = 'SELECT foto FROM persona WHERE id_usuario = :id_usuario';
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindValue(':id_usuario', $id);
            $sentencia->execute();
            $datos = $sentencia->fetch();
            $url ="upload/".$datos['foto'];
            $this->conexion->beginTransaction();
            try{
                $sql = 'DELETE FROM rol_usuario WHERE id_persona=:id_persona';
                $sentencia = $this->conexion->prepare($sql);
                $sentencia->bindValue(':id_persona', $id);
                $sentencia->execute();

                $sql = 'DELETE FROM amistad WHERE id_persona=:id_persona or id_amigo=:id_persona';
                $sentencia = $this->conexion->prepare($sql);
                $sentencia->bindValue(':id_persona', $id);
                $sentencia->execute();

                $sql = 'DELETE FROM persona WHERE id_persona=:id_persona';
                $sentencia = $this->conexion->prepare($sql);
                $sentencia->bindValue(':id_persona', $id);
                $sentencia->execute();

                $sql = 'DELETE FROM usuario WHERE id_usuario=:id_persona';
                $sentencia = $this->conexion->prepare($sql);
                $sentencia->bindValue(':id_persona', $id);
                $sentencia->execute();
                $this->conexion->commit();
                if(file_exists($url)){
                    unlink($url);
                }

            }catch(PDOException $e){
                $this->conexion->rollBack();
            }

        }

        function editar_perfil($data){
            if($_FILES['foto']['error']==0){
                $permitidos= array('image/png','image/jpeg','image/gif');
                if(in_array($_FILES['foto']['type'],$permitidos)){
                        if($_FILES['foto']['size']<=512000){
                            $tipo=explode("/",$_FILES['foto']['type']);
                            $archivo=$data['id_usuario'].'_'.md5(rand(0,1000000000)).".".$tipo[1];
                            $origen=$_FILES['foto']['tmp_name'];
                            $destino='/var/www/html/Lynx-Space/uploads/'.$archivo;
                            if(move_uploaded_file($origen,$destino)){
                                $this->conexion();
                                $this->conexion->beginTransaction();
                                $fecha=$this->fecha($data['dia'],$data['mes'],$data['anio']);
                                try {
                                    $sql="UPDATE persona
                                    SET email=:email,contrasena=:contrasena where id_usuario=:id_usuario";
                                    $sentencia=$this->conexion->prepare($sql);
                                    $contrasena=md5($data['contrasena']);
                                    $sentencia->bindParam(':email', $data['email']);
                                    $sentencia->bindParam(':contrasena',$contrasena);
                                    $sentencia->bindParam(':id_usuario',$data['id_usuario']);
                                    $sentencia->execute();

                                    $fp = fopen($destino, 'rb');
                                    $sql='UPDATE persona set nombre = :nombre, apellidos = :apellidos, nacimiento = :nacimiento, apodo = :apodo, foto = :foto, foto2=:foto2  WHERE id_usuario = :id_usuario';

                                   $sentencia=$this->conexion->prepare($sql);
                                   $sentencia->bindParam(':nombre', $data['nombre']);
                                   $sentencia->bindParam(':apellidos', $data['apellidos']);
                                   $sentencia->bindParam(':apodo', $data['apodo']);
                                   $sentencia->bindParam(':id_usuario', $data['id_usuario']);
                                   $sentencia->bindValue(':nacimiento', $fecha);
                                   $sentencia->bindParam(':foto2',$fp,PDO::PARAM_LOB);
                                   $sentencia->bindParam(':foto',$archivo);
                                   $sentencia->execute();
                                   $this->conexion->commit();
                                   header('Location: index.php');
                                } catch (Exception $e) {
                                    $this->conexion->rollback();
                                }
                            }
                            else
                                header('Location: editar_perfil.php');
                        }else header('Location: excede.php');
                }else header('Location: tipo.php');
            }else
                header('Location: administrador.php');
        }

        //ROLES Y PRIVILEGIOS
        function rol_asignado($id_usuario){
            $this->conexion();
            $sql = 'SELECT * FROM rol JOIN rol_usuario USING(id_rol) WHERE id_usuario = :id_usuario';
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(':id_usuario', $id_usuario);
            $sentencia->execute();
            echo "<ul>";
            foreach ($sentencia as $roles) {
                echo '<li>'.$roles['rol'].'</li>';
            }
            echo "</ul>";
        }

        function privilegio_asignado($id_usuario){
            $this->conexion();
            $sql = 'SELECT * FROM privilegio INNER JOIN rol_privilegio ON privilegio.id_privilegio = rol_privilegio.id_privilegio INNER JOIN rol ON rol.id_rol = rol_privilegio.id_rol INNER JOIN rol_usuario ON rol_usuario.id_rol = rol.id_rol WHERE id_usuario = :id_usuario';
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(':id_usuario', $id_usuario);
            $sentencia->execute();
            echo "<ul>";
            foreach ($sentencia as $privilegio) {
                echo '<li>'.$privilegio['privilegio'].'</li>';
            }
            echo "</ul>";
        }

        function listaRoles(){
            $this->conexion();
            $sql = 'SELECT * FROM rol';
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(':rol',$rol);
            $sentencia->execute();
            $datos = array();
            $i = 0;
            while ($fila = $sentencia->fetch()) {
                $datos[$fila["id_rol"]]["id_rol"] = $fila["id_rol"];
                $datos[$fila["id_rol"]]["rol"] = $fila["rol"];
                $i++;
            }
            return $datos;
        }

        function listaPrivilegios(){
            $this->conexion();
            $sql = 'SELECT * FROM privilegio';
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(':privilegio',$privilegio);
            $sentencia->execute();
            $datos = array();
            $i = 0;
            while ($fila = $sentencia->fetch()) {
                $datos[$fila["id_privilegio"]]["id_privilegio"] = $fila["id_privilegio"];
                $datos[$fila["id_privilegio"]]["privilegio"] = $fila["privilegio"];
                $i++;
            }
            return $datos;
        }

        function datos_rol($id_rol){
            $this->conexion();
            $sql = 'SELECT * FROM rol WHERE id_rol = :id_rol';
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(':id_rol', $id_rol);
            $sentencia->execute();
            return $sentencia->fetch();
        }

        function nuevo_rol($data){
            $this->conexion();
            $this->conexion->beginTransaction();
            try{
                $sql = 'INSERT INTO rol(rol) VALUES (:rol)';
                $sentencia = $this->conexion->prepare($sql);
                $sentencia->bindParam(':rol', $data['rol']);
                $sentencia->execute();

                $sql = 'SELECT id_rol FROM rol WHERE rol = :rol';
                $sentencia = $this->conexion->prepare($sql);
                $sentencia->bindParam(':rol', $rol);
                $sentencia->execute();
                $id = $sentencia->fetch();

                $sql = 'INSERT INTO rol_privilegio(id_rol, id_privilegio) VALUES (:id_rol, :id_privilegio)';
                $sentencia = $this->conexion->prepare($sql);
                $sentencia->bindParam(':id_rol', $id['id_rol']);
                $sentencia->bindParam(':id_privilegio', $data['id_privilegio']);
                $sentencia->execute();

                $this->conexion->commit();
                header('Location: admi_seguridad.php');
            }catch(Exception $e){
                $this->conexion->rollBack();
                header('Location: index.php');
            }
        }

        function nuevo_privilegio($data){
            $this->conexion();
            $this->conexion->beginTransaction();
            try{
                $sql = 'INSERT INTO privilegio(privilegio) VALUES (:privilegio)';
                $sentencia = $this->conexion->prepare($sql);
                $sentencia->bindParam(':privilegio', $data['privilegio']);
                $sentencia->execute();

                $sql = 'SELECT id_privilegio FROM privilegio WHERE privilegio = :privilegio';
                $sentencia = $this->conexion->prepare($sql);
                $sentencia->bindParam(':privilegio', $privilegio);
                $sentencia->execute();
                $id = $sentencia->fetch();

                $sql = 'INSERT INTO rol_privilegio(id_rol, id_privilegio) VALUES (:id_rol, :id_privilegio)';
                $sentencia = $this->conexion->prepare($sql);
                $sentencia->bindParam(':id_rol', $data['id_rol']);
                $sentencia->bindParam(':id_privilegio', $id['id_privilegio']);
                $sentencia->execute();

                $this->conexion->commit();
                header('Location: admi_seguridad.php');
            }catch(Exception $e){
                $this->conexion->rollBack();
                header('Location: index.php');
            }
        }

        function editar_rol($data){
            $this->conexion();
            $this->conexion->beginTransaction();
            try{
                $sql = 'UPDATE rol SET rol = :rol WHERE id_rol = :id_rol';
                $sentencia = $this->conexion->prepare($sql);
                $sentencia->bindParam(':rol', $data['rol']);
                $sentencia->bindParam(':id_rol', $data['id_rol']);
                $sentencia->execute();
                header('Location: admi_seguridad.php');
            }catch(Exception $e){
                $this->conexion->rollBack();
                header('Location: index.php');
            }
        }

        function borrar_rol($id_rol){
            $this->conexion();

            $sql = 'DELETE FROM rol_privilegio WHERE id_rol = :id_rol';
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(':id_rol', $id_rol);
            $sentencia->execute();

            $sql = 'DELETE FROM rol_usuario WHERE id_rol = :id_rol';
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(':id_rol', $id_rol);
            $sentencia->execute();

            $sql = 'DELETE FROM rol WHERE id_rol = :id_rol';
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(':id_rol', $id_rol);
            $sentencia->execute();
        }

        function datos_privilegio($id_privilegio){
            $this->conexion();
            $sql = 'SELECT * FROM privilegio WHERE id_privilegio = :id_privilegio';
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(':id_privilegio', $id_privilegio);
            $sentencia->execute();
            return $sentencia->fetch();
        }

        function editar_privilegio($data){
            $this->conexion();
            $this->conexion->beginTransaction();
            try{
                $sql = 'UPDATE privilegio SET privilegio = :privilegio WHERE id_privilegio = :id_privilegio';
                $sentencia = $this->conexion->prepare($sql);
                $sentencia->bindParam(':privilegio', $data['privilegio']);
                $sentencia->bindParam(':id_privilegio', $data['id_privilegio']);
                $sentencia->execute();
                header('Location: admi_seguridad.php');
            }catch(Exception $e){
                $this->conexion->rollBack();
                header('Location: index.php');
            }
        }

        function borrar_privilegio($id_privilegio){
            $this->conexion();

            $sql = 'DELETE FROM rol_privilegio WHERE id_privilegio = :id_privilegio';
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(':id_privilegio', $id_privilegio);
            $sentencia->execute();

            $sql = 'DELETE FROM privilegio WHERE id_privilegio = :id_privilegio';
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(':id_privilegio', $id_privilegio);
            $sentencia->execute();
        }

        //ROLES USUARIO
        function rol_usuario(){
            $this->conexion();
            $sql = 'SELECT * FROM rol INNER JOIN rol_usuario ON rol.id_rol = rol_usuario.id_rol INNER JOIN usuario ON rol_usuario.id_usuario = usuario.id_usuario INNER JOIN persona ON usuario.id_usuario = persona.id_usuario';
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->execute();
            $datos = array();
            $i = 0;
            while ($fila = $sentencia->fetch()) {
                $datos[$fila["id_persona"]]["nombre"] = $fila["nombre"];
                $datos[$fila["id_persona"]]["rol"] = $fila["rol"];
                $datos[$fila["id_persona"]]["id_usuario"] = $fila["id_usuario"];
                $datos[$fila["id_persona"]]["id_rol"] = $fila["id_rol"];
                $i++;
            }
            return $datos;
        }

        function editar_rol_usuario($data){
            $this->conexion();
            $this->conexion->beginTransaction();
            try{
                $sql = 'UPDATE rol_usuario SET id_rol = :id WHERE id_rol = :id_rol AND id_usuario = :id_usuario';
                $sentencia = $this->conexion->prepare($sql);
                $sentencia->bindParam(':id', $data['id']);
                $sentencia->bindParam(':id_rol', $data['id_rol']);
                $sentencia->bindParam(':id_usuario', $data['id_usuario']);
                $sentencia->execute();
                header('Location: admi_seguridad.php');
            }catch(Exception $e){
                $this->conexion->rollBack();
                header('Location: index.php');
            }
        }

        function borrar_rol_usuario($id_rol, $id_usuario){
            $this->conexion();
            $sql = 'DELETE FROM rol_usuario WHERE id_rol = :id_rol AND id_usuario = :id_usuario';
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(':id_rol', $id_rol);
            $sentencia->bindParam(':id_usuario', $id_usuario);
            $sentencia->execute();
        }

		//MENSAJES
		function mensaje($id){
            $this->conexion();
            $aux = "";
            $sql = 'SELECT * FROM mensaje inner join persona on mensaje.id_persona=persona.id_persona WHERE id_mensaje=:id_mensaje';
            $sentencia=$this->conexion->prepare($sql);
            $sentencia->bindParam(':id_mensaje', $id);
            $sentencia->execute();
            $fila=$sentencia->fetch();
            echo '
            <div class="card" style="width: 45rem;">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-12 sprite">
                      <div class="sprite_editar"></div>
                      <div class="sprite_cancelar"></div>
                  </div>
                </div>
                     <h2 class="card-title"><img src="image/tux.png" width="45" height="45"/>'.$fila['nombre'].' '.$fila['apellidos'].'</h2>
                     <h6 class="card-subtitle mb-2 text-muted">'.$fila['fecha'].'</h6>
                     <div class="row cuerpo">
                        <p class="card-text">'.$fila['mensaje'].'    </br>'.$this->pulgares($fila['id_mensaje']).'</p><br>
                        <ul class="list-group list-group-flush">';
            $this->respuesta($fila['id_mensaje']);
            echo'       </ul>
                     </div>
              </div>';
        }

        function respuesta($id){
            $mensaje=array();
            $i = 0;
            $this->conexion();
            $sql= 'SELECT * FROM mensaje inner join persona on mensaje.id_persona=persona.id_persona WHERE id_respuesta=:id_respuesta';
            $sentencia=$this->conexion->prepare($sql);
            $sentencia->bindParam(':id_respuesta', $id);
            $sentencia->execute();
            while($fila=$sentencia->fetch()){
            	echo '<li class="list-group-item">'.$fila['mensaje'].'    '.$this->pulgares($fila['id_mensaje']).'</li>';
                $this->respuesta($fila['id_mensaje']);
            }
        }

        function pulgares($id_mensaje){
	        $this->conexion();
	        $sql = 'SELECT COUNT(id_mensaje) AS numero FROM reaccion where id_mensaje=:id_mensaje';
	        $sentencia = $this->conexion->prepare($sql);
	        $sentencia->bindValue(":id_mensaje",$id_mensaje);
	        $sentencia->execute();
	        $fila=$sentencia->fetch();
	        $pulgar='           '.$fila['numero'].'  <a href="index.php?accion=reaccion&reaccion=1&id_mensaje='.$id_mensaje.'"><img src="image/like.png" width="16" height="16"></a>';

	        $sql = "SELECT  * from reaccion where id_mensaje=:id_mensaje and id_persona=:id_persona";
	        $sentencia=$this->conexion->prepare($sql);
	        $sentencia->bindValue(":id_mensaje",$id_mensaje);
	        $sentencia->bindValue(":id_persona",$_SESSION['id_usuario']);
	        $sentencia->execute();
	        $fila=$sentencia->fetch();
	        if(isset($fila['id_persona'])){
                $pulgar.='      <a href="index.php?accion=reaccion&reaccion=0&id_mensaje='.$id_mensaje.'"><img src="image/angry.png" width="16" height="16"></a>';
            }
            return $pulgar;
        }

		function reaccion($id_mensaje,$reaccion){
            switch($reaccion){
                case 1:
                    $this->conexion();
                    $sql='SELECT * FROM reaccion where id_mensaje=:id_mensaje and id_persona=:id_persona';
                    $sentencia = $this->conexion->prepare($sql);
                    $sentencia->bindValue(':id_persona', $_SESSION['id_usuario']);
                    $sentencia->bindValue(':id_mensaje', $id_mensaje);
                    $sentencia->execute();
                    $data=$sentencia->fetch();
                    if(!isset($data['id_mensaje'])){
                        $sql='INSERT into reaccion values (:id_mensaje,:id_persona)';
                        $sentencia = $this->conexion->prepare($sql);
                        $sentencia->bindValue(':id_persona', $_SESSION['id_usuario']);
                        $sentencia->bindValue(':id_mensaje', $id_mensaje);
                        $sentencia->execute();
                    }
                break;
                case 0:
                    default:
                        $sql='DELETE from reaccion where id_persona=:id_persona and id_mensaje=:id_mensaje';
                        $sentencia = $this->conexion->prepare($sql);
                        $sentencia->bindValue(':id_persona', $_SESSION['id_usuario']);
                        $sentencia->bindValue(':id_mensaje', $id_mensaje);
                        $sentencia->execute();
                break;
            }
        }

        function indice(){
           $i=0;
           $mensaje=array();
           $this->conexion();
           $sql="SELECT id_mensaje, fecha FROM mensaje WHERE (id_respuesta is null AND id_persona in (SELECT id_amigo AS id_persona FROM amistad JOIN persona ON amistad.id_amigo=persona.id_persona JOIN usuario ON persona.id_usuario = usuario.id_usuario WHERE amistad.id_persona=:id_persona UNION select amistad.id_persona FROM amistad    JOIN persona p on amistad.id_persona = p.id_persona JOIN usuario u on p.id_usuario = u.id_usuario WHERE amistad.id_amigo=:id_persona)) OR (id_persona=:id_persona and id_respuesta is null)ORDER BY fecha DESC";
            $sentencia=$this->conexion->prepare($sql);
            $sentencia->bindParam(":id_persona",$_SESSION['id_usuario']);
            $sentencia->execute();
            while($fila=$sentencia->fetch(PDO::FETCH_ASSOC)){
                $mensaje[$i]=$fila['id_mensaje'];
                $i++;
            }
            return $mensaje;
        }

        function publicar($data){
            $this->conexion();
            $sql = 'INSERT INTO mensaje (id_persona,mensaje,fecha) VALUES (:id_persona,:mensaje,now())';
            $sentencia=$this->conexion->prepare($sql);
            $sentencia->bindParam(':mensaje', $data['mensaje']);
            $sentencia->bindParam(':id_persona',$_SESSION['id_usuario']);
            $sentencia->execute();
            header('Location: index.php');
        }

        //AMIGOS
        function amigos($id_persona){
            $this->conexion();
            $amigos=array();
            $sql = 'SELECT p.foto, a.id_amigo AS id_persona,p.nombre, p.apellidos, p.apodo,u.email FROM amistad a INNER JOIN persona p on a.id_amigo=p.id_persona INNER JOIN usuario u ON p.id_usuario=u.id_usuario WHERE a.id_persona=:id_persona UNION SELECT p.foto,a.id_persona,p.nombre,p.apellidos, p.apodo,u.email FROM amistad a INNER JOIN persona p ON a.id_persona=p.id_persona INNER JOIN usuario u ON p.id_usuario=u.id_usuario WHERE a.id_amigo=:id_persona order by 3;';
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(':id_persona', $id_persona);
            $sentencia->execute();
            $i=0;
            while($fila=$sentencia->fetch(PDO::FETCH_ASSOC)){
                $amigos[$i]=$fila;
                $i++;
            }
            return $amigos;
        }

		function sugerencias($id_persona){
            $this->conexion();
            $amigos=array();
            $sql = "SELECT p.id_persona,p.nombre, p.apellidos,u.email,p.foto,p.apodo,foobarfoo.amigos FROM (SELECT id_persona, count(id_persona) AS 'amigos' FROM (SELECT id_persona FROM (SELECT id_persona FROM (SELECT id_persona FROM amistad where id_amigo IN (SELECT id_persona FROM persona WHERE id_persona IN (SELECT id_amigo FROM  amistad WHERE amistad.id_persona = :id_persona UNION ALL SELECT amistad.id_persona FROM amistad WHERE id_amigo = :id_persona)) UNION ALL SELECT id_amigo FROM amistad WHERE id_persona IN (SELECT id_persona FROM persona WHERE id_persona IN (SELECT id_amigo FROM amistad WHERE amistad.id_persona = :id_persona UNION ALL SELECT amistad.id_persona FROM amistad WHERE id_amigo = :id_persona))) foo WHERE id_persona != :id_persona) bar WHERE id_persona not IN (SELECT id_amigo FROM amistad WHERE amistad.id_persona = :id_persona UNION ALL SELECT amistad.id_persona FROM amistad WHERE  id_amigo = :id_persona)) foobar GROUP BY 1 ORDER BY 2 DESC) foobarfoo JOIN persona p ON foobarfoo.id_persona = p.id_persona JOIN usuario u ON p.id_usuario = u.id_usuario ORDER BY amigos DESC LIMIT 10;";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(':id_persona', $id_persona);
            $sentencia->execute();
            $i=0;
            while($fila=$sentencia->fetch()){
                $amigos[$fila["id_persona"]] = $fila;
            }
            return $amigos;

        }

        function eliminar_amigo($id_amigo){
            $this->conexion();
            $sql = 'DELETE FROM amistad WHERE id_persona=:id_persona AND id_amigo=:id_amigo OR id_persona=:id_amigo AND id_amigo=:id_persona';
            $sentencia=$this->conexion->prepare($sql);
            $sentencia->bindParam(":id_persona",$_SESSION['id_usuario']);
            $sentencia->bindParam(":id_amigo",$id_amigo);
            $sentencia->execute();
        }

        function agregarAmigo($id_amigo){
            $this->conexion();
            $this->conexion->beginTransaction();
            try {
               $sql = 'INSERT INTO amistad (id_persona,id_amigo,fecha) VALUES(:id_persona,:id_amigo,now())';
               $sentencia=$this->conexion->prepare($sql);
               $sentencia->bindParam(":id_persona",$_SESSION['id_usuario']);
               $sentencia->bindParam(":id_amigo",$id_amigo);
               $sentencia->execute();
               $this->conexion->commit();
            }
            catch (Exception $e) {
                $this->conexion->rollBack();
            }
        }
//
        function addPersonaFromJSON($data){
            $this->conexion();
            $sql='INSERT INTO usuario VALUES(null, :email, :contrasena)';
            $sentencia=$this->conexion->prepare($sql);
            $sentencia->bindParam(":email",$data->email);
            $sentencia->bindParam(":contrasena",$data->contasena);
            $sentencia->execute();

            $sql= 'INSERT INTO persona VALUES(null, null, :nombre, :apellido, :apodo, :nacimiento, :foto2)';
            $sentencia=$this->conexion->prepare($sql);
            $sentencia->bindParam(":nombre",$data->email);
            $sentencia->bindParam(":contrasena",$data->contasena);
            $sentencia->execute();
        }

//
	}

	$sitio = new LynxSpace;
?>
