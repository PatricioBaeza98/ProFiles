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
				<a href="empresa.php" class="navbar-brand">
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
	<div class="container shadow p-3 mb-5 bg-white rounded">
		<div class="row">
			<div class="col-3">
				<div class="row">
					<div class="col-12">
						<div class="card mb-3" style="max-width: 300px; max-height: 600px;">
							<img class="card-img-top" src="<?php echo($fi['ruta_imagen']);?>" alt="">
							<div class="card-body">
								<h3 class="card-title">¡Te damos la bienvenida, <?php echo $_SESSION['$vanombre'];?>!</h3>
									<!-- Large modal -->
									<button type="button" class="btn btn-primary center" data-toggle="modal" data-target=".bd-example-modal-lg">Actualizar Datos</button>
									<!-- Modal -->
								<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-lg">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title" id="exampleModalLabel">Editar presentación</h5>
								        <div class="row">
								        	<div class="col-sm"></div>
								        </div>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      <div class="modal-body">
								      	<form method="post" enctype="multipart/form-data">
										<div class="col-sm ">
											<div class="card mb-3 py-4 border-bottom">
												<img class="card-img-top" src="<?php echo($fi['ruta_imagen']);?>" alt="">
												<div class="card-body">
													<span>Cargar Foto</span>
                     								 <input type="file" name="foto">
												</div>
											</div>
											<br>
												<div class="row">
													<div class="col-sm">
														<div class="form-group">
								    					<label for="exampleFormControlInput1">Nombre</label>
								    					<input type="text" class="form-control" id="exampleFormControlInput1" name="nombre" onkeypress="txNombres()" maxlength="15" placeholder="Nombre" value="<?php echo($row['nombre']);?>">
								  					</div>
													</div>
													<div class="col-sm">
														<div class="form-group">
									    					<label for="exampleFormControlInput1">Apellido</label>
									    					<input type="text" class="form-control" id="exampleFormControlInput1" name="apellido" onkeypress="txNombres()" maxlength="15" placeholder="Apellido" value="<?php echo utf8_encode($row['apellido']);?>">
									  					</div>
													</div>
												</div>
												<div class="row">
													<div class="col-sm">
														<div class="form-group">
														    <label for="exampleFormControlInput1">Correo electronico</label>
														    <input type="email" class="form-control" id="exampleFormControlInput1" onkeypress="txNombres()" placeholder="name@example.com" name="correo" value="<?php echo($row['correo']);?>">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-sm">
														<div class="form-group">
														    <label for="exampleFormControlInput1">Telefono</label>
														    <input type="text" class="form-control" id="exampleFormControlInput1" maxlength="10" onkeypress="ValidaSoloNumeros()" placeholder="Telefono" name="telefono" value="<?php echo($row['telefono']);?>">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-sm">
														<div class="form-group">
														    <label for="exampleFormControlInput1">Sexo</label>
														    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="sexo" name="sexo" value="<?php echo($row['sexo']);?>" readonly>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-sm">
														<div class="form-group">
														    <label for="exampleFormControlInput1">Usuario</label>
														    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="usuario" name="usuario" value="<?php echo($row['usua']);?>">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-sm">
														<div class="form-group">
														    <label for="exampleFormControlInput1">Contraseña</label>
														    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="••••••••" name="Contraseña"
														    value="<?php echo($row['pass']);?>">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-sm">
														<div class="form-group">
														    <label for="exampleFormControlInput1">Contraseña</label>
														    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="••••••••" name="RContraseña" value="<?php echo($row['pass']);?>">
														</div>
													</div>
												</div>
										</div>
								      </div>
								      <div class="modal-footer">
								       <button class="btn btn-primary my-2 my-sm-0" type="submit" name="bnteditar">Actualizar</button>
								      </div>
								    </div>
								    </form>
								  </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-9 p-3 mb-2 ">
				<div class="row">
					<div class="col-12">
						<form action="" method="post">
							<label for="">Buscar por nombre, empresa o comuna.</label>
							<input type="text" class="autocomplete form-control" id="caja_busqueda1" placeholder="Buscar" name="caja_busqueda1">
							<div id="datos1"></div>
						</form>
					</div>
				</div>
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
	<script type="text/javascript" src="js/main1.js"></script>


</body>
</html>
<?php
ob_end_flush();
?>