<?php
include ('config.php');
class lynxspace{
	var $conn = null;
	function __construct(){

	}
	function conexion(){
		include ('config.php');
		$this->conn = new PDO($sgbd.':host='.$bdhost.';dbname='.$bdbase,$bdusuario,$bdcontrasena);

	}
	function registro($data){
		$this->conexion();
	  $this->conn->beginTransaction();

		$fecha=$this->fecha($data['dia'],$data['mes'],$data['anio']);
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
							$sentencia = $this->conn->prepare($sql);
							$sentencia->bindValue(':nombre', $data['nombre']);
							$sentencia->bindValue(':apellidos', $data['apellidos']);
							$sentencia->bindValue(':apodo', $data['nombre']);
							$sentencia->bindValue(':id_usuario', $fila['id_usuario']);
							$sentencia->bindValue(':nacimiento', $fecha);
							$sentencia->execute();
							$this->conn->commit();
		} catch (Exception $e) {
			 	$this->conn->rollBack();
		}
	}
	function fecha($dia, $mes, $anio){
		$fecha=$anio.'-'.$mes.'-'.$dia;
		return $fecha;
	}
}
$sitio = new lynxspace;
?>
