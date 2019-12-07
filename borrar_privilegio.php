<?php
	include('lynxspace.class.php');
	$id_privilegio = $_GET['id_privilegio'];
	$sitio->borrar_privilegio($id_privilegio);
	header("Location: admi_seguridad.php")
?>