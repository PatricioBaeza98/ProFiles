<?php 
ob_start();
include("funciones.php"); 
error_reporting(0); 
session_start();
$cnn=Conectar(); 
$rut=$_SESSION['$varut'];


$rut_p=$_GET["rut"];

$eliminar_seleccion="DELETE FROM envios_curriculum WHERE (rut_postulante='$rut_p')";
mysqli_query($cnn,$eliminar_seleccion);
echo "$eliminar";
if($eliminar_seleccion==true){
	header("Location:seleccionarporoferta.php");
}


ob_end_flush();
?>