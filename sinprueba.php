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
      $id= $_GET['id']; 
      $rut=$_SESSION['$varut'];
      $totall = mysqli_num_rows(mysqli_query($cnn,"SELECT nota_test FROM seleccion WHERE (rut_cv='$rut') AND (id='$id') AND (nota_test<>'NULL')"));
      if ($totall==1){
        ?>
        <center><h3 class="center"><?php echo $_SESSION['$vanombre']?>, Ya respondiste satisfactoriamente.</h3></center>
        <?php
      }else{
        ?>
  <form method="post"> 
  <div class="container">

    <br>
    <div class="row">
      <div class="col-12">
        <h5><b>Haz sido seleccionado para una reunion, por favor acepta o rechaza la peticion</b></h5>
        <hr>
        </div>  
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pregunta1" id="exampleRadios1" value="Reunion Aceptada" checked>
          <label class="form-check-label" for="exampleRadios1">ACEPTAR</label>
        </div>  
      </div>
    </div>

  <div class="container">
    <br>
    <div class="row">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pregunta1" id="exampleRadios1" value="Reunion No Aceptada" checked>
          <label class="form-check-label" for="exampleRadios1">RECHAZAR</label>
        </div>  
      </div>
    </div>

  <div class="container">
    <br>
    <div class="row">

      <div class="col-12">
        <input type="submit" class="btn btn-primary my-2 my-sm-0" name="Boton" value="Enviar">
      </div>      
 
      </div>
    </div>

  </div>  
  </form>
        <?php
      }
      if ($_POST['Boton']=="Enviar") {
        $id= $_GET['id']; 
        $r1=$_POST['pregunta1'];
        $insertarn="UPDATE seleccion SET nota_test='$r1' , descripcion='' WHERE id='$id'";
        mysqli_query($cnn,$insertarn);
        if($insertarn==true){
        header("Location:misofertas.php");
        
        }
      }
      ?>


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