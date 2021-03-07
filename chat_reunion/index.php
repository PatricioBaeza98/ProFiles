<?php ob_start(); include("../funciones.php"); error_reporting(0); session_start();$cnn=Conectar(); 
$rut=$_SESSION['$varut']; $sql = "SELECT nombre_empresa, nombre, apellido,ruta_imagen  FROM usuario WHERE rut='$rut'";

$rs=mysqli_query($cnn,$sql);  
if (mysqli_num_rows($rs)!=0){
  if ($row=mysqli_fetch_array($rs)){
    $_SESSION['$nombre_empresa'] = $row['nombre_empresa'];
    $_SESSION['$nombre'] = $row['nombre'];
    $_SESSION['$apellido'] = $row['apellido'];
  }
}
$nombre_empresa=$_SESSION['$nombre_empresa'];
$nombre_usuario=$_SESSION['$nombre'].' '.$_SESSION['$apellido'];
$sql1="SELECT rut,nombre,apellido,correo,telefono,sexo,usua,pass,ruta_imagen,nombre_empresa from usuario WHERE rut='$rut'";
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
//$rut_pos=$_GET["rut_postulante"];
$rut=$_SESSION['$varut']; 
$traer_cliente="SELECT * 
				FROM chat,usuario 
				WHERE (chat.rut=usuario.rut) AND (id='$id_rrr') AND (usuario.rut<>'$rut')";
$resu=mysqli_query($cnn,$traer_cliente);
$row2=mysqli_fetch_array($resu);
?>
<!DOCTYPE html>
<html>
<head>
	<title>CHAT</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<link href="https://fonts.googleapis.com/css?family=Mukta+Vaani" rel="stylesheet">
	<!--<link rel="stylesheet" href="../css/bootstrap.min.css">-->

	<script type="text/javascript">
		function ajax(){
			var req = new XMLHttpRequest();

			req.onreadystatechange = function(){
				if (req.readyState == 4 && req.status == 200) {
					document.getElementById('chat').innerHTML = req.responseText;
				}
			}

			req.open('GET', 'chat.php?id=<?php echo $id_rrr;?>', true);
			req.send();
		}

		//linea que hace que se refreseque la pagina cada segundo
		setInterval(function(){ajax();}, 1000);
	</script>
</head>
<body onload="ajax();">
	<?php
	$id_rrr=$_GET["id"];
	//$rut_pos=$_GET["rut_postulante"];
	$rut=$_SESSION['$varut']; 
	$listar2="SELECT * 
				FROM chat,usuario 
				WHERE (chat.rut=usuario.rut) AND (id='$id_rrr') AND (usuario.rut<>'$rut')";
        $resultado2=mysqli_query($cnn,$listar2);
        while($row3=mysqli_fetch_array($resultado2)){
            $traer_empresa_cliente= $row3['nombre_empresa'] ;
        }
	 ?>
	<div id="contenedor_2">
		<?php if($traer_empresa_cliente=="Cliente"){
			?>
			<a href="../vercurriculum2.php?rut_usu=<?php echo $row2['rut'];?>">
				<img src="../<?php echo $row2['ruta_imagen'];?>" id="imagen_arriba">
			</a>
			<br>
			<h3><?php echo utf8_encode($row2['nombre']);?> <?php echo utf8_encode($row2['apellido']);?></h3>
			<?php
		}else{
			?>
			<a href="../miperfil_empresa.php?empresa=<?php echo $row2['rut'];?>">
				<img src="../<?php echo $row2['ruta_imagen'];?>" id="imagen_arriba">
			</a>
			<br>
		<h3><?php echo utf8_encode($row2['nombre']);?> <?php echo utf8_encode($row2['apellido']);?>
				<?php
			} ?></h3>

		
	</div>




	<div id="contenedor">
		<div id="caja-chat">
			<div id="chat"></div>
		</div>
		<hr>
		<form method="POST" action="index.php?id=<?php echo $id_rrr;?>">
			<textarea name="mensaje" placeholder="Ingresa tu mensaje"></textarea>	
			<input type="submit" name="enviar" value="Enviar">
		</form>
		<br>
		<?php if($nombre_em=="Cliente"){
			?>
			<a href="../reunion.php" style="text-decoration: none; color:#1475D3;">Volver</a>
			<?php
		}else{
			?>
			<a href="../miperfil.php" style="text-decoration: none; color:#1475D3;">Volver</a>
			<?php
		}
		?>
	</div>
		<?php
			if (isset($_POST['enviar'])) {
				
				$mensaje = $_POST['mensaje'];
				$rut=$_SESSION['$varut'];


				$consulta = "INSERT INTO chat (nombre, mensaje, rut, id) VALUES ('$nombre_usuario', '$mensaje', '$rut', '$id_rrr') ";

				$ejecutar = $conexion->query($consulta);

				if ($ejecutar) {
					echo "<embed loop='false' src='beep.mp3' id='esconder' hidden='true' autoplay='true'>";
				}
			}

		?>
	
	<script src="../js/jquery-3.3.1.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
</body>
</html>