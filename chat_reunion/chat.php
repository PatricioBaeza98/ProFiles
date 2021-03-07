<?php ob_start(); include("../funciones.php"); error_reporting(0); session_start();$cnn=Conectar(); 
$rut=$_SESSION['$varut']; $sql = "SELECT nombre_empresa  FROM usuario WHERE rut='$rut'";
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
	$id_rrr=$_GET["id"];

	///consultamos a la base
	$consulta = "SELECT * FROM chat,usuario WHERE (chat.rut=usuario.rut) AND (id='$id_rrr') ";

	$ejecutar = $conexion->query($consulta); 
	while($fila = $ejecutar->fetch_array()) :
?>
	<div id="datos-chat">	
		<span><?php echo utf8_encode($fila['nombre']); ?> <?php echo utf8_encode($fila['apellido']);?>:</span>
		<span><?php echo utf8_encode($fila['mensaje']); ?></span>
		<span style="float: right;"><?php echo formatearFecha($fila['fecha']); ?></span>
	</div>
	
	<?php endwhile; ?>

