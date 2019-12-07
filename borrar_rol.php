<?php
	include('lynxspace.class.php');
	$id_rol = $_GET['id_rol'];
	$sitio->borrar_rol($id_rol);
	header("Location: admi_seguridad.php")
?>