<?php
//error_reporting(0);
session_start();
//include('config.php');
	class LynxSpace{
		var $conexion = null;
		function __construct(){

		}

		function conexion(){
			include('config.php');
			$this->conexion = new PDO($sgbd.':host='.$bdhost.';dbname='.$bdname, $bdusuario, $bdcontrasena);
		}

		function registro($data){
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
				$this->conexion->commit();
			}catch(Exception $e){
				$this->conexion->rollBack();
			}
		}

		function fecha($dia, $mes, $anio){
			$fecha = $anio.'-'.$mes.'-'.$dia;
			return $fecha;
		}

		function mensaje($id){
			$this->conexion();
			$sql = 'SELECT id_mensaje,apodo,id_usuario FROM mensaje INNER JOIN persona ON mensaje.id_persona  WHERE id_mensaje=:id_mensaje';
			$sentencia = $this->conexion->prepare($sql);
			$sentencia->bindParam(':id_mensaje',$id);
			$sentencia->execute();
			$fila = $sentencia->fetch();
			print_r($fila);
			$this->mensaje($fila['id_mensaje']);
		}

		function respuesta($id){
			$this->conexion();
			$sql = 'SELECT * FROM mensaje INNER JOIN persona ON mensaje.id_persona  WHERE id_respuesta=:id_respuesta';
			$sentencia = $this->conexion->prepare($sql);
			$sentencia->bindParam(':id_respuesta',$id);
			$sentencia->execute();

			while($fila = $sentencia->fetch()){;
				$this->respuesta($fila['id_mensaje']);
				print_r($fila);
			}
		}

		function persona($id_usuario){
			$this->conexion();
			$sql = 'SELECT * FROM persona inner join usuario USING (id_usuario) WHERE id_usuario = :id_usuario';
			$sentencia = $this->conexion->prepare($sql);
			$sentencia->bindParam(':id_usuario', $id_usuario);
			$sentencia->execute();

			return $sentencia->fetch();
		}

		function foto_perfil($id_usuario){
			$this->conexion();
			$sql ='SELECT * FROM persona WHERE id_persona=:id_persona AND foto2=is not null';
			$sentencia = $this->conexion->prepare($sql);
			$sentencia->bindParam(':id_persona', $id_persona);
			//Regresa un objeto
			$sentencia->execute();
			//$fila=$sentencia->fetch(\PDO::FETCH);
			$fila=$sentencia->fetch();
			header("Content-type: image/png");
			if(isset($fila['id_persona'])){
				echo $fila['foto2'];
			}else{
				$imagen=imagecreatefrompng('uploads/no_foto.png');
				imagepng($imagen);
				imagedestroy($imagen);

			}

			//return $fila['foto2'];

		}

		function login($email,$contrasena){
			$contrasena=md5($contrasena);
			$this->conexion();

			$sql = 'SELECT email, id_persona, usuario.id_usuario, apodo
			FROM usuario INNER JOIN persona using(id_usuario)
			WHERE email=:email and contrasena=:contrasena';
			$sentencia = $this->conexion->prepare($sql);
			$sentencia->bindParam('email', $email);
			$sentencia->bindParam('contrasena', $contrasena);
			$sentencia->execute();
			$fila=$sentencia->fetch(PDO::FETCH_ASSOC);//siempre con el select va un fetch $fila es un arreglo

			if(isset($fila['email'])){
				$_SESSION=$fila;
				$_SESSION['validado']=true;
				$_SESSION['roles']=$this->rol($fila['id_usuario']);
				$_SESSION['privilegios']=$this->privilegios($_SESSION['roles']);
				header('Location:index.php');
			}else{
				$this->logout();
				header('Location:logout.php?code=0');
			}
		}

		function logout(){
			session_destroy();
			unset($_SESSION);
			$_SESSION['validado']=false;
		}

		function rol($id_usuario){
				$this->conexion();
				$sql='SELECT rol, id_rol FROM rol INNER JOIN rol_usuario using (id_rol) WHERE id_usuario=:id_usuario';
				$sentencia = $this->conexion->prepare($sql);
				$sentencia->bindParam(':id_usuario', $id_usuario);
				$sentencia->execute();
				$i=0;
				$roles=array();
				while($fila = $sentencia->fetch(PDO::FETCH_ASSOC)){
						$roles[$i]['rol'] = $fila['rol'];
						$roles[$i]['id'] = $fila['id_rol'];
						$i++;
				}
				return $roles;
		}

		function 	validar_rol($roles_permitidos){
			$roles_usuario = $_SESSION['roles'];
			$rol_valido=false;
			foreach ($roles_usuario as $rol) {
				if(in_array($rol['rol'],$roles_permitidos)){
					$rol_valido=true;
				}
			}
				if (!$rol_valido) {
					//print_r($roles_usuario);
					header('Location: logout.php?code=1');
				}
		}

		function privilegios($roles){
			$this->conexion();
			$sql = 'SELECT p.privilegio FROM privilegio p INNER JOIN rol_privilegio r on p.id_rol = r.id_rol
			WHERE r.id_rol=:id_rol';
			$i=0;
			$privilegios=array();
			foreach ($roles as $key => $rol) {
			$sentencia = $this->conexion->prepare($sql);
			$sentencia->bindParam('id_rol', $rol['id_rol']);
			$sentencia->execute();
			while ($fila=$sentencia->fetch(PDO::FETCH_ASSOC)) {
			$privilegios[$i]['privilegio']=$fila['privilegio'];
			$privilegios[$i]['id_privilegio']=$fila['id_privilegio'];
				$i++;
			}
			}

		}

		function perfil($data){
			//print_r($_FILES);
			$fecha = $this->fecha($data['dia'],$data['mes'],$data['anio']);
			if ($_FILES['foto_perfil']['error'] == 0) {
	        $permitidos=array('image/png','image/jpeg','image/gif' );
	        if(in_array($_FILES['foto_perfil']['type'],$permitidos)){
	            if ($_FILES['foto_perfil']['size'] < 512000) {
	                $tipo=explode('/',$_FILES['foto_perfil']['type']);
	                $archivo=$data['id_usuario'].'_'.md5(rand(0,10000000)).'.'.$tipo[1];
	                $origen=$_FILES['foto_perfil']['tmp_name'];
	                $destino='/var/www/html/github/treze/chatLS/Lynxspace/uploads/'.$archivo;
	                if (move_uploaded_file($origen,$destino)) {

	                  $this->conexion();
	                  $this->conexion->beginTransaction();

	                  try {
	                    $sql='UPDATE usuario set email=:email, contrasena=:contrasena
	                    where id_usuario=:id_usuario';
	                    $contrasena=md5($data['contrasena']);
	                    $sentencia=$this->conexion->prepare($sql);
	                    $sentencia -> bindParam(':email', $data['email']);
	                    $sentencia -> bindParam(':contrasena',$contrasena);
	                    $sentencia -> bindParam(':id_usuario',$data['id_usuario']);
	                    $sentencia->execute();

											$fp = fopen($destino,'rb');
											//$fp = pg_escape_bytes(addslashes(file))

	                    $sql='UPDATE persona set nombre=:nombre,apellidos=:apellidos,apodo=:apodo,nacimiento=:nacimiento,
											foto=:foto, foto2=:foto2
	                    where id_usuario=:id_usuario';
	                    $sentencia=$this->conexion->prepare($sql);
											$sentencia->bindParam(':nombre', $data['nombre']);
											$sentencia->bindParam(':apellidos', $data['apellidos']);
											$sentencia->bindParam(':apodo', $data['apodo']);
											$sentencia->bindParam(':nacimiento', $fecha);
											$sentencia->bindParam(':foto', $archivo);
											$sentencia->bindParam(':foto2', $fp, PDO::PARAM_LOB);
											$sentencia->bindParam(':id_usuario', $data['id_usuario']);
	                    $sentencia->execute();
	                    $this->conexion->commit();
											echo "Exito";
	                  } catch (Exception $e) {
	                    $this->conexion->rollBack();
	                  }
	                }else {
	                  echo "fracaso";
	                }
	            }else {
	              die('excede tamaño');
	            }

	        }else {
	          die(':(');
	        }
	    }else {
	      die('contacte al administrador');
	    }
		}

		function amigos($id_persona) {
				$this->conexion();
				$sql='SELECT id_amigo AS id_persona, email, nombre, apodo, foto FROM amistad
				JOIN persona ON amistad.id_amigo=persona.id_persona
				JOIN usuario ON persona.id_usuario = usuario.id_usuario
				WHERE amistad.id_persona=:id_persona
				UNION
				select amistad.id_persona, email, nombre, apodo, foto FROM amistad
				JOIN persona p on amistad.id_persona = p.id_persona
				JOIN usuario u on p.id_usuario = u.id_usuario
				WHERE amistad.id_amigo=:id_persona
				ORDER BY 3 ASC';
				$sentencia = $this->conn->prepare($sql);
				$sentencia->bindParam(':id_persona',$id_persona);
				$sentencia->execute();
				$i=0;
				$amigos=array();
				while($fila = $sentencia->fetch(PDO::FETCH_ASSOC)) {
						$amigos[$i]= $fila;
						$i++;
				}
				return $amigos;
		}

	}
	$sitio = new LynxSpace;
?>
