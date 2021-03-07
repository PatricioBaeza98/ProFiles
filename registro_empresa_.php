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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Registro de Empresas</title>
    <script src="js/rutvalidar.js" type="text/javascript"></script>
</head>
<style>
body{
    background-color: #FFFFFF;
}
.registro{
width:500px;
margin:50px auto;
font: Arial;
border-radius:0px;
border:2px solid #EDEAEA;
padding:10px 40px 25px;
margin-top:70px;
background-color: #EDEAEA;
}
input[type=text], input[type=password], input[type=email], select{
width:99%;
padding:10px;
margin-top:8px;
border:1px solid #ccc;
padding-left:5px;
font-size:16px;
font-family: Arial; 
}

.nav
{
    padding: 10px 10px;
    margin: 30px auto;
    background: #52B53E;
    text-align: center;
    font-size: x-large;
}

.nav ul
{
    list-style: none;
}
.menu > li
{
    position: relative;
    display: inline-block;
}
.menu > li > a
{
    display: block;
    color: #FFFFFF;
    text-decoration: none;
    padding: 0px 50px;
}
.menu li a:hover
{
    color: #7A7B7A;
    transition: all .3s;
}

</style>
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
                            <a href="registro_empresa_.php" class="nav-link">Registro de Empresas</a>
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

<div class="registro">

    <form method="POST" action="" style="text-align: center;" autocomplete="off">

        <center> <img src="img/reg.png"> </center>

        


        <input type="text" name="rut" placeholder="Rut de la Empresa" required required oninput="valRut(this)">

        <input type="text" name="nombre_e" placeholder="Nombre Empresa" required>

        <input type="text" name="userreg" placeholder="Nombre de Usuario">

        <input type="text" name="nombre" placeholder="Nombre" required>
    
        <input type="text" name="apellidos" placeholder="Apellido" required>

        <select name="sel">
            <option value="" disabled selected>Seleccione su Sexo</option>
            <option value="Masculino">Masculino</option>
            <option value="Femenino">Femenino</option>
        </select>
    
        <input type="password" name="pwreg" placeholder="Contraseña"> </td>
        
        <input type="email" name="email" placeholder="Correo">
        
        <br><br>
        <input type="submit" name="registrar" value="Registrar" class="btn btn-outline-primary">

    </form>
</div>




    <?php 
        if($_POST['registrar']=="Registrar"){

            $rut = $_POST['rut'];
            $nombre_e = $_POST['nombre_e'];
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $nom = $_POST['userreg'];
            $pw = $_POST['pwreg'];
            $correo = $_POST['email'];
            $sexo=$_POST['sel'];

            $insertar="INSERT INTO usuario (rut,nombre,apellido,correo,sexo,tipo,nombre_empresa,usua,pass,ruta_imagen) VALUES ('$rut','$nombre','$apellidos','$correo','$sexo','1','$nombre_e','$nom','$pw','fotos/default.jpg')";
            mysqli_query($cnn,$insertar);
            header("Location:admin.php");
            echo "<script>alert('Se ha ingresado correctamente.')</script>";

        }

        ?>






</body>
</html>




<?php
ob_end_flush();
?>