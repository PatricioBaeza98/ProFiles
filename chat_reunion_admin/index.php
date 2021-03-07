<?php ob_start(); 
session_start();
if(!isset($_SESSION['$varut'])){
	header('Location:index.php');
}
include("../funciones.php"); error_reporting(0); $cnn=Conectar(); 
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
$nombre_usuario=$_SESSION['$nombre'];
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
$id_rrr=$_GET["admin_user"];
$rut=$_SESSION['$varut'];
$traer_cliente="SELECT * FROM chat_ac,usuario WHERE (chat_ac.rut=usuario.rut) AND(chat_ac.rut='$id_rrr')";
$resu=mysqli_query($cnn,$traer_cliente);
$row2=mysqli_fetch_array($resu);
?>
<!DOCTYPE html>
<html>
<head>
	<title>CHAT</title>
	<link rel="stylesheet" href="styles.css">
	<link href="https://fonts.googleapis.com/css?family=Mukta+Vaani" rel="stylesheet">
	<script type="text/javascript">
		function ajax(){
			var req = new XMLHttpRequest();

			req.onreadystatechange = function(){
				if (req.readyState == 4 && req.status == 200) {
					document.getElementById('chat').innerHTML = req.responseText;
				}
			}

			req.open('GET', 'chat.php?admin_user=<?php echo $id_rrr;?>', true);
			req.send();
		}

		//linea que hace que se refreseque la pagina cada segundo
		setInterval(function(){ajax();}, 1000);
	</script>
</head>
<body onload="ajax();">
	<?php
	$id_rrr=$_GET["admin_user"];
	$rut=$_SESSION['$varut'];
	$listar2="";
        $resultado2=mysqli_query($cnn,$listar2);
        while($row3=mysqli_fetch_array($resultado2)){
            $traer_empresa_cliente= $row3['nombre_empresa'] ;
        }
	 ?>
	<!--<div align="center">
		<?php echo utf8_encode($row2['nombre']);?> 
	</div>-->



	
	<div id="contenedor">
		<div class="arriba" style="text-transform: uppercase; font-weight: 500;">
			<center><h2><?php echo $row2['nombre'];?> <?php echo utf8_encode($row2['apellido']);?></h2></center>
		</div>
		<div id="caja-chat">
			<div id="chat"></div>
		</div>
		<hr>
		<form method="POST" action="index.php?admin_user=<?php echo $id_rrr;?>">
			<textarea name="mensaje" placeholder="Ingresa tu mensaje"></textarea>	
			<input type="submit" name="enviar" value="Enviar"> <!--No tener nada en el value &nbsp;-->
		</form>
		<br>
		<?php if($nombre_em=="Cliente"){
			?>
			<a href="../reunion.php" style="text-decoration: none; color:#1475D3;">Volver</a>
			<?php
		}else if($nombre_em=="admin"){
			?>
			<a href="../admin.php" style="text-decoration: none; color:#1475D3;">Volver</a>
			<?php
		}else{
			?>
			<a href="../empresa.php" style="text-decoration: none; color:#1475D3;">Volver</a>
			<?php
		}
		?>
	</div>
		<?php
			if (isset($_POST['enviar'])) {
				
				$mensaje = $_POST['mensaje'];
				$rut=$_SESSION['$varut'];
				$consulta = "INSERT INTO chat_ac (nombre, mensaje, rut, rut_2) VALUES ('$nombre_usuario', '$mensaje', '$rut', '$id_rrr') ";

				$ejecutar = $conexion->query($consulta);

				if ($ejecutar) {
					echo "<embed loop='false' id='esconder' src='beep.mp3' hidden='true' autoplay='true'>";
				}
			}

		?>
	
	<script src="../js/jquery-3.3.1.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
</body>
</html>