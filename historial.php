<?php 
	ob_start();
	include('lynxspace.class.php');
  	$id_amigo = $_GET['id_amigo'];
	require __DIR__.'/vendor/autoload.php';
	use Spipu\Html2Pdf\Html2Pdf;
	$html2pdf = new Html2Pdf();
	//$html2pdf->addFont('Helvetica', 'B' );
 ?>




<page backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm">
    <h1 align="center">Historial de amistad</h1>
    <p>Yo: 
        <?php $yo= $sitio->getYo($_SESSION['id_persona']); 
            echo $yo[0]['nombre'];
            echo " ";
            echo $yo[0]['apellidos'];
        ?>
    </p>
    <p>Amigo: 
        <?php $amigo= $sitio->getYo($id_amigo); 
            echo $amigo[0]['nombre'];
            echo " ";
            echo $amigo[0]['apellidos'];
        ?>
    </p>
    <br>
    <pre>
        <?php
            $historia=$sitio->historiaPDF($id_amigo);
            echo "<table class='table ' align='center'>"; 
            echo "<tr>";
            //echo "<th>ID_Persona </th>";
            //echo "<th>Nombre </th>";
            //echo "<th>ID_Mensaje </th>";
            echo "<th>Mensaje </th>"; 
            //echo "<th>ID_Amigo </th>"; 
            //echo "<th>Amigo </th>";
            //echo "<th>ID_Mensaje </th>";
            echo "<th>Fecha </th>";
            echo "</tr>";//var_dump($historia);die();   
            foreach($historia as $clave => $historial){
                echo "<tr>";
                //echo "<td>".$historial['id_persona']."</td>";
                //echo "<td>".$historial['nombre']."</td>";
                //echo "<td>".$historial['id_mensaje']."</td>";
                echo "<td>".$historial['mensaje']."</td>";
                //echo "<td>".$historial['id_amigo']."</td>";
                //echo "<td>".$historial['nombre']."</td>";
                //echo "<td>".$historial['id_mensaje']."</td>";
                echo "<td>".$historial['fecha']."</td>";
                echo "</tr>";     
            }

            echo "</table>"; 
        ?>
    </pre>
    <page_footer>
        <img src="image/Logo.png" alt="" height="50" width="100">
    </page_footer>
</page>


<?php
	$content = ob_get_clean();
	$html2pdf->writeHTML($content);
	$html2pdf->output("historial.pdf");
?>