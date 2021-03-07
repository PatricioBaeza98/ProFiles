<?php 
ob_start(); 
session_start();
if(!isset($_SESSION['$varut'])){
	header('Location:index.php');
}
include("funciones.php"); 
error_reporting(0); 
$cnn=Conectar(); 
$rut=$_SESSION['$varut']; $sql = "SELECT nombre_empresa  FROM usuario WHERE rut='$rut'";
$rs=mysqli_query($cnn,$sql);  
if (mysqli_num_rows($rs)!=0){
  if ($row=mysqli_fetch_array($rs)){
    $_SESSION['$nombre_empresa'] = $row['nombre_empresa'];
  }
}
$nombre_empresa=$_SESSION['$nombre_empresa'];
$sql1="SELECT rut,nombre,apellido,correo,telefono,sexo,usua,pass,Direccion,ruta_imagen from usuario WHERE rut='$rut'";
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


    <!--<script type="text/javascript">
        if(history.forward(1)){
            location.replace(history.forward(1));
        }
        </script>  -->

    
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

	<div class="container shadow p-3 mb-5 bg-white rounded">
		<div class="row">
			<div class="col-3">
				<div class="col-12">
					<div class="card mb-3" style="max-width: 300px; max-height: 600px;">
						<img class="card-img-top" src="<?php echo($fi['ruta_imagen']);?>" alt="">
						<div class="card-boddy">
							<h4 class="card-title">¡Te damos la bienvenida, <?php echo $_SESSION['$nombre_empresa'];?>!</h4>
							<button type="button" class="btn btn-primary center" data-toggle="modal" data-target=".bd-example-modal-lg">Actualizar Datos</button>
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
														    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="usuario" name="usuario" value="<?php echo($row['usua']);?>" readonly>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-sm">
														<div class="form-group">
														    <label for="exampleFormControlInput1">Nueva Contraseña</label>
														    <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="••••••••" name="Contraseña"
														    value="<?php echo($row['pass']);?>">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-sm">
														<div class="form-group">
														    <label for="exampleFormControlInput1">Repetir Contraseña</label>
														    <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="••••••••" name="RContraseña" value="<?php echo($row['pass']);?>">
														</div>
													</div>
												</div>
											</div>
								      	</div>
								      	<div class="modal-footer">
								       		<button class="btn btn-primary my-2 my-sm-0" type="submit" name="bnteditar">Actualizar</button>
								      	</div>
								      </form>	
								     </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-9">
				<div class="row">
					<div class="col-12">
						<h2 style="text-align: center;">Empresas</h2>
						<hr>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
					<?php  
					$rut=$_SESSION['$varut'];
					$consulta="SELECT ruta_imagen,usuario.rut,nombre_empresa,telefono,correo,direccion FROM usuario WHERE usuario.nombre_empresa <> 'Cliente' and rut<>'$rut'";
					$respuesta=mysqli_query($cnn,$consulta);			
					while($traer=mysqli_fetch_assoc($respuesta)){
						$ruta_imagen_buscar=$traer["ruta_imagen"];
						$rut_buscar=$traer["rut"];
						$nombre_empresa_buscar=$traer["nombre_empresa"];
						$telefono_buscar=$traer["telefono"];
						$correo_buscar=$traer["correo"];
						$direccion_buscar=$traer["direccion"];
					?>
						<table class="table table-hover" style="border: 1px solid black;">
							<thead class="thead-dark">
								<tr>
									<th scope="col">Imagen</th>
									<th scope="col">RUT</th>
									<th scope="col">Nombre</th>
									<th scope="col">Telefono</th>
									<th scope="col">Correo</th>
									<th scope="col">Dirección</th>
									<th scope="col">Chat</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td scope="row"><img src="<?php echo $traer['ruta_imagen'];?>" style="height: 60px; width: 90px; border: 1px solid black;"></td>
									<td><?php echo $rut_buscar;?></td>
									<td><?php echo $nombre_empresa_buscar;?></td>
									<td><?php echo $telefono_buscar;?></td>
									<td><?php echo $correo_buscar;?></td>
									<td><?php echo utf8_decode($direccion_buscar);?></td>
									<td><a href="chat_reunion_admin/index.php?admin_user=<?php echo $rut_buscar;?>"><img src="img/chat.png" alt=""></a></td>
								</tr>
							</tbody>
						</table>
						<?php
					}
				 ?>
					</div>
				</div>
			</div>
		</div>
		<?php
					$sql111="SELECT id, nombre_curso, recomendacion, objetivo, ruta_curso, ruta_img, estado FROM subir_cursos";
					mysqli_query($cnn,$sql111); $res222=mysqli_query($cnn,$sql111);
					?>
		<hr>
		<div class="row">
			<div class="col-12">
				<h2 style="text-align: center;">Cursos</h2>
			</div>
		</div>	
			<div class="row">
				<?php while($row222=mysqli_fetch_assoc($res222)){ ?>
				<div class="col-4">
					<center>
						<a style="color: black; text-decoration: none;" href="editar_curso.php?id=<?php echo($row222['id']);?>">
							<div class="card" style="width: 18rem;">
								<img src="<?php echo($row222['ruta_img']);?>" class="card-img-top">
								<hr>
								<div class="card-body" style="text-align: left;">
								<h5 class="card-title"><?php echo($row222['nombre_curso']);?></h5>
								<p class="card-text"><b>Recomendacion: </b><?php echo(utf8_encode($row222['recomendacion']));?></p>
								<p class="card-text"><b>Objetivo: </b><?php echo(utf8_encode($row222['objetivo']));?></p>
								<p class="card-text"><b>Ruta Imagen: </b><?php echo(utf8_encode($row222['ruta_img']));?></p>
								<p class="card-text"><b>Ruta Curso: </b><?php echo(utf8_encode($row222['ruta_curso']));?></p>
								<p class="card-text"><b>ESTADO: </b><?php echo(utf8_encode($row222['estado']));?></p>
							</div>
							</div>
						</a>
					</center>
				</div>
				<?php };?>
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
	<script type="text/javascript" src="js/main3.js"></script>

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
            $destino="img/".$foto;
            $foto_de_cliente=$fi["ruta_imagen"];
            copy($ruta,$destino);
  			if($contraseña==$rcontraseña){
  				if($hay_imagen=$_FILES["foto"]["name"]!=null){
  					$sql="UPDATE usuario SET nombre='$nombre',correo='$correo',telefono='$telefono',pass='$contraseña',ruta_imagen='$destino',portada_empresa=null 
  					WHERE rut='$rut'";
  				}else{
  					$sql="UPDATE usuario SET nombre='$nombre',correo='$correo',telefono='$telefono',pass='$contraseña',ruta_imagen='$foto_de_cliente',portada_empresa=null 
  					WHERE rut='$rut'";
  				}

  					mysqli_query($cnn,$sql);
  					if($sql==true){
  						 header("Location:admin.php");
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