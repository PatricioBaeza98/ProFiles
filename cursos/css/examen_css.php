<?php
ob_start();
include("../../funciones.php");
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
	<link rel="stylesheet" href="../../css/bootstrap.min.css">
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
        $listar="SELECT usuario.sexo, cursos.nota_curso, cursos.aprobado FROM usuario,cursos WHERE (usuario.rut=cursos.rut) and (usuario.rut='$rut')";
        $resultado=mysqli_query($cnn,$listar);
        while($rs=mysqli_fetch_array($resultado)){
            $sex= $rs["sexo"] ;
        }
?>
    <?php
        $rut=$_SESSION['$varut'];
        $id_cursos=$_GET["id"];
        $hola123="SELECT cursos.id,cursos.nota_curso, cursos.aprobado FROM usuario,cursos WHERE (usuario.rut=cursos.rut) and (usuario.rut='$rut') and (cursos.id='$id_cursos') ";
        mysqli_query($cnn,$hola123);
        $resultado123=mysqli_query($cnn,$hola123);
        if($fi123 = mysqli_fetch_array($resultado123)){
            $nota_final = $fi123["nota_curso"];
            $nota_final = $fi123["aprobado"];

        }
    ?>

	<header>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<div class="container">
				<a href="../../cliente.php" class="navbar-brand">
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
              <a href="../../test.php" class="nav-link">Test de personalidad</a>
            </li>
            <li class="nav-item">
              <a href="../../curriculum.php" class="nav-link">Mi curriculum</a>
            </li>
            <li class="nav-item">
              <a href="../../misofertas.php" class="nav-link">Mis ofertas</a>
            </li>
            <li class="nav-item">
              <a href="../../reunion.php" class="nav-link">Mis Reuniones</a>
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
      $id_cursos=$_GET["id"];
      $total = mysqli_num_rows(mysqli_query($cnn,"SELECT rut FROM cv WHERE rut='$rut'"));
      $total1 = mysqli_num_rows(mysqli_query($cnn,"SELECT rut FROM cursos WHERE rut='$rut' and nombre_curso='CSS BASICO' "));
      if ($total==0) {
    ?>
   <h2 class="center"><?php echo $_SESSION['$vanombre']?>, Lamentablemente aun  no llenas tu Curriculum Vitae Por favor Llene su curriculum para poder realizar el curso</h2>
    <?php
    }else{
      if($total1==0){
      ?>
         <div class="container">
        <div class="row">
          <div class="col s12">
            <h3 class="center z-depth-2">Examen CSS BASICO</h3>
            <br>
            <form method="post" class="z-depth-5 center">
              <h7 class="center"> 1- Con la etiqueta '< DIV >' podemos definir secciones de una página y aplicarle estilos con el atributo style</h7>
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
            <h7>2- si aplicamos estilos a la etiqueta '< BODY >', estos serán heredados por el resto de las etiquetas del documento</h7>   
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
            <h7>3- Para definir un estilo se utilizan atributos como font-size,text-decoration... seguidos de dos puntos y el valor que le deseemos asignar</h7>
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
            <h7>4- Font-style: Para establecer la decoración de un texto, es decir, si está subrayado, sobrerayado o tachado</h7>
            <p>
              <label>
                <input type="radio" name="radio4" value="0" class="with-gap">
                <span>Verdadero</span>
              </label>
              <label>
                <input type="radio" name="radio4" value="1" class="with-gap">
                <span>Falso</span>
              </label>
            </p>
            <h7>5- Text-decoration: Es el estilo de la fuente</h7>
            <p>
              <label>
                <input type="radio" name="radio5" value="0" class="with-gap">
                <span>Verdadero</span>
              </label>
              <label>
                <input type="radio" name="radio5" value="1" class="with-gap">
                <span>Falso</span>
              </label>
            </p>
            <h7>6- Line-height: El alto de una línea,y por tanto, el espaciado entre líneas. Es una de esas características que no se podian mofificar utilizando HTML</h7>
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
            <h7>7- Text-align: Un atributo que sirve para hacer sangrado o márgenes en las páginas</h7>
            <p>
              <label>
                <input type="radio" name="radio7" value="0" class="with-gap">
                <span>Verdadero</span>
              </label>
              <label>
                <input type="radio" name="radio7" value="1" class="with-gap">
                <span>Falso</span>
              </label>
            </p>
            <h7>8- Margin-top: Se utiliza para definir el tamaño del margen a la derecha</h7>
            <p>
              <label>
                <input type="radio" name="radio8" value="0" class="with-gap">
                <span>Verdadero</span>
              </label>
              <label>
                <input type="radio" name="radio8" value="1" class="with-gap">
                <span>Falso</span>
              </label>
            </p>
            <h7>9- Las clases nos sirven para crear definiciones de estilos que se pueden utilizar repetidas veces</h7>
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
            <h7> 10- En cualquier caso puede obviarse el valor 0 ya que es el valor que toman las propiedades por defecto</h7>
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
        <h3 class="center" style="text-align: center; color: green;"><?php echo $_SESSION['$vanombre']?>, Usted ya ha realizado este curso correctamente.</h3> <br>
        <h3 class="center"> Su nota es: <?php echo($fi123['nota_curso']);?> </h3> <br>
        <h3 class="center"> Usted esta: <?php echo($fi123['aprobado']);?>(A) </h3> <br>

        <br>
        <br>
        <h5 class="center" style="text-align: center;"> Si quiere realizar otro curso, dirigase <a href="../../cursos.php">aqui</a></h5>

      <?php
        }
      }  
      ?>
      <?php if(isset($_POST['btnEnviar'])){
        $rut=$_SESSION['$varut'];
        $listar="SELECT rut,nombre_curso FROM cursos WHERE rut='$rut'";
        $resultado=mysqli_query($cnn,$listar);
        while($rs=mysqli_fetch_array($resultado)){
            $Rutbd= $rs['rut'] ;
            $nombre_curso1= $rs['nombre_curso'];
        }
         if ($nombre_curso == 'CSS BASICO' ) {
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
                if($resultado<=1){
                  $nota= "2.0";
                  $perso = "REPROBADO";
                  break;
                }
          case 1:
                if ($resultado==2) {
                  $nota= "2.7";                  
                  $perso = "REPROBADO";
                  break;
                }      
          case 2:
                if($resultado==3){
                  $nota= "3.0";
                  $perso = "REPROBADO";
                  break;
                }
          case 3:
                if($resultado==4){
                  $nota= "3.3";
                  $perso = "REPROBADO";
                  break;
                }      
          case 4:
                if($resultado==5){
                  $nota= "3.7";
                  $perso = "REPROBADO";
                  break;
                }
          case 5:
                if($resultado==6){
                  $nota= "4.0";
                  $perso = "APROBADO";
                  break;
                }
          case 6:
                if($resultado==7){
                  $nota= "4.8";
                  $perso = "APROBADO";
                  break;
                }
          case 7:
                if($resultado==8){
                  $nota= "5.5";
                  $perso = "APROBADO";
                  break;
                }
          case 8:
                if($resultado==9){
                  $nota= "6.3";
                  $perso = "APROBADO";
                  break;
                }
          case 9:
                if($resultado==10){
                  $nota= "7.0";
                  $perso = "APROBADO";
                  break;
                }         

        }
        $listar1="SELECT id FROM cv WHERE rut='$rut'";
        $resultado1=mysqli_query($cnn,$listar1);
        while($rs=mysqli_fetch_array($resultado1)){
            $id= $rs['id'] ;
        }
        $rut=$_SESSION['$varut'];
        $sql="INSERT INTO cursos (rut,nombre_curso,nota_curso,aprobado,cv) VALUES ('$rut','CSS BASICO','$nota','$perso','$id') ";
        mysqli_query($cnn,$sql);
        if($sql==true){
          header("Location:../../cursos.php");
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