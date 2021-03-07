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
        $traerfoto="SELECT ruta_imagen FROM usuario WHERE rut='$rut'";
        mysqli_query($cnn,$traerfoto);
        $result=mysqli_query($cnn,$traerfoto);
        if($fi = mysqli_fetch_array($result)){
            $foto = $fi["ruta_imagen"];
        }
    ?>
	<br>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<table class="table border text-center">
          <thead class='thead-dark'>
  					<tr>
  						<th scope='col'>Activas</th>
  						<th scope='col'>Desactivas</th>
  					</tr>
  					<tr>
          </thead>
						<td><a href="activas.php"><img src="img/exito.png" alt=""></a></td>
						<td><a href="desactivas.php"><img src="img/mal.png" alt=""></a></td>
					</tr>
				</table>
			</div>
		</div>
	</div>

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

	<?php 
	 if(isset($_POST["bnteditar"])) 
  	{
  			$rut=$_SESSION['$varut'];
  			$nombre=$_POST["nombre"];
  			$apellido=$_POST["apellido"];
  			$correo=$_POST["correo"];
  			$telefono=$_POST["telefono"];
  			$contraseña=$_POST["Contraseña"];
  			$rcontraseña=$_POST["RContraseña"];
  			$foto=$_FILES["foto"]["name"];
            $ruta=$_FILES["foto"]["tmp_name"];
            $destino="fotos/".$foto;
            copy($ruta,$destino);
  			if($contraseña==$rcontraseña){
  				if(empty($nombre)||empty($apellido)||empty($correo)||empty($telefono)||empty($contraseña)||empty($rcontraseña)||empty($destino)||empty($ruta)||empty($foto)){
  					?>
  					 <script>alert('Todos los campos son obligatorios, deben contener datos')</script>
  					<?php
  				}else{
  					$sql="UPDATE usuario SET nombre='$nombre',apellido='$apellido',correo='$correo',telefono='$telefono',pass='$contraseña',ruta_imagen='$destino' 
  					WHERE rut='$rut'";
  					mysqli_query($cnn,$sql);
  					if($sql==true){
  						 header("Location:empresa.php");
  					}
  				}
  			}else{
  				?>
  				<script>alert('Las contraseñas no coinciden.')</script>
  				<?php
  			}

  	} 
 	?>
</body>
</html>
<?php
ob_end_flush();
?>