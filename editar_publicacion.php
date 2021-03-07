<?php 
include("funciones.php");
error_reporting(0); 
session_start();
$cnn=Conectar();
$ide=$_GET["id_publicacion"];
 //Cambio de Estado la oferta laboral
          $Deshabilitar="UPDATE ofertas_laborales
                         SET estado='desactivada' 
                         WHERE id='$ide'";
          mysqli_query($cnn,$Deshabilitar);
					//Cambio de Estado la oferta laboral

          	if ($Deshabilitar==true) {
          		header("Location:activas.php");
          	}
     		   

?>