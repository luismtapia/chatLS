<?php
  //ESPECIFICAR A PHP QUE SOY UNA IMAGEN
  //header("Content-type: image/png");
  //INCLUYO LA CLASE
  include ('lynxspace.class.php');
  $sitio->validar_rol(array('usuario'));
  $id_persona=(isset($_GET['id']))?$_GET['id']:'x';
    if(!is_numeric($id_persona)){
      die();
    }
  //MANDO LLAMAR EL METODO FOTO_PERFIL MANDANDOLE COMO PARAMETRO EL id_usuario
  $foto=$sitio->foto_perfil($id_persona);
  //RECOSTRUYO EL ARCHIVO
  //print $foto;
  //LO RENDERIZO
 ?>
