<?php
	include('lynxspace.class.php');
	$id_rol = $_GET['id_rol'];
	$id_usuario = $_GET['id_usuario'];
	$sitio->borrar_rol_usuario($id_rol, $id_usuario);
	header("Location: admi_seguridad.php")
?>