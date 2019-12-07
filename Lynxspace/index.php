<?php
  include ('lynxspace.class.php');
  $sitio->validar_rol(array('usuario', 'administrador'));
  ?>
  <h1>¡BIENVENIDO!</h1>
  <a href="perfil.php">Perfil</a>
  <a href="logout.php">Logout</a>
