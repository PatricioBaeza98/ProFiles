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
	<form method="post" enctype="multipart/form-data">

		<div class="container">
			<div class="row">
				<div class="col-12">
					<h3>Subir Curso</h3>
					<hr>
				</div>
			</div>

			<div class="row">
					
				<div class="col-6">

					<h4>Nombre Curso:</h4>
					<input type="text" name="nombre_curso" class="form-control">


					<h4>Recomendacion:</h4>
					<input type="text" name="recomendacion_curso" class="form-control">

					<h4>Objetivo:</h4>
					<input type="text" name="objetivo_curso" class="form-control">

					<h4>Ruta Curso:</h4>
					<input type="text" name="ruta_curso" class="form-control" value="">
					
					<h4>Subir Imagen:</h4>
					<input type="file" name="foto5">

				</div>
			</div>

			<br>

			<div class="row">
				<div class="col-3">
					<input type="submit" class="btn btn-outline-primary" name="publicar" value="Publicar">
				</div>
			</div>

		</div>
	
	

	<?php 
	if($_POST['publicar']=="Publicar"){

		$nombre_curso=utf8_decode($_POST["nombre_curso"]);
		$recomendacion=utf8_decode($_POST["recomendacion_curso"]);
		$objetivo=utf8_decode($_POST["objetivo_curso"]);
		$ruta_curso=utf8_decode($_POST["ruta_curso"]);


				$nombrefoto=$_FILES['foto5'] ['name']; //esto es el nombre de la imagen
				$ruta=$_FILES['foto5'] ['tmp_name']; //se le asigna una nombre temporar que sera la ruta
				$destino="img/".$nombrefoto; //esto es el destino en donde se guardara la foto
				copy($ruta,$destino); //y aqui copia la ruta y el destino

		$insertar="INSERT INTO subir_cursos (nombre_curso,recomendacion,objetivo,ruta_img,ruta_curso,estado) VALUES ('$nombre_curso','$recomendacion','$objetivo','$destino','cursos/$ruta_curso','Activo')";
		mysqli_query($cnn,$insertar);
	}

	?>
	</form>
	<br>
	<br>
	<br>

	<footer class="container">
		<div class="row border-top py-5">
			<div class="col text-right">
				<a href="#" class="btn btn-link">Subir en Pagina</a>
			</div>
		</div>
	</footer>


	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>

</body>
</html>
<?php
ob_end_flush();
?>