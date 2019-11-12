<?php
include('lynxspace.class.php');
  if(isset($_POST['Enviar'])){
    $data=$_POST;
    $sitio->login($data['email'],$data['contrasena']);
    print_r($_SESSION);
    //die();
  }
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form action="" method="post">
      <label for="">email</label>
      <input type="text" id="email" name="email">
      <label for="">contraseña</label>
      <input type="password" id="contrasena" name="contrasena">
      <input type="submit" id="login" name="Enviar">
    </form>
  </body>
</html>
