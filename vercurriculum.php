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
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Seleccionar</title>
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
				<a href="empresa.php" class="navbar-brand">
			<?php if($sex=="Masculino"){
            ?> Bienvenido
            <?php
          	}else{
            ?>Bienvenida
            <?php
         	 } 
         	 ?>
         	 <?php echo $_SESSION['$nombre_empresa'];?></a>
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

<?php

$traerp= "SELECT id,prueba,especialidad FROM pruebas";
  $rs4=mysqli_query($cnn,$traerp);
  while($row4=mysqli_fetch_array($rs4)){
    $id=$row4["id"];
    $prueba=$row4["prueba"];
    $especialidad=$row4["especialidad"];
  }

?>


	<?php 
      $rut=$_SESSION['$varut'];
      $consulta = "SELECT ofertas_laborales.titulo,ofertas_laborales.id FROM ofertas_laborales WHERE (rut_empresa='$rut')";
      $rs2=mysqli_query($cnn,$consulta);
  ?>
     
  <br>
        <?php 
         $idd=$_GET['id'];
         $rutt = $_GET['rut'];
         $resu = "SELECT usuario.nombre,usuario.apellido,usuario.correo,usuario.telefono,usuario.sexo,usuario.ruta_imagen,cv.salario,cv.provincia,
            cv.ciudad,cv.calle,cv.colegio,cv.liceo,cv.instituto,cv.titulo,cv.nombre_empresa,
            cv.actividad_empresa,cv.puesto,cv.nivel_experiencia,cv.area_puesto,cv.subarea,
            cv.responsabilidades,cv.idioma,cv.nivel_oral,cv.nivel_escrito,cv.desde_mes,
            cv.desde_anio,cv.hasta_mes,cv.hasta_anio,cv.idioma,cv.nivel_oral,
            cv.nivel_escrito,cv.nacionalidad,cv.dia,cv.anio,cv.mes,test.respuesta,
            test.id,cv.prefijo_cel
             FROM  usuario,cv,test
             where (usuario.rut=cv.rut) AND (cv.id=test.cv) AND (cv.rut='$rutt')
          ";
          $rs3=mysqli_query($cnn,$resu);
          while ($row3=mysqli_fetch_array($rs3)){
            $nombre=$row3["nombre"];
            $apellido=$row3["apellido"];
            $correo=$row3["correo"];
            $telefono=$row3["telefono"];
            $sexo=$row3["sexo"];
            $foto=$row3["ruta_imagen"];
            $dia=$row3["dia"];
            $mes=$row3["mes"];
            $anio=$row3["anio"];
            $nacionalidad=$row3["nacionalidad"];
            $estado_civil=$row3["estado_civil"];
            $salario=$row3["salario"];
            $provincia=$row3["provincia"];
            $ciudad=$row3["ciudad"];
            $calle=$row3["calle"];
            $nombre_empresa=$row3["nombre_empresa"];
            $actividad_empresa=$row3["actividad_empresa"];
            $puesto=$row3["puesto"];
            $nivel_experiencia=$row3["nivel_experiencia"];
            $area_puesto=$row3["area_puesto"];
            $subarea=$row3["subarea"];
            $colegio=$row3["colegio"];
            $liceo=$row3["liceo"];
            $instituto=$row3["instituto"];
            $titulo=$row3["titulo"];
            $pre=$row3["prefijo_cel"];
            $desde_mes=$row3["desde_mes"];
            $desde_año=$row3["desde_anio"];
            $hasta_mes=$row3["hasta_mes"];
            $hasta_año=$row3["hasta_anio"];
            $responsabilidades=$row3["responsabilidades"];
            $idioma=$row3["idioma"];
            $nivel_oral=$row3["nivel_oral"];
            $nivel_escrito=$row3["nivel_escrito"];
            $respuesta=$row3["respuesta"];
            $test=$row3["id"];
            //$nombre_curso=$row3["nombre_curso"].$row3["nombre_curso"];
            //$nota_curso=$row3["nota_curso"];
        ?>
        <form method="post">
<div class="container">
                <div class="shadow-lg p-3 mb-5 bg-white rounded">
                <div class="col-12 ">
                  <div class="row">
                    <div class="col-12">
                      <h3 class="text-center">Curriculum Vitae</h3>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-3 p-1 mb-2 bg-primary text-white">
                      <h5>Datos Personales: </h5>
                    </div>
                  </div>
                   
                  <div class="row">
                    <div class="col 6">
                      <h6><?php echo utf8_encode($nombre) ?> <?php echo utf8_encode($apellido) ?></h6>
                      <h6><b>Tel: </b>(+<?php echo $pre ?>) <?php echo utf8_encode($telefono) ?></h6>
                      <h6><b>Dirección:</b> <?php echo utf8_encode($ciudad) ?>  <?php echo utf8_encode($calle) ?></h6>
                      <h6><b>Sexo:</b> <?php echo utf8_encode($sexo) ?></h6>
                      <h6><b>Correo Electronico:</b> <?php echo utf8_encode($correo) ?></h6>
                      <h6><b>Lugar de Nacimiento:</b> <?php echo utf8_encode($ciudad) ?>, <?php echo utf8_encode($dia) ?> de <?php echo utf8_encode($mes) ?> de <?php echo utf8_encode($anio) ?></h6>
                      <h6><b>Estado Civil:</b> <?php echo utf8_encode($estado_civil) ?></h6>
                      <h6><?php echo $ciudad ?> - <?php echo utf8_encode($nacionalidad) ?></h6>
                    </div>
                    <div class="col-4 right">
                      <img src="<?php echo $foto; ?>" style="border:2px solid; width: 200px; height: 200px; ">
                    </div>
                  </div> 
                  <hr>



                  <div class="row">
                    <div class="col-3 p-1 mb-2 bg-primary text-white">
                      <h5>Educación: </h5>
                    </div>
                  </div>     
                  <div class="row">
                    <div class="col-12">
                      <h6><b>Colegio:</b> <?php echo utf8_encode($colegio) ?></h6>
                      <h6><b>Liceo:</b> <?php echo utf8_encode($liceo) ?></h6>
                      <h6><b>Instituto o Universidad:</b> <?php echo utf8_encode($instituto) ?></h6>
                      <h6><b>Titulo:</b> <?php echo utf8_encode($titulo) ?></h6>
                    </div>
                  </div>
                  <hr>



                  <div class="row">
                    <div class="col-3 p-1 mb-2 bg-primary text-white">
                      <h5>Experiencia Laboral: </h5>
                    </div>
                  </div>          
                  <div class="row">
                    <div class="col-12">
                      <h6><b>Empresa: </b><?php echo utf8_encode($nombre_empresa) ?></h6>
                      <h6><b>Actividad: </b><?php echo utf8_encode($actividad_empresa) ?></h6>
                      <h6><b>Puesto: </b><?php echo utf8_encode($puesto) ?></h6>
                      <h6><b>Nivel Experiencia: </b><?php echo utf8_encode($nivel_experiencia) ?></h6>
                      <h6><b>Desde: </b><?php echo utf8_encode($desde_mes) ?> <?php echo utf8_encode($desde_año) ?> <b>Hasta: </b><?php echo utf8_encode($hasta_mes) ?> <?php echo utf8_encode($hasta_año) ?></h6>
                      <h6><b>Area: </b><?php echo utf8_encode($area_puesto) ?></h6>
                      <h6><b>SubArea: </b><?php echo utf8_encode($subarea) ?></h6>
                      <h6><b>Responsabilidades: </b><?php echo utf8_encode($responsabilidades) ?></h6>
                    </div>
                  </div>
                  <hr>



                  <div class="row">
                    <div class="col-3 p-1 mb-2 bg-primary text-white">
                      <h5>Idiomas: </h5>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <h6><b>Idioma: </b><?php echo utf8_encode($idioma) ?></h6>
                      <h6><b>Nivel Oral: </b><?php echo utf8_encode($nivel_oral) ?></h6>
                      <h6><b>Nivel Escrito: </b><?php echo utf8_encode($nivel_escrito) ?></h6>
                    </div>
                  </div>
                  <hr>



                  <div class="row">
                    <div class="col-3 p-1 mb-2 bg-primary text-white">
                      <h5>Test de Personalidad: </h5>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <h6><b>Nota:</b> <?php echo utf8_encode($respuesta) ?></h6>
                    </div>
                  </div>
                  <hr>
                   <div class="row">
                    <div class="col-6 p-1 mb-2 bg-primary text-white">
                      <h5>Cursos PROfiles realizados: </h5>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <h6>
                        <?php
                         $rutt = $_GET['rut'];
                        $traer_cursos="SELECT IFNULL(cursos.nombre_curso,'No tienes cursos realizados') as nombre_curso,IFNULL(cursos.nota_curso,'No tienes cursos realizados') as nota_curso,aprobado 
                        FROM cursos right join cv on (cursos.cv=cv.id)
                        WHERE (cv.rut='$rutt')";
                         $resultado_curso=mysqli_query($cnn,$traer_cursos);  
                         while($row5=mysqli_fetch_array($resultado_curso)){
                          $traerCur = $row5["nombre_curso"];
                          $nota_curso  = $row5["nota_curso"];
                         ?>
                        <b>Curso:</b> <?php echo utf8_encode($traerCur) ?>
                      </h6>
                      <h6><b>NOTA:</b> <?php echo utf8_encode($nota_curso) ?></h6>
                      <?php } ?>
                    </div>
                  </div>
                  <hr>



                  <div class="row">
                    <div class="col-3 p-1 mb-2 bg-primary text-white">
                      <h5>Seleccionar Prueba: </h5>
                    </div>
                  </div>

                      <?php 
                      
                      $traerofertat = "SELECT id,prueba,especialidad FROM pruebas";
                      $rs3t=mysqli_query($cnn,$traerofertat);
                      ?>
                      <div class="row">
                        <div class="input-field col-12 m6">
                          <select class="form-control" name="enviarprueba" id="prueba">
                            <option value="" disabled selected>Seleccionar Prueba</option>
                        <?php while ($row3t = mysqli_fetch_array($rs3t)){
                        $id_t = $row3t["id"];
                        $prueba_t=$row3t["prueba"];
                        $especialidad_t=$row3t["especialidad"];
                      ?>
                      <option  value="<?php echo ($id_t);?>"><?php echo ($especialidad_t);?></option>
                      <?php
                      }
                      ?>     
                      </select>
                      </div>
                    </div>
                    <hr>



                   <br>
                   <br>

                   <div class="row">
                     <div class="col-12">
                       <button class="btn btn-primary btn-lg btn-block" type="submit"  name="EnviarSeleccion">Enviar
                        </button>
                     </div>
                   </div>
                </div>
              </div>
              </div>
            </form>
            <?php   
        }
        if(isset($_POST["EnviarSeleccion"])){
        $link=$_POST["enviarprueba"];
        $idd=$_GET['id'];
        $rutt = $_GET['rut'];
        $rut=$_SESSION['$varut'];

         /*$traercv="SELECT id FROM test,cv WHERE (test.id=id.cv) AND (test.rut ='$rutt')";
                          mysqli_query($cnn,$traercv);
                          $result=mysqli_query($cnn,$traercv);
                          if($fi = mysqli_fetch_array($result)){
                            $test = $fi["id"];
                          }  -----Ya no ocupare el test-----  */

        $total = mysqli_num_rows(mysqli_query($cnn,"SELECT id_oferta
                                                    FROM seleccion
        WHERE (id_oferta='$idd') AND (rut_cv='$rutt') AND (rut_empresa='$rut')"));
         if ($total==1){
         echo "<script>alert('Ya enviamos esta misma oferta laboral al seleccionado, por favor seleccione otro o cancele la selección')</script>";
         }else{
           $registrar="INSERT INTO seleccion VALUES (null,'$rutt','$rut','$link','NULL','NULL','$idd')";
           mysqli_query($cnn,$registrar);
                        echo "<script>alert('Se envio correctamente la selección')</script>";
        }
      }
        ?>
      
	

	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php
ob_end_flush();
?>