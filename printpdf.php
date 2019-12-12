<?php 
	ob_start();
	include('lynxspace.class.php');
print_r($_GET['id_persona']);die();
  	$id_amigo = $_GET['id_persona'];
	require __DIR__.'/vendor/autoload.php';
	use Spipu\Html2Pdf\Html2Pdf;
	$html2pdf = new Html2Pdf();
	//$html2pdf->writeHTML('<h1>Hola Mundo desde html2pdf</h1>');
	//$html2pdf->writeHTML('hpola');
	
 ?>




<page backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm">
    <img src="image/Logo.png" alt="" height="100" width="50">
    <h1 align="center">Historial </h1>       
    <br>
    <pre>
        <?php
            $historia=$sitio->historiaPDF($id_amigo);
            echo "<table class='table' align='center'>"; 
            echo "<tr>";
            echo "<th>ID Persona</th>";
            echo "<th>Nombre</th>";
            echo "<th>ID Mensaje</th>";
            echo "<th>Mensaje</th>"; 
            echo "<th>ID Amigo</th>"; 
            echo "<th>Amigo</th>";
            echo "<th>ID Mensaje</th>";
            echo "<th>Mensaje</th>";
            echo "</tr>";
            foreach($historia as $clave => $historial){
                echo "<tr>";
                echo "<td>".$historial['id_persona']."</td>";
                echo "<td>".$historial['nombre']."</td>";
                echo "<td>".$historial['id_mensaje']."</td>";
                echo "<td>".$historial['mensaje']."</td>";
                echo "<td>".$historial['id_amigo']."</td>";
                echo "<td>".$historial['nombre']."</td>";
                echo "<td>".$historial['id_mensaje']."</td>";
                echo "<td>".$historial['mensaje']."</td>";
                echo "</tr>";        
            }
            echo "</table>"; 
        ?>
    </pre>
</page>


<?php
	$content = ob_get_clean();
	$html2pdf->writeHTML($content);
	$html2pdf->output();
?>