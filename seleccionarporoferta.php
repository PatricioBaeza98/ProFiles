<?php ob_start(); include("funciones.php"); error_reporting(0); session_start();$cnn=Conectar(); 
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
	<meta charset="UTF-8">
	<title>Seleccionar</title>
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
        $listar="SELECT sexo FROM usuario WHERE rut='$rut'";
        $resultado=mysqli_query($cnn,$listar);
        while($rs=mysqli_fetch_array($resultado)){
            $sex= $rs['sexo'] ;
        }
?>

	<header>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<div class="container">
				<a href="empresa.php" class="navbar-brand">
			<?php if($sex=="Masculino"){
            ?> Bienvenido
            <?php
          	}else{
            ?>Bienvenida
            <?php
         	 } 
         	 ?>
         	 <?php echo $_SESSION['$nombre_empresa'];?></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menuNavegacion" aria-controls="menuNavegacion" aria-expanded="false" aria-label="Alternar Menu">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="menuNavegacion">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item">
							<a href="eliminarpublicacion.php" class="nav-link">Eliminar Publicaciones</a>
						</li>
						<li class="nav-item">
							<a href="acerca.php" class="nav-link">Seleccionados</a>
						</li>
						<li class="nav-item">
							<a href="acerca.php" class="nav-link">Quitar Seleccionados</a>
						</li>
						<li class="nav-item">
							<a href="acerca.php" class="nav-link">Reunion</a>
						</li>
						<li class="nav-item">
							<a href="acerca.php" class="nav-link">Nuevo Trabajo</a>
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
      $rut=$_SESSION['$varut'];
      $consulta = "SELECT ofertas_laborales.titulo,ofertas_laborales.id
        FROM ofertas_laborales
        WHERE (rut_empresa='$rut') AND (ofertas_laborales.estado='activa')";
      $rs2=mysqli_query($cnn,$consulta);
      ?>
	<form method="GET">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<a href="seleccionar.php" class="btn btn-primary btn-lg">Volver</a>
					<div class="shadow-sm p-3 mb-5 bg-white rounded">
						<div class="row">
							<div class="col-8">
								<select class="form-control" name="oferta">
						  			<option disabled selected>Oferta</option>
						  			<?php while ($row2 = mysqli_fetch_array($rs2)){
                    					$titulo = $row2["titulo"];
                    					$id = $row2["id"];
                  					?>
						  			<option value="<?php echo ($id);?>"><?php echo utf8_encode($titulo);?></option>
						  			<?php
					                  }
					                  ?>
								</select>
							</div>
							<div class="col-4">
								<input type="submit" class="btn btn-primary " name="veroferta" value="Ver Oferta">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>

	<?php 
      if(isset($_GET["veroferta"])){
        $idoferta=$_GET["oferta"];
        $respuesta="SELECT envios_curriculum.rut_postulante,usuario.nombre
        FROM envios_curriculum,ofertas_laborales,usuario
        WHERE (envios_curriculum.rut_postulante=usuario.rut) AND (envios_curriculum.oferta_laboral=ofertas_laborales.id) AND (ofertas_laborales.id='$idoferta')";
        $rs2=mysqli_query($cnn,$respuesta);
         while ($row2=mysqli_fetch_array($rs2)){
          $rut_postulante=$row2["rut_postulante"];
          $nombre_usuario=$row2["nombre"];
          ?>
          <form method="GET">
            <div class="container shadow-sm p-3 mb-5 bg-white rounded">
              <div class="row">
                <div class="col-12">
                  <table class="table">
                    <thead class="thead-dark">
                      <tr>
                        <th>Nombre</th>
                        <th>Ver CV</th>
                      </tr>
                    </thead>
                    <tr>
                      <td><?php echo $nombre_usuario ?></td>
                      <td><a href="vercurriculum.php?rut=<?php echo($row2['rut_postulante']);?>&id=<?php echo ($idoferta);?>">Ver CV</a></td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </form>
          <?php
         }
      }
      ?>
	

	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php
ob_end_flush();
?>