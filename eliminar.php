<?php 
ob_start();
include("funciones.php"); 
error_reporting(0); 
session_start();
$cnn=Conectar(); 
$rut=$_SESSION['$varut'];


$id=$_GET["id"];
$eliminar_Reunion="DELETE FROM reunion WHERE (id_trabajo_seleccionado='$id')";
mysqli_query($cnn,$eliminar_Reunion);
$eliminar_seleccion="DELETE FROM seleccion WHERE  (id=$id)";
mysqli_query($cnn,$eliminar_seleccion);
$eliminar_seleccion="DELETE FROM envios_curriculum WHERE  (oferta_laboral='$id')";
mysqli_query($cnn,$eliminar_seleccion);
echo "$eliminar";
if($eliminar_seleccion==true){
	header("Location:eliminarseleccion.php");
}


ob_end_flush();
?>