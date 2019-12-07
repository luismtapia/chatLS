<?php
  include('lynxspace.class.php');
  $sitio->logout();
  $mensaje='GRACIAS POR USAR EL SISTEMA';
  if (isset($_GET['code'])) {
    $code=$_GET['code'];
    switch($code){
      case 0: $mensaje='USUARIO Y CONTRASEÑAS INCORRECTAS';
      break;
      case 1: $mensaje='USTED NO TIENE EL ROL PERMITIDO';
      break;
    }
  }
 ?>
 <h3><?php echo $mensaje; ?></h3>
 <h1>GRACIAS POR USAR EL SISTEMA</h1>
 <a href="login.php">INGRESA AQUI PARA ENTRAR</a>
