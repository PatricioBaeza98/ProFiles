<?php
ob_start();
session_start();
if(!isset($_SESSION['$varut'])){
    header('Location:index.php');
}
include("../../funciones.php");
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
        $listar="SELECT sexo FROM usuario WHERE rut='$rut'";
        $resultado=mysqli_query($cnn,$listar);
        while($rs=mysqli_fetch_array($resultado)){
            $sex= $rs['sexo'] ;
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
                        <li class="nav-item">
                            <a href="../../cursos.php" class="nav-link">Cursos PROFILES</a>
                        </li>
                    </ul>

                    <form class="form-inline my-2 my-lg-0" method="post">
                        <button class="btn btn-primary my-2 my-sm-0" type="submit" name="btncerrar">Cerrar Sesión</button>
                    </form>
                    <?php
                    if (isset($_POST["btncerrar"])) {
                        session_start();
                        session_destroy();
                        header("Location:../../index.php");
                        }
                    ?>
                </div>
            </div>
        </nav>
    </header>

    <br>

<script type="text/javascript">
    function ventanaNueva(documento){   
    window.open(documento,'nuevaVentana','width=900, height=600');
}
</script>

<div style="text-align: center;">
<h3>Bienvenido al curso de HTML</h3>
<h5>Acá tendras todo el material nesesario para luego poder realizar la prueba que se encuentras en la parte inferior</h5>
<h5>La prueba solo se podra realizar una vez, por lo tanto utiliza de forma responsable el material de estudio</h5>
</div>
<br>
<br>
<div style="text-align: center;">
<input class="btn btn-primary center" type="button" value="MATERIAL UNO" onclick="ventanaNueva('pdf1.pdf')" />
-
<input class="btn btn-primary center" type="button" value="MATERIAL DOS" onclick="ventanaNueva('pdf2.pdf')" />
-
<input class="btn btn-primary center" type="button" value="MATERIAL TRES" onclick="ventanaNueva('pdf4.pdf')" />
-
<input class="btn btn-primary center" type="button" value="MATERIAL CUATRO" onclick="ventanaNueva('pdf5.pdf')" />
</div>
<br>
<br>

    <?php
        $rut=$_SESSION['$varut'];
        $id_cursos=$_GET["id"];
        $hola123="SELECT cursos.id FROM usuario,cursos WHERE (usuario.rut=cursos.rut) and (usuario.rut='$rut') and (cursos.nombre_curso='HTML BASICO') ";
        mysqli_query($cnn,$hola123);
        $resultado123=mysqli_query($cnn,$hola123);
        if($fi123 = mysqli_fetch_array($resultado123)){
            $nota_final = $fi123["nota_curso"];
            $nota_final = $fi123["aprobado"];
            $id_cursos=$fi123["id"];     

        }
    ?>

    <footer class="container">
        <div class="row border-top py-5">
            <div class="col text-right">
            <h6 style="text-align: left;">Realizar prueba única: <a href="examen_html.php?id=<?php echo $id_cursos;?>">ENTRAR</a> </h6>
                <a href="examen_html.php" class="btn btn-link">Subir en Pagina</a>
                <p>© 2019 NOMBREAUTOR Todos los derechos reservados.</p>
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