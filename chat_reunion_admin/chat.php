
<?php ob_start(); 
session_start();
if(!isset($_SESSION['$varut'])){
	header('Location:index.php');
}
include("../funciones.php"); 
error_reporting(0); $cnn=Conectar(); 
$rut=$_SESSION['$varut'];
$sql = "SELECT nombre_empresa  FROM usuario WHERE rut='$rut'";
$rs=mysqli_query($cnn,$sql);  
if (mysqli_num_rows($rs)!=0){
  if ($row=mysqli_fetch_array($rs)){
    $_SESSION['$nombre_empresa'] = $row['nombre_empresa'];
  }
}
$nombre_empresa=$_SESSION['$nombre_empresa'];
$sql1="SELECT rut,nombre,apellido,correo,telefono,sexo,usua,pass,ruta_imagen from usuario WHERE rut='$rut'";
mysqli_query($cnn,$sql1);
$rs=mysqli_query($cnn,$sql1);  
$row=mysqli_fetch_assoc($rs);


$listar1="SELECT nombre_empresa FROM usuario WHERE rut='$rut'";
        $resultado1=mysqli_query($cnn,$listar1);
        while($rss=mysqli_fetch_array($resultado1)){
            $nombre_em= $rss['nombre_empresa'] ;
        }
?>


<?php
	include "db.php";
	$id_rrr=$_GET["admin_user"];
	$rut=$_SESSION['$varut']; 
	///consultamos a la base
	$consulta = "SELECT * FROM CHAT_AC WHERE ((RUT='$id_rrr') AND (RUT_2='$rut') OR (RUT='$rut') AND (RUT_2='$id_rrr'))";

	$ejecutar = $conexion->query($consulta); 
	while($fila = $ejecutar->fetch_array()) :
?>	
	<div id="datos-chat">	
		<span><?php echo utf8_encode($fila['nombre']); ?> :</span>
		<span><?php echo utf8_encode($fila['mensaje']); ?></span>
		<span style="float: right;"><?php echo formatearFecha($fila['fecha']); ?></span>
	</div>
	
	<?php endwhile; ?>
