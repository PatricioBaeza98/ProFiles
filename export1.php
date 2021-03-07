<?php ob_start(); 
session_start();
if(!isset($_SESSION['$varut'])){
  header('Location:index.php');
}
include("funciones.php"); error_reporting(0);$cnn=Conectar(); 
$rut=$_SESSION['$varut']; $sql = "SELECT nombre_empresa  FROM usuario WHERE rut='$rut'";
$rs=mysqli_query($cnn,$sql);  
if (mysqli_num_rows($rs)!=0){
  if ($row=mysqli_fetch_array($rs)){
    $_SESSION['$nombre_empresa'] = $row['nombre_empresa'];
  }
}
$nombre_empresa=$_SESSION['$nombre_empresa'];
$sql1="SELECT rut,nombre,apellido,correo,telefono,sexo,puesto,direccion,usua,pass,ruta_imagen,portada_empresa from usuario WHERE rut='$rut'";
mysqli_query($cnn,$sql1);
$rs=mysqli_query($cnn,$sql1);  
$row=mysqli_fetch_assoc($rs);
?>

<?php
$connect = mysqli_connect("localhost", "root", "", "proyectod");

$sql = "SELECT reunion.id, reunion.fecha, reunion.hora, reunion.ciudad, reunion.direccion,seleccion.rut_empresa,usuario.rut,usuario.nombre,usuario.apellido,ofertas_laborales.titulo FROM reunion,seleccion,usuario,ofertas_laborales WHERE (reunion.id_trabajo_seleccionado=seleccion.id) AND (seleccion.rut_cv=usuario.rut) AND (seleccion.id_oferta=ofertas_laborales.id) AND (seleccion.rut_empresa='$rut')";  
$result = mysqli_query($connect, $sql);
?>
<html>  
 <head>  
  <title>Exportar Reuniones - Excel</title>  
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
 </head>  
 <body>  
  <div class="container">  
   <br>  
   <br>  
   <br>  
   <div class="table-responsive">  
    <h2 align="center" style="text-decoration: underline;">Exportar Reuniones a Excel</h2>
    <br> 
    <table class="table table-bordered" style="text-align: center;">
     <tr>  
                         <th>ID REUNION</th>  
                         <th>FECHA</th>  
                         <th>HORA</th>
                         <th>CIUDAD</th>
                         <th>DIRECCION</th>
                         <th>NOMBRE</th>
                         <th>APELLIDO</th>
                         <th>PUESTO</th>
                    </tr>
     <?php
     while($row = mysqli_fetch_array($result))  
     {  
        echo '  
       <tr>  
         <td>'.utf8_encode($row["id"]).'</td>  
         <td>'.utf8_encode($row["fecha"]).'</td>  
         <td>'.utf8_encode($row["hora"]).'</td> 
         <td>'.utf8_encode($row["ciudad"]).'</td> 
         <td>'.utf8_encode($row["direccion"]).'</td>
         <td>'.utf8_encode($row["nombre"]).'</td>
         <td>'.utf8_encode($row["apellido"]).'</td>
         <td>'.utf8_encode($row["titulo"]).'</td>   
       </tr>  
        ';  
     }
     ?>
    </table>
    <br />
    <form method="post" action="export.php">
     <input type="submit" name="export" class="btn btn-primary" value="Exportar" />
     <a href="miperfil.php" class="btn btn-danger" style="text-decoration: none; color:white;">Volver</a>
    </form>
   </div>  
  </div>  
 </body>  
</html>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

<?php
ob_end_flush();
?>