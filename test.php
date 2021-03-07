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
            <li class="nav-item">
              <a href="cursos.php" class="nav-link">Cursos PROFILES</a>
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
		
		      <?php 
      $rut=$_SESSION['$varut'];
      $total = mysqli_num_rows(mysqli_query($cnn,"SELECT rut FROM cv WHERE rut='$rut'"));
      $total1 = mysqli_num_rows(mysqli_query($cnn,"SELECT rut FROM test WHERE rut='$rut'"));
      if ($total==0) {
    ?>
   <h2 class="center"><?php echo $_SESSION['$vanombre']?>, Lamentablemente aun  no llenas tu Curriculum Vitae Por favor Llene su curriculum para poder realizar el test</h2>
    <?php
    }else{
      if($total1==0){
      ?>
         <div class="container">
        <div class="row">
          <div class="col s12">
            <h3 class="center z-depth-2">Test de Personalidad</h3>
            <form method="post" class="z-depth-5 center">
              <h7 class="center"> 1-En general, ¿te encuentras comodo rodeado de gente?</h7>
              <p>
              <label>
                <input type="radio" name="radio1" value="1" class="with-gap">
                <span>Verdadero</span>
              </label>
              <label>
                <input type="radio" name="radio1" value="0" class="with-gap">
                <span>Falso</span>
              </label>
            </p>
            <h7>2-¿Alguna vez hablas mal de terceras personas cuando éstas no están presentes?</h7>   
            <p>
              <label>
                <input type="radio" name="radio2" value="1" class="with-gap">
                <span>Verdadero</span>
              </label>
              <label>
                <input type="radio" name="radio2" value="0" class="with-gap">
                <span>Falso</span>
              </label>
            </p>
            <h7>3- Generalmente, ¿te sientes feliz?</h7>
            <p>
              <label>
                <input type="radio" name="radio3" value="1" class="with-gap">
                <span>Verdadero</span>
              </label>
              <label>
                <input type="radio" name="radio3" value="0" class="with-gap">
                <span>Falso</span>
              </label>
            </p>
            <h7>4- ¿Si alguien te pide que hagas algo que no deseas, lo haces igualmente para complacerle o para evitar una discusión?</h7>
            <p>
              <label>
                <input type="radio" name="radio4" value="1" class="with-gap">
                <span>Verdadero</span>
              </label>
              <label>
                <input type="radio" name="radio4" value="0" class="with-gap">
                <span>Falso</span>
              </label>
            </p>
            <h7>5- Ante un hecho importante (examen, entrevista de trabajo, etc.), ¿te pones muy nervioso/a y te duele el estómago?</h7>
            <p>
              <label>
                <input type="radio" name="radio5" value="1" class="with-gap">
                <span>Verdadero</span>
              </label>
              <label>
                <input type="radio" name="radio5" value="0" class="with-gap">
                <span>Falso</span>
              </label>
            </p>
            <h7>6- ¿Sueles estar callado cuando te encuentras entre personas poco conocidas?</h7>
            <p>
              <label>
                <input type="radio" name="radio6" value="1" class="with-gap">
                <span>Verdadero</span>
              </label>
              <label>
                <input type="radio" name="radio6" value="0" class="with-gap">
                <span>Falso</span>
              </label>
            </p>
            <h7>7-¿Eres una persona activa y emprendedora?</h7>
            <p>
              <label>
                <input type="radio" name="radio7" value="1" class="with-gap">
                <span>Verdadero</span>
              </label>
              <label>
                <input type="radio" name="radio7" value="0" class="with-gap">
                <span>Falso</span>
              </label>
            </p>
            <h7>8- ¿Crees en general que eres capaz de hacer las cosas que te propones?</h7>
            <p>
              <label>
                <input type="radio" name="radio8" value="1" class="with-gap">
                <span>Verdadero</span>
              </label>
              <label>
                <input type="radio" name="radio8" value="0" class="with-gap">
                <span>Falso</span>
              </label>
            </p>
            <h7>9-¿Eres puntual y te disgusta que los demás no lo sean?</h7>
            <p>
              <label>
                <input type="radio" name="radio9" value="1" class="with-gap">
                <span>Verdadero</span>
              </label>
              <label>
                <input type="radio" name="radio9" value="0" class="with-gap">
                <span>Falso</span>
              </label>
            </p>
            <h7> 10-¿Sueles tener dudas sobre las decisiones que tomas?</h7>
            <p>
              <label>
                <input type="radio" name="radio10" value="1" class="with-gap">
                <span>Verdadero</span>
              </label>
              <label>
                <input type="radio" name="radio10" value="0" class="with-gap">
                <span>Falso</span>
              </label>
            </p>
            <p>
              <label><button class="btn btn-primary my-2 my-sm-0" type="submit" name="btnEnviar">Enviar
          </button></label>
            </p>
            <br>
            </form>
          </div>
        </div>
      </div>
      <?php
      }else{
      ?>
        <h3 class="center"><?php echo $_SESSION['$vanombre']?>, Usted ya ingreso su test Correctamente, Por favor espere a que alguna empresa se ponga en contacto con usted.</h3> <br>
        <h3 class="center">Para saber si tiene alguna oferta Laboral diríjase a la parte superior en Mis Ofertas Laborales o haciendo Click <a href="misofertas.php">Aqui</a></h3>  
      <?php
        }
      }  
      ?>
      <?php if(isset($_POST['btnEnviar'])){
        $rut=$_SESSION['$varut'];
        $listar="SELECT rut FROM test WHERE rut='$rut'";
        $resultado=mysqli_query($cnn,$listar);
        while($rs=mysqli_fetch_array($resultado)){
            $Rutbd= $rs['rut'] ;
        }
         if ($Rutbd == $rut ) {
      echo "<script>alert('Error Al intentar enviar su test por segunda vez, por favor espere a que le respondan')</script>";
       }else{
        $r1=$_POST['radio1'];
        $r2=$_POST['radio2'];
        $r3=$_POST['radio3'];
        $r4=$_POST['radio4'];
        $r5=$_POST['radio5'];
        $r6=$_POST['radio6'];
        $r7=$_POST['radio7'];
        $r8=$_POST['radio8'];
        $r9=$_POST['radio9'];
        $r10=$_POST['radio10'];
        $resultado=$r1+$r2+$r3+$r4+$r5+$r6+$r7+$r8+$r9+$r10;
        switch ($_POST['btnEnviar']){
          case 0:
                if($resultado<=3){
                  $perso = "Timido/a";
                  break;
                }
          case 1:
                if ($resultado<=5) {
                        $perso = "Equilibrido/a";
                        break;
                      }      
          case 2:
                if($resultado<=7){
                  $perso = "Sociable";
                  break;
                }
          case 3:
                if($resultado>=8 AND  $resultado<=9){
                  $perso = "Conforme";
                  break;
                }      
          case 4:
                if($resultado==10){
                  $perso = "Fuerte";
                  break;
                }    

        }
        $listar1="SELECT id FROM cv WHERE rut='$rut'";
        $resultado1=mysqli_query($cnn,$listar1);
        while($rs=mysqli_fetch_array($resultado1)){
            $id= $rs['id'] ;
        }
        $rut=$_SESSION['$varut'];
        $sql="INSERT INTO test (rut,respuesta,cv) VALUES ('$rut','$perso','$id') ";
        mysqli_query($cnn,$sql);
        if($sql==true){
          header("Location:test.php");
        }
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
        <p>© 2019 Realizado por NOMBREAUTOR Todos los derechos reservados.</p>
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