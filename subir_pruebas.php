<?php ob_start(); 
session_start();
if(!isset($_SESSION['$varut'])){
	header('Location:index.php');
}
include("funciones.php"); error_reporting(0); $cnn=Conectar(); 
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Empresa</title>
	<script>
      $(function(){
           $('#login').click(function(){
         $(this).next('#login-content').slideToggle();
         $(this).toggleClass('active');          
         });
      });
      function ValidaSoloNumeros(){
      if ((event.keyCode<48) || (event.keyCode > 57))
      event.returnValue = false;
      }
      function txNombres(){
        if ((event.keyCode !=32) && (event.keyCode <65) || (event.keyCode > 90) && (event.keyCode <97) || (event.keyCode > 122))
        event.returnValue=false;
      }
    </script>
</head>
<body>
<?php
$rut=$_SESSION['$varut'];
        $listar1="SELECT sexo FROM usuario WHERE rut='$rut'";
        $resultado1=mysqli_query($cnn,$listar1);
        while($rss=mysqli_fetch_array($resultado1)){
            $sex= $rss['sexo'] ;
        }
?>
	<header>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<div class="container">
				<a href="admin.php" class="navbar-brand">
            Bienvenido <?php echo $_SESSION['$nombre_empresa'];?></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menuNavegacion" aria-controls="menuNavegacion" aria-expanded="false" aria-label="Alternar Menu">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="menuNavegacion">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item">
							<a href="subir_cursos.php" class="nav-link">Subir Cursos</a>
						</li>
						<li class="nav-item">
							<a href="subir_pruebas.php" class="nav-link">Subir Pruebas</a>
						</li>
						<li class="nav-item">
							<a href="msj_index.php" class="nav-link">Mensajes</a>
						</li>
						<li class="nav-item">
							<a href="registro_empresa_.php" class="nav-link">Registro de Empresas</a>
						</li>
					</ul>

					<form class="form-inline my-2 my-lg-0" method="post">
						<button class="btn btn-primary my-2 my-sm-0" type="submit" name="btncerrar">Cerrar Sesión</button>
					</form>
					<?php
                	if (isset($_POST["btncerrar"])) {
                		session_start();
               			session_destroy();
                		header("Location:index.php");
                		}
            		?>
				</div>
			</div>
		</nav>
	</header>
	<br>
	<?php 
        $traerfoto="SELECT ruta_imagen FROM usuario WHERE rut='$rut'";
        mysqli_query($cnn,$traerfoto);
        $result=mysqli_query($cnn,$traerfoto);
        if($fi = mysqli_fetch_array($result)){
            $foto = $fi["ruta_imagen"];
        }
    ?>

	<br>
	<div class="container">
		<form method="post" enctype="multipart/form-data">
			<div class="col-12">
				<center><h3>Subir pruebas</h3></center>
				<hr>
			</div>
			<br>
			<div class="col-12">
				<h4>Codigo Prueba:</h4>
				<input type="text" name="codigo_prueba" class="form-control">
			</div>
			<br>
			<div class="col-12">
				<h4>Nombre Prueba:</h4>
				<input type="text" name="link_prueba" class="form-control">
			</div>
			<br>
			<div class="col-12">
				<h4>Link Prueba:</h4>
				<input type="text" name="nombre_prueba" class="form-control">
			</div>
			<br>
			<div class="col-3">
				<input type="submit" class="btn btn-outline-primary" name="publicar" value="Publicar">
			</div>
			<br>
		<br>
		<br>
		<br>
		<div class="row">
			<div class="col-12">
				<?php  
					$rut=$_SESSION['$varut'];
					$consulta="SELECT id,prueba,especialidad FROM pruebas WHERE not id='1'";
					$respuesta=mysqli_query($cnn,$consulta);			
					while($traer=mysqli_fetch_assoc($respuesta)){
						$id_prueba1=$traer["id"];
						$prueba1=$traer["prueba"];
						$especialidad1=$traer["especialidad"];
				?>
				<table class="table" style="border: 1px solid; text-align: center;">
					<thead class="thead-dark">
						<tr>
							<th>Codigo Prueba</th>
							<th>Nombre Prueba</th>
							<th>Link Prueba</th>
							<th>Eliminar Prueba</th>
						</tr>
  					</thead>
						<tr>
							<td><?php echo $id_prueba1;?></td>
							<td><?php echo $especialidad1;?></td>
							<td><?php echo $prueba1;?></td>
							<td><a href="e_p.php?id=<?php echo $id_prueba1;?>">ELIMINAR</a></td>
						</tr>
				</table>
			<?php } ?>
			</div>
		</div>
		</form>
	</div>



	<footer class="container">
		<div class="row border-top py-5">
			<div class="col text-right">
				<a href="#" class="btn btn-link">Subir en Pagina</a>
			</div>
		</div>
	</footer>


	


	<?php 
		if($_POST['publicar']=="Publicar"){

			$id_prueba=utf8_decode($_POST["codigo_prueba"]);
			$nombre_prueba=utf8_decode($_POST["nombre_prueba"]);
			$link_prueba=utf8_decode($_POST["link_prueba"]);

			$insertar="INSERT INTO pruebas (id,prueba,especialidad) VALUES ('$id_prueba','$nombre_prueba','$link_prueba')";
			mysqli_query($cnn,$insertar);
			header("Location:subir_pruebas.php");
			echo "<script>alert('Se ha ingresado la prueba correctamente.')</script>";

		}

		?>

	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/main2.js"></script>

</body>
</html>
<?php
ob_end_flush();
?>