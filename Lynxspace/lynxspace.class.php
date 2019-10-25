<?php
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
				$sentencia->bindValue(':apodo', $data['nombre']);
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
	}
	$sitio = new LynxSpace;
?>
