<?php include("funciones.php"); error_reporting(0); $cnn=Conectar();
session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Index</title>
</head>
<body>
	
		<header>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<div class="container">
				<a href="#" class="navbar-brand">ProFiles</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menuNavegacion" aria-controls="menuNavegacion" aria-expanded="false" aria-label="Alternar Menu">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="menuNavegacion">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item">
							<a href="principal.php" class="nav-link">Inicio</a>
						</li>
						<li class="nav-item">
							<a href="acerca.php" class="nav-link">Terminos</a>
						</li>
					</ul>

					<form class="form-inline my-2 my-lg-0" method="post">
						<input type="text" name="usuario" class="form-control mr-sm-2" type="text" placeholder="Usuario o Correo">
						<input type="password" name="contraseña" class="form-control mr-sm-2" type="password" placeholder="Contraseña">
						<button class="btn btn-primary my-2 my-sm-0" type="submit" name="btnentrar">Iniciar Sesión</button>
					</form>
				</div>
			</div>
		</nav>
	</header>

	<div class="container">
		<div class="row">
			<div class="col-sm">
				<div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
				  <div class="carousel-inner">
				    <div class="carousel-item active">
				      <img src="img/portada1.jpg" class="d-block w-100" alt="...">
				    </div>
				    <div class="carousel-item">
				      <img src="img/portada2.jpeg" class="d-block w-100" alt="...">
				    </div>
				    <div class="carousel-item">
				      <img src="img/portada3.jpeg" class="d-block w-100" alt="...">
				    </div>
				     <div class="carousel-item">
				      <img src="img/portada4.jpeg" class="d-block w-100" alt="...">
				    </div>
				  </div>
				  <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
				    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
				    <span class="sr-only">Previous</span>
				  </a>
				  <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
				    <span class="carousel-control-next-icon" aria-hidden="true"></span>
				    <span class="sr-only">Next</span>
				  </a>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm">
				<div class="py-4 border-bottom">
					<h1 class="text-center">ProFiles</h1>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-6">
				<div class="row">
					<div class="col-sm">
						<h3 class="text-center">Nuestra Misión:</h3>
					</div>
				</div>
				<div class="row">
					<div class="col-sm">
						<p class="text-center">
							Dar mayor eficiencia, flexibilidad y transparencia al mercado laboral, generando día a día más oportunidades de trabajo para las personas y mejores candidatos para las empresas.
						</p>
					</div>
				</div>
			</div>
			<div class="col-6">
				<div class="row">
					<div class="col-sm">
						<h3 class="text-center">Nuestra Visión:</h3>
					</div>
				</div>
				<div class="row">
					<div class="col-sm">
						<p class="text-center">
							Ser una empresa líder en el mercado de reclutamiento y selección de ejecutivos, con tecnología y servicios de primer nivel, que logren revolucionar el mercado a nivel mundial.
						</p>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12">
				<div class="py-4 border-bottom">
					<h1 class="text-center">Fundadores</h1>
				</div>
			</div>
		</div>

		<div class="row py-4">
			<div class="col-12 col-sm-6 col-lg-3 mb-4">
				<div class="card">
					<img class="card-img-top" src="img/Diego.jpg" alt="">
					<div class="card-body">
						<h4 class="card-title">Diego Calibar</h4>
						<p class="card-text">Se desempeña como Ingeniero en informatica, y es el encargado de backend.</p>
					</div>
				</div>
			</div>

			<div class="col-12 col-sm-6 col-lg-3 mb-4">
				<div class="card">
					<img class="card-img-top" src="img/Patricio.jpg" alt="">
					<div class="card-body">
						<h4 class="card-title">Patricio Baeza</h4>
						<p class="card-text">Se desempeña como Ingeniero en informatica, y es el encargado de Base de datos.</p>
					</div>
				</div>
			</div>

			<div class="col-12 col-sm-6 col-lg-3 mb-4">
				<div class="card">
					<img class="card-img-top" src="img/Eduardo.jpg" alt="">
					<div class="card-body">
						<h4 class="card-title">Eduardo Aguilera</h4>
						<p class="card-text">Se desempeña como Ingeniero en informatica, y es el encargado de Frontend.</p>
					</div>
				</div>
			</div>

			<div class="col-12 col-sm-6 col-lg-3 mb-4">
				<div class="card">
					<img class="card-img-top" src="img/Nicolas.jpg" alt="">
					<div class="card-body">
						<h4 class="card-title">Nicolas Muñoz</h4>
						<p class="card-text">Se desempeña como Ingeniero en informatica, y es el encargado de Frontend.</p>
					</div>
				</div>
			</div>

			<div class="col-12 col-sm-6 col-lg-3 mb-4">
				<div class="card">
					<img class="card-img-top" src="img/Sebastian.jpg" alt="Sebastian Valenzuela">
					<div class="card-body">
						<h4 class="card-title">Sebastian Valenzu..</h4>
						<p class="card-text">Se desempeña como Ingeniero en informatica, y es el encargado de backend.</p>
					</div>
				</div>
			</div>

			<div class="col-12 col-sm-6 col-lg-3 mb-4">
				<div class="card">
					<img class="card-img-top" src="img/Felipe.jpg" alt="">
					<div class="card-body">
						<h4 class="card-title">Felipe Rodriguez</h4>
						<p class="card-text">Se desempeña como Ingeniero en informatica, y es el encargado de diseño.</p>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12">
				<div class="py-4 border-bottom">
					<h1 class="text-center">¿Donde nos encontramos?</h1>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12">
				<div class="row">
					<div class="col-sm">
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3301.028279282645!2d-70.74457398435398!3d-34.17119464224883!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9663433fcf252ead%3A0x4abb48c2e48feaa1!2sO&#39;carrol+501%2C+Rancagua%2C+Regi%C3%B3n+del+Libertador+Gral.+Bernardo+O%E2%80%99Higgins!5e0!3m2!1ses-419!2scl!4v1534362236539" width="1110" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12">
				<div class="py-4 border-bottom">
					<h1 class="text-center">Contacto</h1>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm">
				<p class="text-center">
					Contáctanos y en breve atenderemos su Consulta. Puede hacerlo a través de las distintas redes sociales o completando este formulario.
				</p>
			</div>
		</div>

		<form action="" method="post">
			<div class="row">
				<div class="col-sm">
					<div class="form-group">
    					<label for="exampleFormControlInput1">Nombre</label>
    					<input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nombre">
  					</div>
				</div>
				<div class="col-sm">
					<div class="form-group">
    					<label for="exampleFormControlInput1">Apellido</label>
    					<input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Apellido">
  					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm">
					 <div class="form-group">
    					<label for="exampleFormControlInput1">Correo Electronico</label>
    					<input type="email" class="form-control" id="exampleFormControlInput1" placeholder="correo@example.com">
  					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm">
					<div class="form-group">
					    <label for="exampleFormControlTextarea1">Mensaje Mensaje</label>
					    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
 					 </div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm">
					<button type="button" class="btn btn-primary btn-lg btn-block" name="boton.mensaje">Enviar Mensaje</button>
				</div>
			</div>
		</form>
	</div>

	<br>
	<br>

	<footer class="container">
		<div class="row border-top py-5">
			<div class="col">
				<h3 class="lead">ProFiles.com</h3>
				<a href="acerca.php" class="btn btn-link">Acerca de</a>
			</div>
			<div class="col text-right">
				<a href="#" class="btn btn-link">Subir en Pagina</a>
			</div>
		</div>
	</footer>

	
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>



	<?php
	if(isset($_POST["btnentrar"])){
		$Usuario=$_POST["usuario"];
		$Contraseña=$_POST["contraseña"];
		$sql="SELECT usuario.usua,usuario.rut,usuario.nombre,usuario.pass,usuario.correo,tipos_usu.tipo_usuario FROM usuario,tipos_usu WHERE (tipos_usu.id=usuario.tipo) AND (usuario.correo='$Usuario' or usuario.usua='$Usuario') AND (usuario.pass='$Contraseña')";
    		$rs=mysqli_query($cnn,$sql);
    		if (mysqli_num_rows($rs)!=0) {
    			if ($row=mysqli_fetch_array($rs)) {
    				$_SESSION['$varut'] = $row['rut'];
    				$_SESSION['$vanombre'] = $row['nombre'];
    				$_SESSION['$vatipo'] = $row['tipo_usuario'];
    				switch($_SESSION['$vatipo']){
    					case "Empresa":
    					echo "<script type='text/javascript'>window.location='empresa.php'</script>";
    					break;
    					case "Cliente":
      		 		echo "<script type='text/javascript'>window.location='cliente.php'</script>";
      		 	break;
      		 	default:
      		 		echo "<script>alert('Usted no es Usuario, Por favor Registrese')</script>";
      		 			echo "<script type='text/javascript'>window.location='principal.php'</script>";
      		 	break;
    				}
    			}
    		}
	}

	?>
</body>
</html>