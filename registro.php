<?php include("funciones.php"); error_reporting(0); $cnn=Conectar(); 
session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registro</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="js/rutvalidar.js" type="text/javascript"></script>
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
	
	<script type="text/javascript">
		function validar_email( email ) 
		{
		    var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		    return regex.test(email) ? true : false;
		}
		var email_prueba = "fulanito@gmail.com";
		 
		if( validar_email( email_prueba ) )
		{
		    
		}
		else
		{
		    alert("El email NO es correcto");
		}
	</script>

</head>
<body>
	<header>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<div class="container">
				<a href="index.php" class="navbar-brand">ProFiles</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menuNavegacion" aria-controls="menuNavegacion" aria-expanded="false" aria-label="Alternar Menu">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="menuNavegacion">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item">
							<a href="registro.php" class="nav-link">Registro</a>
						</li>
					</ul>

					<form class="form-inline my-2 my-lg-0" method="post" action="validar.php">
						<input type="text" name="usuario" class="form-control mr-sm-2" type="text" placeholder="Usuario o Correo">
						<input type="password" name="contraseña" class="form-control mr-sm-2" type="password" placeholder="Contraseña">
						<button class="btn btn-primary my-2 my-sm-0" type="submit" name="btnentrar">Iniciar Sesión</button>
					</form>
				</div>
			</div>
		</nav>
	</header>
	<br>
	<br>

	<div class="container">
		<form method="post">
			<div class="row">
				<div class="col-12">
					<h3>Registro de Usuario</h3>
				</div>
			</div>
			<hr>
			<br>
			<div class="row">
				<div class="col-12">
				<input type="text" name="rut" placeholder="Rut" required required oninput="valRut(this)" class="validate form-control">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-6">
					<input type="text" id="last_name icon_prefix" class="validate form-control" name="txt1" onkeypress="txNombres()" placeholder="Nombre">
				</div>
				<div class="col-6">
					<input type="text" id="last_name icon_prefix" class="validate form-control" name="txt2" onkeypress="txNombres()" placeholder="Apellido">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-12">
					<input type="email" name="txt3" id="email icon_prefix" class="validate form-control" onkeypress="validar_email()" placeholder="Correo">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-12">
					<input type="tel" name="txt4" id="icon_telephone" class="validate form-control" onkeypress="ValidaSoloNumeros()" maxlength="9" minlength="9" placeholder="Telefono">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-12">
                    <select id="icon_wc" name="sel" onkeypress="txNombres()" class="form-control">
                       <option value="" disabled selected>Seleccione su Sexo</option>
                       <option value="Masculino">Masculino</option>
                       <option value="Femenino">Femenino</option>
                    </select>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-12">
					<input type="text" id="last_name icon_person" class="validate form-control" name="txt5" maxlength="15" placeholder="Usuario">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-6">
					<input id="password" type="password" class="validate form-control" name="txt6" maxlength="10" minlength="3" placeholder="Contraseña">
				</div>
				<div class="col-6">
					<input id="password" type="password" class="validate form-control" name="txt_p2" maxlength="10" minlength="3" placeholder="Repetir Contraseña">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-6">
					<div class="g-recaptcha" data-sitekey="6Lesg3IUAAAAAJGFdnjj5ER-7Ki92Xr5_e68h0CC">
      						</div>
				</div>
				<div class="col-6">
					<div class="input-field col s12">
      					<input type="submit" name="btn1" value="Registrar" class="btn btn-primary">
      				</div>
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
			</div>
			<div class="col text-right">
				<a href="#" class="btn btn-link">Subir en Pagina</a>
			</div>
		</div>
	</footer>

	
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src='https://www.google.com/recaptcha/api.js'></script>

	<?php
	 if($_POST['btn1']=="Registrar") {
	  
      $rut = $_POST['rut'];
      $nombre=$_POST['txt1'];
      $apellido=$_POST['txt2'];
      $correo=$_POST['txt3'];
      $telefono=$_POST['txt4'];
      $sexo=$_POST['sel'];
      $usuario=$_POST['txt5'];
      $contraseña=$_POST['txt6'];
      $contraseña_2=$_POST['txt_p2'];
	  
	  require_once("recaptchalib.php");
      $captcha=$_POST['g-recaptcha-response'];
      $secret='6Lesg3IUAAAAAEsGzi2IB8hP7daWOliMpaq_toPd';

     if ($_POST['txt6'] != $_POST['txt_p2']) {
      		echo "<script>alert('Las contraseñas no coiciden')</script>";
      	}else{
      if(!$captcha){
      	echo "<script>alert('Por favor verifica el captcha')</script>";
      }
       
      $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");
		
      var_dump($response);
      $arr = json_decode($response, TRUE);
	}																
      if ($arr['success']) {

	  if ($_POST['rut']==$rut) {
	  	$rs=mysqli_query($cnn,"SELECT * FROM usuario WHERE rut='$rut'");
	  	if ($row=mysqli_fetch_array($rs)) {
	  		?> <script>alert("Ya existe el Rut en la base de datos, Inicie sesion con su datos")</script>
        <script type="text/javascript">window.location="registro.php";</script>
		
      <?php
      }else{
      if (empty($nombre) || empty($usuario) || empty($contraseña) || empty($contraseña_2) || empty($correo) || empty($telefono) || empty($apellido) || empty($sexo) || empty($captcha)) {
      
      ?>
      		<script>alert('Todos los campos son obligatorios, deben contener datos')</script>

      
      <?php
      }else{
      	$sql="INSERT INTO usuario (rut,nombre,apellido,correo,telefono,sexo,Puesto,Direccion,tipo,nombre_empresa,usua,pass,ruta_imagen) VALUES ('$rut','$nombre','$apellido','$correo','$telefono','$sexo',NULL,NULL,'2','Cliente','$usuario','$contraseña','fotos/default.jpg')";
     		 mysqli_query($cnn,$sql);
      echo "$sql";
      ?>
      
      <script>alert('El registro ha sido ingresado Correctamente')</script>
      <script type="text/javascript">window.location="registro.php";</script>
      
      
      <?php
      }
      }
      }else{

      ?>	<script>alert('RUT Incorrecto')</script>
      <?php
      }
      }else{

      }
	}
	?>

	
    
</body>
</html>