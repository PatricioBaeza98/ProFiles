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
//export.php  
$connect = mysqli_connect("localhost", "root", "", "proyectod");
$output = '';
if(isset($_POST["export"]))
{

 $query = "SELECT reunion.id, reunion.fecha, reunion.hora, reunion.ciudad, reunion.direccion,seleccion.rut_empresa,usuario.rut,usuario.nombre,usuario.apellido,ofertas_laborales.titulo FROM reunion,seleccion,usuario,ofertas_laborales WHERE (reunion.id_trabajo_seleccionado=seleccion.id) AND (seleccion.rut_cv=usuario.rut) AND (seleccion.id_oferta=ofertas_laborales.id) AND (seleccion.rut_empresa='$rut')";
 $result = mysqli_query($connect, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
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
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>  
                         <td>'.$row["id"].'</td>  
                         <td>'.$row["fecha"].'</td>  
                         <td>'.$row["hora"].'</td>
                         <td>'.$row["ciudad"].'</td> 
                         <td>'.$row["direccion"].'</td>
                         <td>'.$row["nombre"].'</td>
                         <td>'.$row["apellido"].'</td>
                         <td>'.$row["titulo"].'</td>          

                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=profiles_reunion.xls');
  echo $output;
 }
}
?>

<?php
ob_end_flush();
?>