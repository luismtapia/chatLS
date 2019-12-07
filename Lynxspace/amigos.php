<?php
    include('lynxspace.class.php');
    $sitio->validar_rol(array('usuario'));
    echo '<pre>';
    print_r($_SESSION);
    $amigos = $sitio->amigos($_SESSION['id_persona']);
    print_r($amigos);
?>
