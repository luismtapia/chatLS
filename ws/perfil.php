<?php
  //$_Server muestra informacion del servidor por el método get
  include("lynxspace.class.php");
  $informacion=$sitio->persona(5);
  print_r($información);
      if(isset($_GET['id_persona']))
      {
        $id_persona=$_GET['id_persona'];
        $informacion=$sitio->persona($id_persona);
      }
      echo json_encode($informacion);
 ?>
