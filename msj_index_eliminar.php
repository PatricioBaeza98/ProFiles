<?php
	ob_start();
	include("funciones.php"); 
	error_reporting(0); 
	session_start();
	$cnn=Conectar(); 
	$rut=$_SESSION['$varut'];

	$id= $_GET['id'];
	$sql92="DELETE FROM msj_index WHERE id='$id'";
	mysqli_query($cnn,$sql92);
	header("Location:msj_index.php");

ob_end_flush();
?>