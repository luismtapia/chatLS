<?php
class lynxspace{
	var $conexion = null;
	function __construct(){

	}
	function conexion(){
		$this->conexion = new PDO('mysql:host=localhost;dbname=lynxspace','master','1234');
		
	}
	function registro($data){
		$this->conexion();
		foreach ($this->conexion->query('SELECT * FROM usuario') as $fila) {
			print_r($fila);
		}
		
	}
}
$sitio = new lynxspace;
?>