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
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agendar Reunion</title>
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
    
    <?php 
      $rut=$_SESSION['$varut'];
      $consulta = "SELECT ofertas_laborales.titulo,ofertas_laborales.id,usuario.Direccion
        FROM ofertas_laborales,usuario
        WHERE  (usuario.rut=ofertas_laborales.rut_empresa) and (ofertas_laborales.rut_empresa='$rut') and (ofertas_laborales.estado='activa')";
      $rs=mysqli_query($cnn,$consulta);
      ?>
      <br>
      <form method="GET">
            <div class="container">
                        <div class="row">
                            <div class="col-6">
                                <select name="seleccion" class="form-control">
                                <option value="" disabled selected>Oferta Laboral</option>
                                    <?php while ($row = mysqli_fetch_array($rs)){
                                    $id=$row["id"];
                                    $titulo=$row["titulo"];
                                    ?>
                                <option  value="<?php echo ($id);?>"><?php echo utf8_encode($titulo);?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-primary" type="submit"  name="verseleccion">Ver Selección
                                </button>
                            </div>
                        </div>
            </div>
      </form>
      <?php 
      if (isset($_GET["verseleccion"])) {
      $id_seleccion=$_GET["seleccion"];
      $rut=$_SESSION['$varut'];
      $traerdireccion="SELECT usuario.Direccion from usuario where (usuario.rut='$rut')";
      $trer=mysqli_query($cnn,$traerdireccion);
      while($traer=mysqli_fetch_array($traer)){
        $direccion=$row2["Direccion"];
      }


      $respuestaseleccion="SELECT seleccion.id,usuario.nombre,usuario.correo,seleccion.rut_cv,seleccion.nota_test,seleccion.descripcion 
      FROM SELECCION INNER JOIN USUARIO ON USUARIO.RUT=SELECCION.rut_cv INNER JOIN ofertas_laborales ON ofertas_laborales.id=seleccion.id_oferta 
      WHERE (id_oferta='$id_seleccion') AND (SELECCION.nota_test<>'NULL') AND (seleccion.descripcion<>'NULL') AND (ofertas_laborales.estado<>'desactivada')";
      $rs2=mysqli_query($cnn,$respuestaseleccion);
      //echo "$respuestaseleccion";
      while ($row2=mysqli_fetch_array($rs2)){
        $rut_postulante=$row2["rut_cv"];
        $nota_test=$row2["nota_test"];
        $descripcion=$row2["descripcion"];
        $nombre=$row2["nombre"];
        $id=$row2["id"]; 
      ?>
      <br>
      <br>
      <form method="GET">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <table class="table table-hover" style="border:1px solid black;">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Nota Test</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Agendar reunion</th>
                    </tr>
                </thead>
                <tr>
                    <td><?php echo $nombre ?></td>
                    <td><?php echo $nota_test ?></td>
                    <td><?php echo $descripcion ?></td>
                    <td><a href="agendar.php?rut_postulante=<?php echo($row2['rut_cv']);?>&&id_seleccion=<?php echo($row2['id']);?>">Agendar</a></td>
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