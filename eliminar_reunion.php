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
<html>
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

  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menuNavegacion" aria-controls="menuNavegacion" aria-expanded="false" aria-label="Alternar Menu">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menuNavegacion">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a href="eliminarpublicacion.php" class="nav-link">Eliminar Publicaciones</a>
            </li>
            <li class="nav-item">
              <a href="seleccionar.php" class="nav-link">Seleccionados</a>
            </li>
            <li class="nav-item">
              <a href="eliminarseleccion.php" class="nav-link">Quitar Seleccionados</a>
            </li>
            <li class="nav-item">
              <a href="agendarreunion.php" class="nav-link">Reunion</a>
            </li>
            <li class="nav-item">
              <a href="publicar.php" class="nav-link">Publicar Trabajo</a>
            </li>
            <li class="nav-item">
              <a href="miperfil.php" class="nav-link">Perfil</a>
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
<body>

      <div class="row">
        <div class="col-12">
          <center><h2>Mis Reuniones</h2></center>
          <hr>
          <br>

          <?php  
          $id_reunion=$_SESSION['$id_r'];
              $id_rrr=$_GET["id"];

          $consulta="SELECT REUNION.ID,REUNION.FECHA,REUNION.HORA,REUNION.CIUDAD,REUNION.DIRECCION FROM reunion WHERE REUNION.ID='$id_rrr'";
          $respuesta=mysqli_query($cnn,$consulta);      
          while($traer=mysqli_fetch_assoc($respuesta)){
            $id_reunion=$traer["ID"];
            $fecha_reunion=$traer["FECHA"];
            $hora_reunion=$traer["HORA"];
                        $ciudad=$traer["CIUDAD"];
                        $direccion=$traer["DIRECCION"];
          ?>

              <?php };?>

        </div>
      </div>


  <form method="post">
    <div class="container shadow p-3 mb-5 bg-white rounded">
      <div class="row">
        <div class="col-12">
          <h4 class="center">Agendar Reunión</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-3">
          <h5><b>Fecha:</b></h5>
        </div>
        <div class="col-9">
          <input type="date" name="txt_f" class="form-control" value="<?php echo $fecha_reunion;?>">
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-3">
          <h5><b>Hora:</b></h5>
        </div>
        <div class="col s9">
          <input type="time" name="txt_h" class="form-control" value="<?php echo $hora_reunion;?>">
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-3">
          <h5><b>Ciudad:</b></h5>
        </div>
        <div class="col-9">
              <select name="txt_c" class="form-control" value="<?php echo $ciudad;?>">
                <option value="" disabled selected><?php echo $ciudad;?></option>
                <option value="Región Metropolitana">Región Metropolitana</option>
                <option value="XV Arica y Parinacota">XV Arica y Parinacota</option>
                <option value="I Tarapacá">I Tarapacá</option>
                <option value="II Antofagasta">II Antofagasta</option>
                <option value="III Atacama">III Atacama</option>
                <option value="IV Coquimbo">IV Coquimbo</option>
                <option value="V Valparaíso">V Valparaíso</option>
                <option value="VI OHiggins">VI O'Higgins</option>
                <option value="VII Maule">VII Maule</option>
                <option value="VIII Biobío">VIII Biobío</option>
                <option value="IX La Araucanía">IX La Araucanía</option>
                <option value="XIV Los Ríos">XIV Los Ríos</option>
                <option value="X Los Lagos">X Los Lagos</option>
                <option value="XI Aysén">XI Aysén</option>
                <option value="XII Magallanes y Antártica">XII Magallanes y Antártica</option>
              </select>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-3">
          <h5><b>Dirección</b></h5>
        </div>
        <div class="col-9">
          <input type="text" name="txt_d" class="form-control" value="<?php echo $direccion;?>">
        </div>
      </div>
      <br>
      <hr>
      <div class="row">
        <div class="col-12">
        <input type="submit" name="agendar" class="btn btn-primary" value="Eliminar">
        </div>
      </div>
      <br>
    </div>
    <br>
    <br>
  </form>










  <?php 
   if(isset($_POST["agendar"])) 
    {
        $id_rrr=$_GET["id"];
        $fecha=$_POST["txt_f"];
        $hora=$_POST["txt_h"];
        $ciudad=$_POST["txt_c"];
        $direccion=$_POST["txt_d"];

            $sql="DELETE FROM reunion WHERE id='$id_rrr'";
            mysqli_query($cnn,$sql);
            header("Location:miperfil.php");


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