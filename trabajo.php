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
                    header("Location:principal.php");
                    }
                ?>
        </div>
      </div>
    </nav>
  </header>
	<br>
	 <?php 
			$id_trabajo= $_GET['id_de_trabajo']; 
		    $sql_tra=" SELECT COUNT(envios_curriculum.oferta_laboral) as solicitantes,ofertas_laborales.id,ofertas_laborales.rut_empresa,ofertas_laborales.titulo,ofertas_laborales.nombre_empresa,ofertas_laborales.descripcion_trabajo,ofertas_laborales.lugar_trabajo,ofertas_laborales.fecha_publicacion,ofertas_laborales.salario,ofertas_laborales.tipo_puesto,ofertas_laborales.area,usuario.ruta_imagen,ofertas_laborales.Experiencia,ofertas_laborales.Tipo_empleo,ofertas_laborales.Funciones
                  FROM ofertas_laborales,usuario,envios_curriculum
                  WHERE(ofertas_laborales.rut_empresa=usuario.rut) AND (ofertas_laborales.id=envios_curriculum.oferta_laboral) AND (ofertas_laborales.id='$id_trabajo')";
        mysqli_query($cnn,$sql_tra);
        $res1=mysqli_query($cnn,$sql_tra);           
        while($fila=mysqli_fetch_assoc($res1)){
          $date=date_create($fila["fecha_publicacion"]);
          $soli= $fila['solicitantes'] ;
      ?>
	<form method="post">
		<div class="container">
			<div class="row">
				<div class="col-8 shadow p-3 mb-5 bg-white rounded">
					<div class="row">
						<div class="col-md-12">
							<img src="<?php echo($fila['ruta_imagen']);?>" alt="" style="width: 150px; height: 100px; border: 1px solid black;">
							<div class="row">
								<div class="col-12">
									<h4><?php echo($fila['titulo']);?></h4>
								</div>
							</div>
							<div class="row">
								<div class="col-3">
									<h6>
										<b>
											<a href="miperfil_empresa.php?empresa=<?php echo($fila['rut_empresa']);?>&nombre=<?php echo($fila['nombre_empresa']);?>" style="color: black;"><?php echo($fila['nombre_empresa']);?></a> 
										</b>
									</h6>
								</div>
								<div class="col-9">•
								<img src="img/map.png" alt="">
								<?php echo(utf8_encode($fila['lugar_trabajo']));?>
								</div>
							</div>
							<div class="row">
								<div class="col-12">
									Publicado: <?php echo(utf8_encode(date_format($date, 'd/m/Y')));?> • Solicitantes: <?php if($soli==0){
										echo "No hay solicitantes";
									}else{
										echo "$soli";
									} ?>
								</div>
							</div>
							<div class="row">
								<div class="col-6"></div>
								<div class="col-6">
									<input type="submit" name="solicitar" value="Solicitar Empleo" class="btn btn-outline-primary" style="float: right;">
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-8">
									<p>Descripción del empleo</p>
									<br>
									<p><?php echo(utf8_encode($fila['descripcion_trabajo']));?></p>
								</div>
								<div class="col-4">
									<div class="row">
										<div class="col-12">
											<h6>Detalles del empleo</h6>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-12">
											<p style="margin-bottom: 0px;">Nivel de experiencia: </p>
											<?php echo(utf8_encode($fila['Experiencia']));?>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-12">
											<p style="margin-bottom: 0px;">Sector: </p>
											<?php echo(utf8_encode($fila['area']));?>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-12">
											<p style="margin-bottom: 0px;">Tipo de empleo: </p>
											<?php echo(utf8_encode($fila['Tipo_empleo']));?>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-12">
											<p style="margin-bottom: 0px;">Funciones laborales: </p>
											<?php echo(utf8_encode($fila['Funciones']));?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
							
				</div>
			</div>
		</div>
	</form>
	<?php } 
	if ($_POST['solicitar']=="Solicitar Empleo") {
		$id_trabajo= $_GET['id_de_trabajo']; 
		$rut=$_SESSION['$varut'];
		$total=mysqli_num_rows(mysqli_query($cnn,"SELECT rut FROM cv WHERE rut='$rut'"));
		$total1=mysqli_num_rows(mysqli_query($cnn,"SELECT rut FROM test WHERE rut='$rut'"));
		$total2=mysqli_num_rows(mysqli_query($cnn,"SELECT rut_postulante FROM envios_curriculum WHERE (oferta_laboral='$id_trabajo') AND (rut_postulante='$rut')"));
		if($total==0){
			?>
			<script>alert('<?php echo $_SESSION['$vanombre']?>, Usted aun no completa su curriculum, para poder postular a esta oferta por favor complete su curriculum')</script>
			<?php
		}else{
			if($total1==0){
				?>
				<script>alert('<?php echo $_SESSION['$vanombre']?>, Aun no completa su test, por favor complete su test antes de enviar su curriculum.')</script>
				<?php
			}else{
				if($total2==1){
					?>
					<script>alert('<?php echo $_SESSION['$vanombre']?>, Usted ya envio exitosamente su curriculum, Por favor espere a que la empresa se ponga en contacto con usted.')</script>
					<?php
				}else{
					//traer datos
					$rut=$_SESSION['$varut'];
                    $id_trabajo= $_GET['id_de_trabajo']; 
                    $traer="SELECT rut_empresa FROM ofertas_laborales WHERE (id='$id_trabajo')";
                    $resul=mysqli_query($cnn,$traer);
                    if($fila=mysqli_fetch_array($resul)){
                    	$rut_empresa=$fila["rut_empresa"];
                    }
                    $traercv="SELECT id FROM cv WHERE rut='$rut'";
                          mysqli_query($cnn,$traercv);
                          $result=mysqli_query($cnn,$traercv);
                          if($fi = mysqli_fetch_array($result)){
                            $cv = $fi["id"];
                    }
                    $traertest="SELECT id FROM test WHERE rut='$rut'";
                          mysqli_query($cnn,$traertest);
                          $res=mysqli_query($cnn,$traertest);
                          if($fil = mysqli_fetch_array($res)){
                            $test = $fil["id"];
                    }
                    //termino de traer Datos
                    $registrar="INSERT INTO envios_curriculum (rut_postulante,rut_empresa,nota_test,cv,oferta_laboral) VALUES ('$rut','$rut_empresa','$test','$cv','$id_trabajo')";
                     mysqli_query($cnn,$registrar);
				}
			}
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


	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/main1.js"></script>


</body>
</html>
<?php
ob_end_flush();
?>	