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
						<button class="btn btn-primary my-2 my-sm-0" type="submit" name="btncerrar">Cerrar Sesi??n</button>
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
				<div class="row">
					<div class="col-12">
						<div class="card mb-3" style="max-width: 300px; max-height: 600px;">
							<img class="card-img-top" src="img/log1.jpeg" alt="">
				</div>
			</div>

		</div>	
	</div>



	

<div class="col-9 p-3 mb-2 " style="text-align: left;">
		<div class="row">
			<div class="col-12">
			<h3 style="text-align: center; color: #2E9AFE;">??Te agendaron una reuni??n?</h3>
			<h4 style="text-align: center; color: #FE2E9A;">[consejos] tips para una entrevista de trabajo exitosa</h4>
			</div>
		</div>

		<br>
		<h5>Practica la presentaci??n:</h5>
		<p>Muchas veces la decisi??n de contratar se toma en los primeros 30 segundos. Da una buena primera impresi??n. Debes llegar un par de minutos antes, revisar tu apariencia y ser agradable en la recepci??n.</p>

		<h5>Act??a correctamente durante la entrevista:</h5>
		<p>Saber escuchar y tener confianza son aspectos claves para una entrevista exitosa. Los empleadores quieren verte entusiasta e informada/o sobre la compa????a. Tambi??n es una oportunidad para que eval??es a la compa????a. ??Quieres trabajar ah??? ??Puedes contribuir, aprender nuevas habilidades o tener la oportunidad de avanzar? ??Se te abrir??n puertas con este puesto?</p>

		<h5>Cuida tu entrada:</h5>
		<p>Una sonrisa, un fuerte apret??n de manos, una conducta confiada, amistosa y entusiasta, todo esto puede contribuir positivamente para generar una primera buena impresi??n de ti.</p>

		<h5>El lenguaje corporal:</h5>
		<p>Tu lenguaje corporal puede expresar m??s sobre tu personalidad de lo que dices. Adopta una postura erguida. Nada peor que andar encorvado, ya que refleja flojera, indecisi??n, y falta de profesionalismo. Evita todo tipo de movimientos nerviosos con tus manos o pies. Sonr??e. Los empleadores siempre prefieren un candidato alegre y entusiasta que a una persona aparentemente hostil o estresada. Sin embargo, trata de no excederte. Las sonrisas falsas y el humor forzado tampoco son recomendables.</p>

		<h5>Toma notas y escucha con atenci??n:</h5>
		<p>T??mate tu tiempo. Las respuestas precisas y l??gicas que abarcan hechos relevantes son m??s efectivas que las respuestas demasiado largas.
		Aseg??rate de haber escuchado bien la pregunta y que has entendido. Est?? bien pedir aclaraciones. Contesta lo que se pregunta.</p>

		<h5>C??mo terminar la entrevista:</h5>
		<p>Realiza algunas de las preguntas que preparaste previamente.
		La ??ltima pregunta podr??a ser aquella sobre la fecha probable en la que tomar??n una decisi??n.
		Agradece, vuelve a expresar tu inter??s por trabajar con ellos, y sal del lugar. En un momento apropiado, p??dele a uno de los entrevistadores que te de una tarjeta de presentaci??n.</p>
		
		<br>
		<br>
		<div class="col-12">
			<h3 style="text-align: center; color: #2E9AFE;">Alguna recomendaciones finales para una entrevista exitosa:</h3>
			<br>
			<h5>- V??stete formal.</h5>
			<h5>- Pres??ntate, no esperes a que otra persona d?? el primer paso.</h5>
			<h5>- Saluda con un fuerte apret??n de manos, con confianza y profesionalismo.</h5>
			<h5>- Demuestra tu energ??a y entusiasmo por el puesto.</h5>
			<h5>- Escucha atentamente al entrevistador.</h5>
			<h5>- Toma contacto visual.</h5>
			<h5>- Contesta las preguntas cuidadosamente y honestamente.</h5>
			<h5>- Cuando sea necesario, t??mate tu tiempo para pensar en la respuesta.</h5>
			<h5>- Agradece al entrevistador por haber tomado el tiempo de entrevistarte y deja la oficina con un apret??n de manos y una sonrisa.</h5>
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