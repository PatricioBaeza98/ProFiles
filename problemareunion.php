<?php
ob_start();
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
<style>
	table{
		border: 1px solid black;
	}
</style>
<head>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Cliente</title>
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
    <?php 
      $id=$_GET["id"];
      $total = mysqli_num_rows(mysqli_query($cnn,"SELECT id,motivo,descripcion FROM reunion WHERE (motivo<>'NULL') AND (descripcion<>'NULL') AND (id='$id')"));
      if($total==1){
        ?>
          <h5>Envio Correctamente su solicitud de cambio, si la empresa cambia entonces podra ver en la pantalla de Reunión.</h5>
        <?php
      }else{
      ?>
      <form method="post">
          <div class="row">
            <div class="col-12">
              <h3>Problemas</h3>
            </div>
          </div>
          <div class="row">
            <div class="col-3">
              <h5><b>Motivo: </b></h5>
            </div>
            <div class="col-9">
                <select name="motivo" class="form-control">
                  <option value="" disabled selected>Opción</option>
                  <option value="Reunion Aceptada">Reunion Aceptada</option>
                  <option value="Problemas con la hora">Problemas con la hora</option>
                  <option value="Problemas con la fecha">Problemas con la fecha</option>
                  <option value="De Otra Ciudad">De Otra Ciudad</option>
                  <option value="No conosco la direccion">No conosco la direccion</option>
                  <option value="Otro">Otro</option>
                </select>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-3">
              <h5><b>Descripción</b></h5>
            </div>
            <div class="col-9">
                <textarea name="descripcion"class="form-control" id="textarea1" cols="30" rows="10"></textarea>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col s3">
              <button class="btn btn-primary my-2 my-sm-0" type="submit"  name="enviar">Enviar
              </button>
            </div>
          </div>
      </form>
      <br>
    <?php }?>
      <?php if(isset($_POST["enviar"])){

      $motivo=$_POST["motivo"];
      $descripcion=$_POST["descripcion"];
      $id=$_GET["id"];
      $actualizar="UPDATE reunion SET motivo='$motivo',descripcion='$descripcion' WHERE id='$id'";
      mysqli_query($cnn,$actualizar);
      if($actualizar==true){
      echo "<script>alert('Se envio su solicitud, si la empresa cambia la hora se mostrara aquí')</script>";
      header("Location:reunion.php");
    }
      }
      ?>
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
	<script type="text/javascript" src="js/main1.js"></script>


</body>
</html>
<?php
ob_end_flush();
?>