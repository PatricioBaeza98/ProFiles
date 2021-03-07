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
	<title>Registro</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
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
							<a href="registro_empresa.php" class="nav-link">Registro de Empresas</a>
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
	<br>

	<div class="container">
		<form method="post">
			<div class="row">
				<div class="col-12">
					<h3>Registro de Empresa</h3>
				</div>
			</div>
			<hr>
			<br>
			<div class="row">
				<div class="col-10">
					<input type="text" name="caja_rut" id="email icon_prefix" class="validate form-control" onkeypress="ValidaSoloNumeros()" maxlength="8" minlength="7" placeholder="Rut">
				</div> 
					<div class="col-2">
						<input type="text" name="caja_digito" id="email icon_prefix" class="validate form-control" maxlength="1" minlength="1">
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
					<input type="text" name="txt_empresa" class="validate form-control" placeholder="Nombre de Empresa">
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
					<input type="text" id="last_name icon_person" class="validate form-control" name="txt5" maxlength="15" placeholder="Usuario" autocomplete="off">
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
	  $vaDig=Verifica($_POST['caja_rut']);
      $rut = $_POST['caja_rut']."-".$_POST['caja_digito'];

      $nombre=$_POST['txt1'];
      $apellido=$_POST['txt2'];
      $correo=$_POST['txt3'];
      $telefono=$_POST['txt4'];
      $sexo=$_POST['sel'];
      $usuario=$_POST['txt5'];
      $contraseña=$_POST['txt6'];
      $contraseña_2=$_POST['txt_p2'];
      $empresa=$_POST['txt_empresa'];
 
	}																
      if ($arr['success']) {
      if ($_POST['caja_digito']=="k") {	$_POST['caja_digito']="K";}
	  if ($_POST['caja_digito']==$vaDig) {
	  	$rs=mysqli_query($cnn,"SELECT * FROM usuario WHERE rut='$rut'");
	  	if ($row=mysqli_fetch_array($rs)) {
	  		?> <script>alert("Ya existe el Rut en la base de datos, Inicie sesion con su datos")</script>
		
      <?php
      }else{
      if (empty($nombre) || empty($usuario) || empty($contraseña) || empty($contraseña_2) || empty($correo) || empty($telefono) || empty($apellido) || empty($sexo) || empty($empresa) ) {
      
      ?>
      		<script>alert('Todos los campos son obligatorios, deben contener datos')</script>

      
      <?php
      }else{
      	$sql="INSERT INTO usuario (rut,nombre,apellido,correo,telefono,sexo,tipo,nombre_empresa,usua,pass,ruta_imagen) VALUES ('$rut','$nombre','$apellido','$correo','$telefono','$sexo','1','$empresa','$usuario','$contraseña','fotos/default.jpg')";
     		 mysqli_query($cnn,$sql);
      echo "$sql";
      ?>
      
      <script>alert('El registro ha sido ingresado Correctamente')</script>
      <script type="text/javascript">window.location="admin.php";</script>
      
      
      <?php
      }
      }
      }else{

      ?>	<script>alert('RUT Incorrecto')</script>
      <?php
      }
      }else{

      }
	
	?>

	
    
</body>
</html>

<?php
ob_end_flush();
?>