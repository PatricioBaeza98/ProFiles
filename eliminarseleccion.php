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
              <a href="seleccionar.php" class="nav-link">Seleccionados</a>
            </li>
            <li class="nav-item">
              <a href="eliminarseleccion.php" class="nav-link">Quitar Seleccionados</a>
            </li>
            <li class="nav-item">
              <a href="agendarreunion.php" class="nav-link">Reunion</a>
            </li>
            <li class="nav-item">
              <a href="publicar.php" class="nav-link">Publicar Trabajo</a>
            </li>
            <li class="nav-item">
              <a href="miperfil.php" class="nav-link">Perfil</a>
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
      $rut=$_SESSION['$varut'];
      $consulta = "SELECT ofertas_laborales.titulo,ofertas_laborales.id
        FROM ofertas_laborales
        WHERE  (ofertas_laborales.rut_empresa='$rut') AND (ofertas_laborales.estado='activa')";
      $rs=mysqli_query($cnn,$consulta);
      ?>
      <br>
      <form method="GET">
        <div class="container">
          <div class="row shadow p-3 mb-5 bg-white rounded">
            <div class="col-6">
                <select class="form-control" name="seleccion">
                  <option value="" disabled selected>Oferta Laboral</option>
                  <?php while ($row = mysqli_fetch_array($rs)){
                   $id=$row["id"];
                   $titulo=$row["titulo"];
                  ?>
                  <option  value="<?php echo ($id);?>"><?php echo ($titulo);?></option>
                  <?php
                  }
                  ?>
                </select>
            </div>
            <div class="col-6">
                <button class="btn btn-primary" type="submit"  name="verseleccion">Ver Selección
                </button>
                <!--<input type="submit" name="btn1" value="Ver Curriculum">-->
            </div>
          </div>
        </div>
      </form>
      <br><br>
      <?php 
      if (isset($_GET["verseleccion"])) {
      $id_seleccion=$_GET["seleccion"];
      $respuestaseleccion="SELECT seleccion.id,usuario.nombre,seleccion.rut_cv,seleccion.nota_test,seleccion.descripcion FROM seleccion,usuario WHERE (usuario.rut=seleccion.rut_cv) AND (id_oferta='$id') AND (nota_test<>'NULL')";
      $rs2=mysqli_query($cnn,$respuestaseleccion);
      while ($row2=mysqli_fetch_array($rs2)){
      $rut_postulante=$row2["rut_cv"];
      $nota_test=$row2["nota_test"];
      $descripcion=$row2["descripcion"];
      $nombre=$row2["nombre"];
      $id=$row2["id"];
      ?>
      <form method="GET">
        <div class="container">
          <div class="row shadow p-3 mb-5 bg-white rounded">
            <div class="col-12">
              <table class="table" style="border: 1px solid black;">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Nota Test</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Eliminar Selección</th>
                  </tr>
                </thead>
                  <tr>
                    <td><?php echo $nombre ?></td>
                    <td><?php echo $nota_test ?></td>
                    <td><?php echo $descripcion ?></td>
                    <td>
                    	<form method="GET" action="eliminar">
                    		<a href="eliminar.php?rut_postulante=<?php echo($row2['rut_cv']);?>&id=<?php echo($row2['id']);?>">Eliminar</a>
                    	</form>
                    </td>
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