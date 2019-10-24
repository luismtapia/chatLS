<?php
class lynxspace{
	var $conn = null;
	function __construct(){

	}
	function conexion(){
		$this->conn = new PDO('mysql:host=localhost;dbname=lynxspace','master','1234');

	}
	function registro($data){
		$this->conexion();
	  $this->conn->beginTransaction();
				try {
						  $sql = ' INSERT INTO usuario (email, contrasena) VALUES (:email,:contrasena)';
							$sentencia = $this->conn->prepare($sql);
							$sentencia->bindParam(':email', $data['email']);
							$data['contrasena']=md5($data['contasena']);
							$sentencia->bindParam(':contrasena', $data['contrasena']);
							$sentencia->execute();
							$sql = 'SELECT id_usuario FROM usuario WHERE email = :email';
							$sentencia = $this->conn->prepare($sql);
							$sentencia->bindParam(':email', $data['email']);
							$sentencia->execute();
              $fila = $sentencia->fetch();
							$sql = ' INSERT INTO persona (nombre, apellidos, apodo, id_usuario, nacimiento) VALUES (:nombre,:apellidos,:apodo,:id_usuario,:nacimiento)';
							$sentencia->bindParam(':nombre', $data['nombre']);
							$sentencia->bindParam(':apellidos', $data['apellidos']);
							$sentencia->bindParam(':apodo', $data['apodo']);
							$sentencia->bindParam(':id_usuario', $data['id_usuario']);
							$sentencia->bindParam(':nacimiento', $data['nacimiento']);
							$this->conn->commit();
		} catch (Exception $e) {
			 	$this->conn->rollBack();
		}
	}
}
$sitio = new lynxspace;
?>
