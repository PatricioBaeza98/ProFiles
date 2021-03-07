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
$sql="SELECT seleccion.id,ofertas_laborales.titulo,ofertas_laborales.descripcion_trabajo,ofertas_laborales.salario,usuario.ruta_imagen,ofertas_laborales.lugar_trabajo,ofertas_laborales.fecha_publicacion,ofertas_laborales.tipo_puesto,ofertas_laborales.area,pruebas.prueba,pruebas.especialidad
FROM seleccion,ofertas_laborales,usuario,pruebas
WHERE (seleccion.id_oferta=ofertas_laborales.id) AND  (seleccion.test=pruebas.id) AND(usuario.rut=ofertas_laborales.rut_empresa) AND (rut_cv='$rut') AND (ofertas_laborales.estado='activa')";
mysqli_query($cnn,$sql);
$rs=mysqli_query($cnn,$sql);  
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
<style>
  .cuadro{
    border: 1px solid black;
  }
</style>
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
$rut=$_SESSION['$varut'];

$total = mysqli_num_rows(mysqli_query($cnn,"SELECT rut_cv FROM seleccion WHERE rut_cv='$rut'"));
if ($total==0) {
  ?>
  <div class="container shadow p-3 mb-5 bg-white rounded">
    <h1 class="center"><?php echo $_SESSION['$vanombre']?>, Lamentablemente no tenemos Ofertas para ti, por favor espera a que alguna empresa se ponga en contacto contigo o envia tu curriculum a nuestras distintas ofertas laborales que tenemos para ti en este <a href="cliente.php">Enlace</a>.</h1>
  </div>
    <?php
}else{
while($row=mysqli_fetch_assoc($rs)){
  $title=$row["titulo"];
  $desc=$row["descripcion_trabajo"];
  $test=$row["test"];
  $empresa=$row["nombre_empresa"];
  $salario=$row["salario"];
  $id=$row["id"];
  $imagen=$row["ruta_imagen"];
  $fecha = date_create($row["fecha_publicacion"]);
  $link = $row["prueba"];
 ?>
  <div class='container'>
   <form method="get">
      <div class="row">
        <div class="col-10 cuadro">
          <div class="card-panel z-depth-3">
            <div class="row">
              <div class="col-7">
                <h4 style="font-weight: bold"><?php echo utf8_encode($row['titulo']);?></h4>
              </div>
              <div class="col-3">
                <img src="<?php echo utf8_encode($row['ruta_imagen']);?>" style="width: 300px; height: 200px;">
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <h6 ><b>Lugar de Trabajo:</b> <?php echo utf8_encode($row['lugar_trabajo']);?></h6>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <h6 ><b>Fecha de Publicación:</b> <?php echo date_format($fecha, 'd/m/Y');?></h6>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <h6 ><b>Salario:</b> $<?php echo utf8_encode($row['salario']);?></h6>
              </div>
            </div>
             <div class="row">
              <div class="col-12">
                <h6 ><b>Tipo de Puesto:</b> <?php echo utf8_encode($row['tipo_puesto']);?></h6>
              </div>
            </div>
             <div class="row">
              <div class="col-12">
                <h6 ><b>Area:</b> <?php echo utf8_encode($row['area']);?></h6>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <p><?php echo utf8_encode($row['descripcion_trabajo']);?></p>
              </div>
            </div>
            <hr>
            <h5><?php if($sex=="Masculino"){ echo "Sr ".$_SESSION['$vanombre']; }else{ echo "Sra ".$_SESSION['$vanombre'];} ?>, Por favor realice la siguiente Prueba.</h5>
            <hr> 
            <div class="row">
              <div class="col-12">
                <a href="<?php echo($row['prueba']);?>?id=<?php echo($row['id']);?>"><?php echo($row['especialidad']);?></a>
              </div>
            </div> 
          </div>
        </div>
        <div class="col-4">
        
        </div>
      </div>
      <br>
   </form>
  </div>
 <?php
}
} 
?>


<footer class="container">
    <div class="row border-top py-5">
      <div class="col text-right">
        <a href="#" class="btn btn-link">Subir en Pagina</a>
      </div>
    </div>
  </footer>
 
</body>
</html>
<?php
ob_end_flush();
?>