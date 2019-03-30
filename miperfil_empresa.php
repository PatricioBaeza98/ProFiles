<?php ob_start();
include("funciones.php");
 error_reporting(0); 
 session_start();
$cnn=Conectar();
$rut=$_SESSION['$varut'];
$sql="SELECT rut,nombre,apellido,correo,telefono,sexo,usua,pass,ruta_imagen from usuario WHERE rut='$rut'";
mysqli_query($cnn,$sql);
$rs=mysqli_query($cnn,$sql);  
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
<style>
	.portada{
		background: red;
		position: relative;
		right: 16px;
		bottom: 15px;
		width: 1000px;
		height: 175px;
	}
	.foto_portada{
		width: 1110px;
		height: 210px;
	}
	.perfil{
		position: relative;
		bottom: 70px;
		left: 25px;
		width: 150px;
		height: 150px;

	}
	.foto_perfil{
		width: 150px;
		height: 150px;
		border: 1px solid black;
	}
	.datos{
		position: relative;
		left: 200px;
		bottom: 150px;
	}
</style>
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
        <a href="cliente.php" class="navbar-brand">
            <?php if($sex=="Masculino"){
            ?> Bienvenido
            <?php
            }else{
            ?>Bienvenida
            <?php
            } 
            ?>
            <?php echo $_SESSION['$vanombre']?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menuNavegacion" aria-controls="menuNavegacion" aria-expanded="false" aria-label="Alternar Menu">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menuNavegacion">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a href="test.php" class="nav-link">Test de personalidad</a>
            </li>
            <li class="nav-item">
              <a href="curriculum.php" class="nav-link">Mi curriculum</a>
            </li>
            <li class="nav-item">
              <a href="misofertas.php" class="nav-link">Mis ofertas</a>
            </li>
            <li class="nav-item">
              <a href="reunion.php" class="nav-link">Mis Reuniones</a>
            </li>
          </ul>

          <form class="form-inline my-2 my-lg-0" method="post">
            <button class="btn btn-primary my-2 my-sm-0" type="submit" name="btncerrar">Cerrar Sesión</button>
          </form>
          <?php
                  if (isset($_POST["btncerrar"])) {
                    session_start();
                    session_destroy();
                    header("Location:principal.php");
                    }
                ?>
        </div>
      </div>
    </nav>
  </header>
	<br>
	
	<?php 
	$empresa=$_GET["nombre"];
	$rut_empresa=$_GET["empresa"];
	$traer_datos="SELECT nombre_empresa,puesto,Direccion,ruta_imagen as empresa_foto
					FROM usuario
					WHERE rut='$rut_empresa'";
	$resultado=mysqli_query($cnn,$traer_datos);
	while($row1=mysqli_fetch_array($resultado)){
		$nombre_em=$row1["nombre_empresa"];
		$puesto=$row1["puesto"];
		$Direccion=$row1["Direccion"];
		$foto_empresa=$row1["empresa_foto"];
	}	
	?>
	<form method="GET">
		<div class="container">
			<div class="caja shadow p-3 mb-5">
			<div class="portada">
				<img src="img/portada.jpg" class="foto_portada">
			</div>
			<hr>
			<div class="perfil">
				<img src="<?php echo utf8_encode($foto_empresa); ?>" class='foto_perfil' >
			</div>
			<div class="datos">
				<h4> <?php echo utf8_encode($nombre_em); ?></h4>
				<p><?php echo utf8_encode($puesto);?> • <?php  echo utf8_encode($Direccion);?></p>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
			<center><h3>Más ofertas de <?php echo utf8_encode($nombre_em); ?></h3></center>
			<hr>
			<br>
			<div class="row">
			<?php
			$rut_empresa=$_GET["empresa"];
			$traer_datos_oferta="SELECT id,titulo,nombre_empresa,lugar_trabajo,fecha_publicacion,salario,tipo_puesto,area,estado FROM ofertas_laborales WHERE (rut_empresa='$rut_empresa') AND (estado='activa')";
			mysqli_query($cnn,$traer_datos_oferta);
			$resultado2=mysqli_query($cnn,$traer_datos_oferta);
			while($row2=mysqli_fetch_assoc($resultado2)){ 
			?>
					<div class="col-4">
							<a href="trabajo.php?id_de_trabajo=<?php echo($row2['id']);?>" style="color: black; text-decoration: none;">
								<div class="card" style="width: 18rem;">
				  					<img src="<?php echo utf8_encode($foto_empresa); ?>" class="card-img-top">
								  <div class="card-body">
								    <h5 class="card-title"><?php echo($row2['titulo']);?></h5>
								    <p class="card-text"><?php echo(utf8_encode($row2['lugar_trabajo']));?></p>
								    <p class="card-text"><?php echo(utf8_encode($row2['fecha_publicacion']));?></p>
								  </div>
								</div>
							</a>
							<br>
					</div>	
			<?php } //cierra while ?>
			</div>
			</div>
		</div>
		</div>

	</form>
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