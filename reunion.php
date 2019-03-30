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
                		header("Location:principal.php");
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
	        <div class="col s12">
	          	<h4 class="center z-depth-2"><?php echo $_SESSION['$vanombre']?>, Aqui podras ver tu reuniones.</h4>
	        </div>
      </div>
      <?php 
        $rut=$_SESSION['$varut'];   
        $sql="SELECT reunion.id as id,reunion.fecha as fecha,reunion.hora as hora,reunion.ciudad as ciudad,reunion.direccion as direccion,usuario.nombre_empresa as nomb,ofertas_laborales.titulo as titulo
            FROM reunion,seleccion,ofertas_laborales,usuario
            where (reunion.id_trabajo_seleccionado=seleccion.id) AND (seleccion.id_oferta=ofertas_laborales.id) AND (seleccion.rut_empresa=usuario.rut) AND (seleccion.rut_cv='$rut') AND (ofertas_laborales.estado='activa')";
         mysqli_query($cnn,$sql);
         $rs=mysqli_query($cnn,$sql); 
          while($row=mysqli_fetch_assoc($rs)){
            $fecha = date_create($row["fecha"]);
            $hora = date_create($row["hora"]);
            $ciudad=$row["ciudad"];

            // Recordar Date Format para traer formatos de fecha y hora desde la base de datos
          ?>
          <form method="GET">
            <div class="row">
            <div class="col-12">
              <table class="table">
                <thead class=" thead-dark">
                  <tr>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Ciudad</th>
                    <th>Dirección</th>
                    <th>Nombre Empresa</th>
                    <th>Nombre Postulación</th>
                    <th>¿Problemas?</th>
                  </tr>
                </thead>
                <tr>
                  <td><?php echo date_format($fecha, 'd/m/Y');?></td>
                  <td><?php echo date_format($hora, 'g:i A');?></td>
                  <td><?php echo utf8_encode($ciudad)?></td>
                  <td><?php echo($row['direccion']);?></td>
                  <td><?php echo($row['nomb']);?></td>
                  <td><?php echo($row['titulo']);?></td>
                  <td><a href="problemareunion.php?id=<?php echo($row['id']);?>">Problema</a></td>
                </tr>
              </table>
            </div>
          </div>

          </form>
          <?php
      }
      ?>
		</div>
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
	<script type="text/javascript" src="js/main1.js"></script>


</body>
</html>
<?php
ob_end_flush();
?>