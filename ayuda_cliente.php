<?php
ob_start();
session_start();
if(!isset($_SESSION['$varut'])){
	header('Location:index.php');
}
include("funciones.php");
error_reporting(0); 
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
	<title>Ayuda</title>
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
			</div>
		</nav>
	</header>
	<br>
	<br>
	<div class="container shadow p-3 mb-5 bg-white rounded">
		<div class="row">	
			<div class="col-12">
				<a href="cliente.php" class="btn btn-primary">Volver</a>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-12">
				<center><h2>¿Comó postular a una oferta de trabajo en ProFiles?</h2></center>
			</div>
		</div>
		<hr>	
		<br>
		<div class="row">
			<div class="col-12">
				<img src="img/ayuda1.png" style="width: 100%;">
				<br>
				<center><h6>1- 
				Antes de postular suba su curriculum como se indica
			 	en la parte superior como se indica en la imagen.</h6></center>
			</div>
		</div>	
		<br>
		<div class="row">
			<div class="col-12">
				<img src="img/ayuda2.png" style="width: 100%;">
			<br>
			<center><h6>2- Rellene los datos solicitados</h6></center>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-12">
				<img src="img/ayuda3.png" style="width: 100%;">			
			<br>
			<center><h6>3- Suba su test de personalidad, como se indica en la imagen.</h6></center>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-12">
				<img src="img/ayuda4.jpg" style="width: 100%;">
			<br>
			<center><h6>4- Una vez contestada las preguntas le saldra la siguiente información</h6></center>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-12">
				<img src="img/ayuda5.png" style="width: 100%;">
				<br>
				<center><h6>5- Una vez subido el curriculum y su test, postule a las ofertas visibles en la pagina principal.</h6></center>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-12">
				<img src="img/ayuda9.png" style="width: 100%;">
				<br>
				<center><h6>6- Dar click en Solicitar Empleo y esperar a que la empresa se contacte con usted.</h6></center>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-12">
				<img src="img/ayuda6.png" style="width: 100%;">
				<br>
				<center><h6>7- Ir a mis ofertas y realizar la prueba que le envio la empresa</h6></center>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-12">
				<img src="img/ayuda10.png" style="width: 100%;">
				<br>
				<center><h6>8- Una vez respondido el test espere a que la empresa se ponga en contacto con usted para agendar una reunión.</h6></center>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-12">
				<img src="img/ayuda11.png" style="width: 100%;">
				<br>
				<center><h6>9- Una vez la empresa le agenda una reunión, confirme y si tiene algun problema reagende la reunión.</h6></center>
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