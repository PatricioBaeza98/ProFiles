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

			<?php
					$id_curso= $_GET['id']; 
						
						$datos="SELECT id, nombre_curso, recomendacion, objetivo, ruta_curso, ruta_img,estado FROM subir_cursos WHERE (id='$id_curso')";
						$resul=mysqli_query($cnn,$datos);
						if($rows=mysqli_fetch_array($resul)){
                   		$nombre_curso33=$rows["nombre_curso"];
                   		$recomendacion33=$rows["recomendacion"];
                   		$objetivo33=$rows["objetivo"];
                   		$ruta_curso33=$rows["ruta_curso"];
                   		$ruta_img33=$rows["ruta_img"];
                   		$estado_curso=$rows["estado"];
                  			}
			 ?>

		<div class="container">
			<div class="row">
				<div class="col-12">
					<h3>Editar Curso</h3>
					<hr>
				</div>
			</div>
			<div class="col-3">
			<img class="card-img-top" src="<?php echo $ruta_img33;?>" alt="" class='card-img' alt='...' style='height: 150px; width: 190px;'>
			</div>
			<br>
	

			<h4>Codigo Curso:</h4>



			<div class="row">		

			<div class="col-3">			
				<input type="text" name="codigo" class="form-control" required value="<?php echo $id_curso; ?>" size="20" disabled>
			</div>

			<div class="col-3">
				
			</div>
			
			</div>




			<div class="row">
					
				<div class="col-6">

					<h4>Nombre Curso:</h4>
					<input type="text" name="nombre_curso" class="form-control" value="<?php echo $nombre_curso33; ?>">


					<h4>Recomendacion:</h4>
					<input type="text" name="recomendacion_curso" class="form-control" value="<?php echo $recomendacion33; ?>">

					<h4>Objetivo:</h4>
					<input type="text" name="objetivo_curso" class="form-control" value="<?php echo $objetivo33; ?>">

					<h4>Ruta Curso:</h4>
					<input type="text" name="ruta_curso" class="form-control" placeholder="cursos/" value="<?php echo $ruta_curso33; ?>">
					
					<h4>Subir Imagen:</h4>
					<input type="file" name="foto" id="foto">

					<h4>Estado:</h4>
					<select name="estado" value="<?php echo $estado_curso;?>">
						<option value="<?php echo $estado_curso;?>"><?php echo $estado_curso;?></option>
						<?php 
						if ($estado_curso=="Desactivo") {
							?>
								<option value="Activo">Activo</option>
							<?php 
						}else{
							?>
								<option value="Desactivo">Desactivo</option>
							<?php
						}

							

						?>
						
					</select>

				</div>
			</div>

			<br>

			<div class="row">
				<div class="col-3">
					<input class="btn btn-primary" type="submit" name="bnteditar" value="Editar">
					<input class="btn btn-primary" type="submit" name="bnteliminar" value="Eliminar">
				</div>
			</div>

		</div>
	

		<script>
			$(document).ready(function(){
				$('#foto').click(function(){
					if($(this).is(":checked")){
						doChecked();
					}else{
						doNotChecked();
					}
				});
			});
		</script>

	 	  <?php 
   if(isset($_POST["bnteditar"])) 
    	{


		$nombre_curso=utf8_decode($_POST["nombre_curso"]);
		$recomendacion=utf8_decode($_POST["recomendacion_curso"]);
		$objetivo=utf8_decode($_POST["objetivo_curso"]);
		$ruta_curso=utf8_decode($_POST["ruta_curso"]);
		$estado=utf8_decode($_POST["estado"]);
		$ruta_img33=$rows["ruta_img"];

  			$foto=$_FILES["foto"]["name"];
            $ruta=$_FILES["foto"]["tmp_name"];
            $destino="img/".$foto;
            copy($ruta,$destino);

            if($dato_img=$_FILES["foto"]["name"]!=null){
            	 $sql9="UPDATE subir_cursos SET nombre_curso='$nombre_curso',recomendacion='$recomendacion',objetivo='$objetivo',ruta_img='$destino',ruta_curso='$ruta_curso',estado='$estado' WHERE id='$id_curso'";
            }else{
            	 $sql9="UPDATE subir_cursos SET nombre_curso='$nombre_curso',recomendacion='$recomendacion',objetivo='$objetivo',ruta_img='$ruta_img33',ruta_curso='$ruta_curso',estado='$estado' WHERE id='$id_curso'";
            }

	            mysqli_query($cnn,$sql9);
	            echo "$sql9";
	            header("Location:admin.php");



    	} 
  	?>


	 	  <?php 
   if(isset($_POST["bnteliminar"])) 
    	{



	            $sql92="DELETE FROM subir_cursos WHERE id='$id_curso'";
	            mysqli_query($cnn,$sql92);
	            echo "$sql92";
	            header("Location:admin.php");



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