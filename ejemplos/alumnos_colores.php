<?php

$alumnos[0]['nombre']="Luis";
$alumnos[1]['nombre']="Juan";
$alumnos[2]['nombre']="Sagrario";
$alumnos[3]['nombre']="Olivares";
$alumnos[4]['nombre']="Edgar";
$alumnos[5]['nombre']="Orquidi";
$alumnos[1000]['nombre']="Fanny";

$alumnos[0]['calificacion']=100;
$alumnos[1]['calificacion']=90;
$alumnos[2]['calificacion']=80;
$alumnos[3]['calificacion']=70;
$alumnos[4]['calificacion']="hola";
$alumnos[5]['calificacion']=50;
$alumnos[1000]['calificacion']=58;


$colores['reprobado']['minimo']=0;
$colores['reprobado']['maximo']=69;
$colores['reprobado']['color']=red;

$colores['regular']['minimo']=70;
$colores['regular']['maximo']=84.55;
$colores['regular']['color']=orange;

$colores['aprobado']['minimo']=85;
$colores['aprobado']['maximo']=100;
$colores['aprobado']['color']=green;








echo "<div style=' display: flex; justify-content: center;'>";
  echo "<table style='margin: 10px; border: 1px solid #000000;'>
           <tr>
             <th colspan='3'>SIN ORDENAR</th>
           </tr>
           <tr>
             <th>NOMBRE</th>
             <th>     </th>
             <th>CALIFICACION</th>
           </tr>";
    foreach ($alumnos as $alumno) {
      echo "
         <tr>
           <td>".$alumno['nombre']."</td>
           <td>     </td>
           <td>".$alumno['calificacion']."</td>
         </tr>";
    }
    echo "</table> <br>";

echo " <br>";
foreach ($alumnos as $key => $alumno) {
	if (!is_numeric($alumno['calificacion'])){
		$alumnos[$key]['calificacion']=0;
	}
}

echo "<table style='margin: 10px; border: 1px solid #000000;'>
        <tr>
          <th colspan='3'>CORREGIDOS</th>
        </tr>
         <tr>
           <th>NOMBRE</th>
           <th>     </th>
           <th>CALIFICACION</th>
         </tr>";
  foreach ($alumnos as $alumno) {
    echo "
       <tr>
         <td>".$alumno['nombre']."</td>
         <td>     </td>
         <td>".$alumno['calificacion']."</td>
       </tr>";
  }
  echo "</table> <br>";

  echo "<table style='margin: 10px; border: 1px solid #000000;'>
          <tr>
            <th colspan='3'>JUNTOS REVUELTOS</th>
          </tr>
           <tr>
             <th>NOMBRE</th>
             <th>     </th>
             <th>CALIFICACION</th>
           </tr>";
    foreach ($alumnos as $alumno) {
      if ($alumno['calificacion']>=$colores['aprobado']['minimo'] && $alumno['calificacion']<=$colores['aprobado']['maximo']){
        echo "
           <tr style='color: ".$colores['aprobado']['color']."'>
             <td>".$alumno['nombre']."</td>
             <td>     </td>
             <td>".$alumno['calificacion']."</td>
           </tr>";
        $promedio=$promedio+$alumno['calificacion'];
      }else
          if ($alumno['calificacion']>=$colores['regular']['minimo'] && $alumno['calificacion']<=$colores['regular']['maximo']){
            echo "
               <tr style='color: ".$colores['regular']['color']."'>
                 <td>".$alumno['nombre']."</td>
                 <td>     </td>
                 <td>".$alumno['calificacion']."</td>
               </tr>";
            $promedio=$promedio+$alumno['calificacion'];
          }else {
            if ($alumno['calificacion']>=$colores['reprobado']['minimo'] && $alumno['calificacion']<=$colores['reprobado']['maximo']){
              echo "
                 <tr style='color: ".$colores['reprobado']['color']."'>
                   <td>".$alumno['nombre']."</td>
                   <td>     </td>
                   <td>".$alumno['calificacion']."</td>
                 </tr>";
              $promedio=$promedio+$alumno['calificacion'];
            }
          }

    }
    echo "</table> <br>";



  echo "</div> <br> <br>";



//oooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo


echo "<div style='display: flex; justify-content: center; '>";
//******************************************************APROBADOS
  echo "<table style='margin: 10px; border: 1px solid #000000; color: ".$colores['aprobado']['color']."'>
          <tr>
            <th colspan='3'>aprobados</th>
          </tr>
           <tr>
             <th>NOMBRE</th>
             <th>     </th>
             <th>CALIFICACION</th>
           </tr>";
    foreach ($alumnos as $alumno) {
      if ($alumno['calificacion']>=$colores['aprobado']['minimo'] && $alumno['calificacion']<=$colores['aprobado']['maximo']){
    		echo "
           <tr>
             <td>".$alumno['nombre']."</td>
             <td>     </td>
             <td>".$alumno['calificacion']."</td>
           </tr>";
    	}

    }
    echo "</table> <br>";




//**********************************************REGULARES
echo "<table style='margin: 10px;border: 1px solid #000000; color: ".$colores['regular']['color']."'>
        <tr>
          <th colspan='3'>REGULARES</th>
        </tr>
         <tr>
           <th>NOMBRE</th>
           <th>     </th>
           <th>CALIFICACION</th>
         </tr>";
  foreach ($alumnos as $alumno) {
    if ($alumno['calificacion']>=$colores['regular']['minimo'] && $alumno['calificacion']<=$colores['regular']['maximo']){
      echo "
         <tr>
           <td>".$alumno['nombre']."</td>
           <td>     </td>
           <td>".$alumno['calificacion']."</td>
         </tr>";
    }

  }
  echo "</table> <br>";





  //**********************************************REPROBADOS
  echo "<table style='margin: 10px; border: 1px solid #000000; color: ".$colores['reprobado']['color']."'>
          <tr>
            <th colspan='3'>REPROBADOS</th>
          </tr>
           <tr>
             <th>NOMBRE</th>
             <th>     </th>
             <th>CALIFICACION</th>
           </tr>";
    foreach ($alumnos as $alumno) {
      if ($alumno['calificacion']>=$colores['reprobado']['minimo'] && $alumno['calificacion']<=$colores['reprobado']['maximo']){
        echo "
           <tr>
             <td>".$alumno['nombre']."</td>
             <td>     </td>
             <td>".$alumno['calificacion']."</td>
           </tr>";
      }

    }
    echo "</table> <br>";




echo "</div>";

echo "El promedio es:".$promedio/sizeof($alumnos)."<br><br>";

echo "El promedio dije que es: ".$promedio/sizeof($alumnos)."<br><br>";
?>
