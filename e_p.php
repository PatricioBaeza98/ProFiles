<?php
	ob_start();
	include("funciones.php"); 
	error_reporting(0); 
	session_start();
	$cnn=Conectar(); 
	$rut=$_SESSION['$varut'];

	$id_prueba1= $_GET['id'];
	$sql92="DELETE FROM pruebas WHERE id='$id_prueba1'";
	mysqli_query($cnn,$sql92);
	header("Location:subir_pruebas.php");

ob_end_flush();
?>