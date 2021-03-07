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
$sql1="SELECT usuario.nombre as nom, usuario.apellido as ape,usuario.correo as corre,usuario.telefono as tel,usuario.sexo as sex from usuario where rut='$rut'";
$sql="SELECT usuario.rut as rut,cv.id as id ,usuario.rut as rut,cv.dia as dia,cv.mes as mes,cv.anio as anio,cv.nacionalidad as nacionalidad,cv.estado_civil as estado_civil,cv.salario as salario,cv.prefijo_cel as pre,cv.provincia as provincia,cv.ciudad as ciudad,cv.calle as calle,cv.colegio as colegio,cv.liceo as liceo,cv.instituto as instituto,cv.titulo as titulo,cv.nombre_empresa as nombre_empresa,cv.actividad_empresa as actividad_empresa,cv.puesto as puesto,cv.nivel_experiencia as nivel_experiencia,cv.desde_mes as desde_mes,cv.desde_anio as desde_anio,cv.hasta_mes as hasta_mes,cv.hasta_anio as hasta_anio,cv.area_puesto as area_puesto,cv.subarea as subarea,cv.responsabilidades as responsabilidades,cv.idioma as idioma,cv.nivel_oral as nivel_oral,cv.nivel_escrito as nivel_escrito from usuario,cv WHERE (usuario.rut=cv.rut) AND (usuario.rut='$rut')";
mysqli_query($cnn,$sql);
mysqli_query($cnn,$sql1);
$rs1=mysqli_query($cnn,$sql1);  
$row1=mysqli_fetch_assoc($rs1);
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
	<style>
		.gen{
			position: relative;
			top: 32px;
		}
	</style>
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
        $traerfoto="SELECT ruta_imagen FROM usuario WHERE rut='$rut'";
        mysqli_query($cnn,$traerfoto);
        $result=mysqli_query($cnn,$traerfoto);
        if($fi = mysqli_fetch_array($result)){
            $foto = $fi["ruta_imagen"];
        }
    ?>
	<br>
	<form action="" method="post">	
	<div class="container shadow p-3 mb-5 bg-white rounded">
		<div class="row">
			<div class="col-12">
				<h3>Datos Personales</h3>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-6">
				<label for="nombre">Nombre</label>
				<input type="text" name="datosnombre" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="<?php echo($row1['nom']);?>" name="datosnombre" disabled>
			</div>
			<div class="col-6">
				<label for="apellido">Apellido</label>
				<input type="text" name="datosapellido" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="<?php echo($row1['ape']);?>" name="datosapellido" disabled>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-2">
				<label for="">Fecha de nacimiento</label>
				<select name="datosdia"  class="form-control" id="datosdia">
					<option value="<?php echo($row['dia']);?>"><?php echo($row['dia']);?></option>
					<option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                    <option value="31">31</option>
				</select>
			</div>
			<div class="col-2">
				<select name="datosmes"  class="form-control gen">
					<option value="<?php echo($row['mes']);?>" ><?php echo($row['mes']);?></option>
					<option value="Enero">Enero</option>
	              	<option value="Febrero">Febrero</option>
	              	<option value="Marzo">Marzo</option>
	              	<option value="Abril">Abril</option>
	             	<option value="Mayo">Mayo</option>
	                <option value="Junio">Junio</option>
	                <option value="Julio">Julio</option>
	                <option value="Agosto">Agosto</option>
	                <option value="Septiembre">Septiembre</option>
	                <option value="Octubre">Octubre</option>
	                <option value="Noviembre">Noviembre</option>
	                <option value="Diciembre">Diciembre</option>
				</select>
			</div>
			<div class="col-2">
				<input type="text" name="datosaño" class="form-control gen" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="<?php echo($row['anio']);?>" maxlength="4"  minlength="4" onkeypress="ValidaSoloNumeros()" >
			</div>
			<div class="col-6">
				<label for="Generl">Genero *</label>
				<select  disabled="" id="icon_wc" name="datossexo" class="form-control">
			      <option ><?php echo($row1['sex']);?></option>
				</select>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-6">
				<label for="Nacionalidad">Nacionalidad *</label>
				<select  id="icon_wc" name="datospais" class="form-control">
					<option value="<?php echo($row['nacionalidad']);?>" ><?php echo($row['nacionalidad']);?></option>
	                <option value="Argentina">Argentina</option>
	                <option value="Bolivia">Bolivia</option>
	                <option value="Brasil">Brasil</option>
	                <option value="Chilena">Chilena</option>
	                <option value="Colombia">Colombia</option>
	                <option value="Ecuador">Ecuador</option>
	                <option value="Peru">Peru</option>
	                <option value="Paraguay">Paraguay</option>
	                <option value="Uruguay">Uruguay</option>
	                <option value="Venezuela">Venezuela</option>
				</select>
			</div>
			<div class="col-6">
				<label for="first_name">Estado Civil *</label>
				<select  id="icon_wc" name="datosestadocivil"  class="form-control">
					<option value="<?php echo($row['estado_civil']);?>"  ><?php echo($row['estado_civil']);?></option>
			        <option value="Soltero/a">Soltero/a</option>
			        <option value="Casado/a">Casado/a</option>
			        <option value="Union Libre">Unión Libre</option>
			        <option value="Divorciado/a">Divorciado/a</option>
					<option value="Pareja de Hecho">Pareja de Hecho</option>
					<option value="Viudo/a">Viudo/a</option>
				</select>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-12">
				<h3>Preferencia Salarial</h3>
			</div>
		</div>
		<hr>
		<br>
		<div class="row">
			<div class="col-12">
				<label for="first_name">Indicar salario bruto pretendido *</label>
				<input type="text" name="salario" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="<?php echo($row['salario']);?>" maxlength="13"  minlength="6" onkeypress="ValidaSoloNumeros()" >
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-12">
				<h3>Datos de Contacto</h3>
			</div>
		</div>
		<hr>
		<br>
		<div class="row">
			<div class="col-4">
				<label for="first_name">Teléfono celular *</label>
				<input type="text" placeholder="Prefijo" id="first_name" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="prefijo_celular" value="<?php echo($row['pre']);?>" maxlength="2" minlength="2">
			</div>
			<div class="col-8">
				<input type="text" placeholder="Número" id="first_name" class="form-control gen" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="numero_celular" value="<?php echo($row1['tel']);?>" maxlength="9" minlength="9" disabled>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-12">
				<label for="first_name">Email *</label>
				<input type="text" placeholder="Email" id="first_name" type="email" class="form-control" name="email" value="<?php echo($row1['corre']);?>" disabled>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-12">
				<label for="first_name">Ciudad *</label>
				<select  id="regiones" name="ciudad"  class="form-control">
			        <option value="<?php echo utf8_encode($row['ciudad']);?>"><?php echo utf8_encode($row['ciudad']);?></option>
				</select>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-12">
				<label for="first_name">Provincia *</label>
				<select  id="comunas" name="provincia"  class="form-control">
			        <option value="<?php echo($row['provincia']);?>"><?php echo($row['provincia']);?></option>
				</select>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-12">
				<label for="first_name">Dirección *</label>
				<input type="text" placeholder="Dirección" id="first_name" class="form-control" name="direccion" value="<?php echo(utf8_encode($row['calle']));?>" onkeypress="txNombres()" maxlength="30">
				<span class="helper-text" data-error="wrong" data-success="right">No es necesaria la dirección exacta.</span>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-12">
				<h3>Estudios</h3>
			</div>
		</div>
		<hr>
		<br>
		<div class="row">
			<div class="col-6">
				<label for="first_name">Colegio *</label>
				<input type="text" placeholder="Colegio" id="first_name" class="form-control" name="colegio" value="<?php echo($row['colegio']);?>" onkeypress="txNombres()" maxlength="30">
			</div>
			<div class="col-6">
				<label for="first_name">Liceo *</label>
				<input type="text" placeholder="Liceo" id="first_name" class="form-control" name="liceo" value="<?php echo($row['liceo']);?>" onkeypress="txNombres()" maxlength="30">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-6">
				<label for="first_name">Instituto o Universidad *</label>
				<input type="text" placeholder="Instituto o Universidad" id="first_name" class="form-control" name="instituto" value="<?php echo($row['instituto']);?>" onkeypress="txNombres()" maxlength="30">
			</div>
			<div class="col-6">
				<label for="first_name">Titulo *</label>
				<input type="text" placeholder="Titulo" id="first_name" class="form-control" name="titulo" value="<?php echo($row['titulo']);?>" onkeypress="txNombres()" maxlength="30">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-12">
				<h3>Especiencia laboral</h3>
			</div>
		</div>
		<hr>
		<br>
		<div class="row">
			<div class="col-6">
				<label for="first_name">Nombre de la empresa *</label>
				<input type="text" placeholder="Nombre de la empresa" id="first_name" class="form-control" name="nombre_empresa" value="<?php echo($row['nombre_empresa']);?>" onkeypress="txNombres()" maxlength="30">
			</div>
			<div class="col-6">
				<label for="first_name">Actividad de la empresa *</label>
				<select  id="icon_wc" name="actividad_empresa" class="form-control">
			      	<option value="<?php echo($row['actividad_empresa']);?>"><?php echo($row['actividad_empresa']);?></option>
                  	<option value="Arquitectura">Arquitectura</option>
                  	<option value="Comercio">Comercio</option>
                  	<option value="Construcción">Construcción</option>
                  	<option value="Defensa">Defensa</option>
                  	<option value="Diseño">Diseño</option>
                  	<option value="Gastronomia">Gastronomia</option>
                  	<option value="Gobierno">Gobierno</option>
                  	<option value="Informatica / Tecnologia">Informatica / Tecnologia</option>
                  	<option value="Quimica">Quimica</option>
                  	<option value="Salud">Salud</option>
				</select>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-6">
				<label for="first_name">Puesto*</label>
				<input type="text" placeholder="Puesto de la empresa" id="first_name" class="form-control" name="puesto" value="<?php echo($row['puesto']);?>" onkeypress="txNombres()" minlength="4" maxlength="30">
			</div>
			<div class="col-6">
				<label for="first_name">Nivel de Experiencia *</label>
				<select  id="icon_wc" name="nivel_experiencia" class="form-control">
					<option value="<?php echo($row['nivel_experiencia']);?>"><?php echo($row['nivel_experiencia']);?></option>
			        <option value="Training">Training</option>
			        <option value="Junior">Junior</option>
			        <option value="SemiSenior">SemiSenior</option>
			        <option value="Senior">Senior</option>
				</select>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-3">
				<label for="first_name">Desde *</label>
				<select  id="icon_wc" name="desde_mes" class="form-control">
					<option value="<?php echo($row['desde_mes']);?>"><?php echo($row['desde_mes']);?></option>
			        <option value="Enero">Enero</option>
			        <option value="Febrero">Febrero</option>
			        <option value="Marzo">Marzo</option>
			        <option value="Abril">Abril</option>
			        <option value="Mayo">Mayo</option>
			        <option value="Junio">Junio</option>
			        <option value="Julio">Julio</option>
			        <option value="Agosto">Agosto</option>
			        <option value="Septiembre">Septiembre</option>
			        <option value="Octubre">Octubre</option>
			        <option value="Noviembre">Noviembre</option>
			        <option value="Diciembre">Diciembre</option>
				</select>
			</div>
			<div class="col-3">
				<input type="text" name="desde_año" value="<?php echo($row['desde_anio']);?>" maxlength="4"  minlength="4" id="first_name" class="form-control gen" onkeypress="ValidaSoloNumeros()">
			</div>
			<div class="col-3">
				<label for="first_name">Hasta *</label>
				<select  id="icon_wc" name="hasta_mes" class="form-control">
					<option value="<?php echo($row['hasta_mes']);?>"><?php echo($row['hasta_mes']);?></option>
			        <option value="Enero">Enero</option>
			        <option value="Febrero">Febrero</option>
			        <option value="Marzo">Marzo</option>
			        <option value="Abril">Abril</option>
			        <option value="Mayo">Mayo</option>
			        <option value="Junio">Junio</option>
			        <option value="Julio">Julio</option>
			        <option value="Agosto">Agosto</option>
			        <option value="Septiembre">Septiembre</option>
			        <option value="Octubre">Octubre</option>
			        <option value="Noviembre">Noviembre</option>
			        <option value="Diciembre">Diciembre</option>
				</select>
			</div>
			<div class="col-3">
				<input type="text" name="hasta_año" value="<?php echo($row['hasta_anio']);?>" maxlength="4"  minlength="4" id="first_name" class="form-control gen" onkeypress="ValidaSoloNumeros()">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-6">
				<label for="first_name">Área del puesto * </label>
				<input   placeholder="Área del puesto" id="first_name" type="text" class="form-control" name="area_puesto" value="<?php echo($row['area_puesto']);?>" onkeypress="txNombres()" maxlength="15">
			</div>
			<div class="col-6">
				<label for="first_name">Subárea * </label>
				 <input  placeholder="Subárea" id="first_name" type="text" class="form-control" name="subarea" value="<?php echo($row['subarea']);?>" onkeypress="txNombres()" maxlength="15">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-12">
				<label for="first_name">Descripción de responsabilidades *</label>
				<textarea name="descripcion_responsabilidad" style="resize: none;" class="form-control" id="textarea1" cols="30" rows="5"><?php echo utf8_encode($row['responsabilidades']);?></textarea>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-12">
				<h3>Idiomas</h3>
			</div>
		</div>
		<hr>
		<br>
		<div class="row">
			<div class="col-6">
				<label for="first_name">Idioma *</label>
				<select  id="icon_wc" name="idioma_lengua" class="form-control">
					<option value="<?php echo utf8_encode($row['idioma']);?>"><?php echo utf8_encode($row['idioma']);?></option>
			        <option value="Aleman">Aleman</option>
			        <option value="Chino">Chino Mandarin</option>
			        <option value="Coreano">Coreano</option>
			        <option value="Español">Español</option>
			        <option value="Frances">Frances</option>
			        <option value="Holandes">Holandes</option>
			        <option value="Ingles">Ingles</option>
			        <option value="Italiano">Italiano</option>
			        <option value="Japones">Japones</option>
			        <option value="Portugues">Portugues</option>
				</select>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-6">
				<label for="first_name">Nivel Oral * </label>
				<select  id="icon_wc" name="idioma_nivel_oral" class="form-control">
					<option value="<?php echo($row['nivel_oral']);?>"><?php echo($row['nivel_oral']);?></option>
			        <option value="Basico">Basico</option>
			        <option value="Intermedio">Intermedio</option>
			        <option value="Avanzado">Avanzado</option>
			        <option value="Nativo">Nativo</option>
				</select>
			</div>
			<div class="col-6">
				<label for="first_name">Nivel Escrito *</label>
				<select  id="icon_wc" name="idioma_nivel_escrito" class="form-control">
					<option value="<?php echo utf8_encode($row['nivel_escrito']);?>"><?php echo($row['nivel_escrito']);?></option>
			        <option value="Basico">Basico</option>
			        <option value="Intermedio">Intermedio</option>
			        <option value="Avanzado">Avanzado</option>
			        <option value="Nativo">Nativo</option>
				</select>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-3">
				<input type="submit" class="btn btn-primary my-2 my-sm-0" name="btnregistrar" value="Registrar">
			</div>
			<div class="col-3">
				<a href="crearPdf.php?id=<?php echo($row['id']);?>&rut_postulante=<?php echo($row['rut']);?>" class="btn btn-primary my-2 my-sm-0">Descargar PDF</a>
			</div>
			<div class="col-3">
				<button class="btn btn-primary my-2 my-sm-0" type="submit" name="btnActualizar">Actualizar</button>
			</div>
		</div>
	</div>
	</form>
	<br>
	<br>

	<footer class="container">
		<div class="row border-top py-5">
			<div class="col text-right">
				<a href="#" class="btn btn-link">Subir en Pagina</a>
			</div>
		</div>
	</footer>
	
	<?php 
	if ($_POST['btnregistrar']=="Registrar") {
		$rut=$_SESSION['$varut'];
      	$listar="SELECT rut FROM cv WHERE rut='$rut'";
     	$resultado=mysqli_query($cnn,$listar);
        while($rs=mysqli_fetch_array($resultado)){
            $Rutbd= $rs['rut'] ;
        }
        if ($Rutbd == $rut ) {
       ?> <script>alert('Ya Envio su curriculum por favor espere a que alguna empresa se ponga en contacto con usted <?php echo $_SESSION['$vanombre']?>')</script> 
       <?php 

  }else{
		$dia=utf8_decode($_POST["datosdia"]);
		$mes=utf8_decode($_POST["datosmes"]);
		$año=utf8_decode($_POST["datosaño"]);
		$nacionalidad=utf8_decode($_POST["datospais"]);
		$estado_civil=utf8_decode($_POST["datosestadocivil"]);
		$salario=utf8_decode($_POST["salario"]);
		$prefijo_celular=utf8_decode($_POST["prefijo_celular"]);
		$provincia=utf8_decode($_POST["provincia"]);
		$ciudad=utf8_decode($_POST["ciudad"]);
		$calle=utf8_decode($_POST["direccion"]);
		$colegio=utf8_decode($_POST["colegio"]);
		$liceo=utf8_decode($_POST["liceo"]);
		$instituto=utf8_decode($_POST["instituto"]);
		$titulo=utf8_decode($_POST["titulo"]);
		$nombre_empresa=utf8_decode($_POST["nombre_empresa"]);
		$actividad_empresa=utf8_decode($_POST["actividad_empresa"]);
		$puesto=utf8_decode($_POST["puesto"]);
		$nivel_experiencia=utf8_decode($_POST["nivel_experiencia"]);
		$desde_mes=utf8_decode($_POST["desde_mes"]);
		$desde_año=utf8_decode($_POST["desde_año"]);
		$hasta_mes=utf8_decode($_POST["hasta_mes"]);
		$hasta_año=utf8_decode($_POST["hasta_año"]);
		$area_puesto=utf8_decode($_POST["area_puesto"]);
		$correo=utf8_decode($_POST["email"]);
		$subarea=utf8_decode($_POST["subarea"]);
		$descripcion_responsabilidad=utf8_decode($_POST["descripcion_responsabilidad"]);
		$idioma_lengua=utf8_decode($_POST["idioma_lengua"]);
		$idioma_nivel_oral=utf8_decode($_POST["idioma_nivel_oral"]);
		$idioma_nivel_escrito=utf8_decode($_POST["idioma_nivel_escrito"]);
		if(empty($dia)||empty($mes)||empty($año)||empty($nacionalidad)||empty($estado_civil)||empty($salario)||empty($prefijo_celular)||empty($provincia)||empty($ciudad)||empty($calle)||empty($colegio)||empty($liceo)||empty($instituto)||empty($titulo)||empty($nombre_empresa)||empty($actividad_empresa)||empty($puesto)||empty($nivel_experiencia)||empty($desde_mes)||empty($desde_año)||empty($hasta_mes)||empty($hasta_año)||empty($area_puesto)||empty($subarea)||empty($descripcion_responsabilidad)||empty($idioma_lengua)||empty($idioma_nivel_oral)||empty($idioma_nivel_escrito) )
		{
			?>
			<script>alert('Todos los campos son obligatorios, deben contener datos')</script>
			<?php
		}else{
		$sql="INSERT into cv  VALUES (null,'$rut','$dia','$mes','$año','$nacionalidad','$estado_civil','$salario','$prefijo_celular','$provincia','$ciudad','$calle','$colegio','$liceo','$instituto','$titulo','$nombre_empresa','$actividad_empresa','$puesto','$nivel_experiencia','$desde_mes','$desde_año','$hasta_mes','$hasta_año','$area_puesto','$subarea','$descripcion_responsabilidad','$idioma_lengua','$idioma_nivel_oral','$idioma_nivel_escrito')";
		mysqli_query($cnn,$sql);
		//if($sql==true){
			header("Location:curriculum.php");
		//}
		echo "$sql";
		echo "<script>alert('Datos Guardados')</script>";
	}
}//cierra el if while
	}//cierra if  boton
	?>
	<?php 
	if(isset($_POST["btnActualizar"])){
		$dia=utf8_decode($_POST["datosdia"]);
		$mes=utf8_decode($_POST["datosmes"]);
		$año=utf8_decode($_POST["datosaño"]);
		$nacionalidad=utf8_decode($_POST["datospais"]);
		$estado_civil=utf8_decode($_POST["datosestadocivil"]);
		$salario=utf8_decode($_POST["salario"]);
		$prefijo_celular=utf8_decode($_POST["prefijo_celular"]);
		$provincia=utf8_decode($_POST["provincia"]);
		$ciudad=utf8_decode($_POST["ciudad"]);
		$calle=utf8_decode($_POST["direccion"]);
		$colegio=utf8_decode($_POST["colegio"]);
		$liceo=utf8_decode($_POST["liceo"]);
		$instituto=utf8_decode($_POST["instituto"]);
		$titulo=utf8_decode($_POST["titulo"]);
		$nombre_empresa=utf8_decode($_POST["nombre_empresa"]);
		$actividad_empresa=utf8_decode($_POST["actividad_empresa"]);
		$puesto=utf8_decode($_POST["puesto"]);
		$nivel_experiencia=utf8_decode($_POST["nivel_experiencia"]);
		$paiss=utf8_decode($_POST["Pais"]);
		$desde_mes=utf8_decode($_POST["desde_mes"]);
		$desde_año=utf8_decode($_POST["desde_año"]);
		$hasta_mes=utf8_decode($_POST["hasta_mes"]);
		$hasta_año=utf8_decode($_POST["hasta_año"]);
		$area_puesto=utf8_decode($_POST["area_puesto"]);
		$correo=utf8_decode($_POST["email"]);
		$subarea=utf8_decode($_POST["subarea"]);
		$descripcion_responsabilidad=utf8_decode($_POST["descripcion_responsabilidad"]);
		$idioma_lengua=utf8_decode($_POST["idioma_lengua"]);
		$idioma_nivel_oral=utf8_decode($_POST["idioma_nivel_oral"]);
		$idioma_nivel_escrito=utf8_decode($_POST["idioma_nivel_escrito"]);
		$rut=$_SESSION['$varut'];
		if(empty($dia)||empty($mes)||empty($año)||empty($nacionalidad)||empty($estado_civil)||empty($salario)||empty($prefijo_celular)||empty($provincia)||empty($ciudad)||empty($calle)||empty($colegio)||empty($liceo)||empty($instituto)||empty($titulo)||empty($nombre_empresa)||empty($actividad_empresa)||empty($puesto)||empty($nivel_experiencia)||empty($desde_mes)||empty($desde_año)||empty($hasta_mes)||empty($hasta_año)||empty($area_puesto)||empty($subarea)||empty($descripcion_responsabilidad)||empty($idioma_lengua)||empty($idioma_nivel_oral)||empty($idioma_nivel_escrito)){	
			?>
			<script>alert('Todos los campos son obligatorios, deben contener datos')</script>
			<?php
		}else{
		$actualizar="UPDATE cv 
		SET dia='$dia',mes='$mes',anio='$año',nacionalidad='$nacionalidad',estado_civil='$estado_civil',salario='$salario',prefijo_cel='$prefijo_celular',provincia='$provincia',ciudad='$ciudad',calle='$calle',colegio='$colegio',liceo='$liceo',instituto='$instituto',titulo='$titulo',nombre_empresa='$nombre_empresa',actividad_empresa='$actividad_empresa',puesto='$puesto',nivel_experiencia='$nivel_experiencia',desde_mes='$desde_mes',desde_anio='$desde_año',hasta_mes='$hasta_mes',hasta_anio='$hasta_año',area_puesto='$area_puesto',subarea='$subarea',responsabilidades='$descripcion_responsabilidad',idioma='$idioma_lengua',nivel_oral='$idioma_nivel_oral',nivel_escrito='$idioma_nivel_escrito' WHERE rut='$rut'";
		mysqli_query($cnn,$actualizar);
		if($actualizar==true){
			header("Location:curriculum.php");
		}
	}

	}
	?>
	<script src="js/jquery-3.3.1.min.js"></script>
	<script>
		var RegionesYcomunas = {

	"regiones": [{
			"NombreRegion": "Arica y Parinacota",
			"comunas": ["Arica", "Camarones", "Putre", "General Lagos"]
	},
		{
			"NombreRegion": "Tarapaca",
			"comunas": ["Iquique", "Alto Hospicio", "Pozo Almonte", "Camiña", "Colchane", "Huara", "Pica"]
	},
		{
			"NombreRegion": "Antofagasta",
			"comunas": ["Antofagasta", "Mejillones", "Sierra Gorda", "Taltal", "Calama", "Ollagüe", "San Pedro de Atacama", "Tocopilla", "María Elena"]
	},
		{
			"NombreRegion": "Atacama",
			"comunas": ["Copiapó", "Caldera", "Tierra Amarilla", "Chañaral", "Diego de Almagro", "Vallenar", "Alto del Carmen", "Freirina", "Huasco"]
	},
		{
			"NombreRegion": "Coquimbo",
			"comunas": ["La Serena", "Coquimbo", "Andacollo", "La Higuera", "Paiguano", "Vicuña", "Illapel", "Canela", "Los Vilos", "Salamanca", "Ovalle", "Combarbalá", "Monte Patria", "Punitaqui", "Río Hurtado"]
	},
		{
			"NombreRegion": "Valparaiso",
			"comunas": ["Valparaíso", "Casablanca", "Concón", "Juan Fernández", "Puchuncaví", "Quintero", "Viña del Mar", "Isla de Pascua", "Los Andes", "Calle Larga", "Rinconada", "San Esteban", "La Ligua", "Cabildo", "Papudo", "Petorca", "Zapallar", "Quillota", "Calera", "Hijuelas", "La Cruz", "Nogales", "San Antonio", "Algarrobo", "Cartagena", "El Quisco", "El Tabo", "Santo Domingo", "San Felipe", "Catemu", "Llaillay", "Panquehue", "Putaendo", "Santa María", "Quilpué", "Limache", "Olmué", "Villa Alemana"]
	},

		{
			"NombreRegion": "Region del Libertador Gral Bernardo OHiggins",
			"comunas": ["Rancagua", "Codegua", "Coinco", "Coltauco", "Doñihue", "Graneros", "Las Cabras", "Machalí", "Malloa", "Mostazal", "Olivar", "Peumo", "Pichidegua", "Quinta de Tilcoco", "Rengo", "Requínoa", "San Vicente", "Pichilemu", "La Estrella", "Litueche", "Marchihue", "Navidad", "Paredones", "San Fernando", "Chépica", "Chimbarongo", "Lolol", "Nancagua", "Palmilla", "Peralillo", "Placilla", "Pumanque", "Santa Cruz"]
	},
		
		{
			"NombreRegion": "Region del Maule",
			"comunas": ["Talca", "ConsVtución", "Curepto", "Empedrado", "Maule", "Pelarco", "Pencahue", "Río Claro", "San Clemente", "San Rafael", "Cauquenes", "Chanco", "Pelluhue", "Curicó", "Hualañé", "Licantén", "Molina", "Rauco", "Romeral", "Sagrada Familia", "Teno", "Vichuquén", "Linares", "Colbún", "Longaví", "Parral", "ReVro", "San Javier", "Villa Alegre", "Yerbas Buenas"]
	},
		{
			"NombreRegion": "Region del Biobio",
			"comunas": ["Concepción", "Coronel", "Chiguayante", "Florida", "Hualqui", "Lota", "Penco", "San Pedro de la Paz", "Santa Juana", "Talcahuano", "Tomé", "Hualpén", "Lebu", "Arauco", "Cañete", "Contulmo", "Curanilahue", "Los Álamos", "Tirúa", "Los Ángeles", "Antuco", "Cabrero", "Laja", "Mulchén", "Nacimiento", "Negrete", "Quilaco", "Quilleco", "San Rosendo", "Santa Bárbara", "Tucapel", "Yumbel", "Alto Biobío", "Chillán", "Bulnes", "Cobquecura", "Coelemu", "Coihueco", "Chillán Viejo", "El Carmen", "Ninhue", "Ñiquén", "Pemuco", "Pinto", "Portezuelo", "Quillón", "Quirihue", "Ránquil", "San Carlos", "San Fabián", "San Ignacio", "San Nicolás", "Treguaco", "Yungay"]
	},
		{
			"NombreRegion": "Region de la Araucania",
			"comunas": ["Temuco", "Carahue", "Cunco", "Curarrehue", "Freire", "Galvarino", "Gorbea", "Lautaro", "Loncoche", "Melipeuco", "Nueva Imperial", "Padre las Casas", "Perquenco", "Pitrufquén", "Pucón", "Saavedra", "Teodoro Schmidt", "Toltén", "Vilcún", "Villarrica", "Cholchol", "Angol", "Collipulli", "Curacautín", "Ercilla", "Lonquimay", "Los Sauces", "Lumaco", "Purén", "Renaico", "Traiguén", "Victoria", ]
	},
		{
			"NombreRegion": "Region de Los Rios",
			"comunas": ["Valdivia", "Corral", "Lanco", "Los Lagos", "Máfil", "Mariquina", "Paillaco", "Panguipulli", "La Unión", "Futrono", "Lago Ranco", "Río Bueno"]
	},
		{
			"NombreRegion": "Region de Los Lagos",
			"comunas": ["Puerto Montt", "Calbuco", "Cochamó", "Fresia", "FruVllar", "Los Muermos", "Llanquihue", "Maullín", "Puerto Varas", "Castro", "Ancud", "Chonchi", "Curaco de Vélez", "Dalcahue", "Puqueldón", "Queilén", "Quellón", "Quemchi", "Quinchao", "Osorno", "Puerto Octay", "Purranque", "Puyehue", "Río Negro", "San Juan de la Costa", "San Pablo", "Chaitén", "Futaleufú", "Hualaihué", "Palena"]
	},
		{
			"NombreRegion": "Region Aisen del Gral. Carlos Ibañez del Campo",
			"comunas": ["Coihaique", "Lago Verde", "Aisén", "Cisnes", "Guaitecas", "Cochrane", "O’Higgins", "Tortel", "Chile Chico", "Río Ibáñez"]
	},
		{
			"NombreRegion": "Region de Magallanes y de la AntarVca Chilena",
			"comunas": ["Punta Arenas", "Laguna Blanca", "Río Verde", "San Gregorio", "Cabo de Hornos (Ex Navarino)", "AntárVca", "Porvenir", "Primavera", "Timaukel", "Natales", "Torres del Paine"]
	},
		{
			"NombreRegion": "Region Metropolitana de Santiago",
			"comunas": ["Cerrillos", "Cerro Navia", "Conchalí", "El Bosque", "Estación Central", "Huechuraba", "Independencia", "La Cisterna", "La Florida", "La Granja", "La Pintana", "La Reina", "Las Condes", "Lo Barnechea", "Lo Espejo", "Lo Prado", "Macul", "Maipú", "Ñuñoa", "Pedro Aguirre Cerda", "Peñalolén", "Providencia", "Pudahuel", "Quilicura", "Quinta Normal", "Recoleta", "Renca", "San Joaquín", "San Miguel", "San Ramón", "Vitacura", "Puente Alto", "Pirque", "San José de Maipo", "Colina", "Lampa", "TilVl", "San Bernardo", "Buin", "Calera de Tango", "Paine", "Melipilla", "Alhué", "Curacaví", "María Pinto", "San Pedro", "Talagante", "El Monte", "Isla de Maipo", "Padre Hurtado", "Peñaflor"]
	}]
}


jQuery(document).ready(function () {

	var iRegion = 0;
	var htmlRegion = '<option value="<?php echo($row['ciudad']);?>"><?php echo($row['ciudad']);?></option><option value="sin-region">--</option>';
	var htmlComunas = '<option value="<?php echo($row['provincia']);?>"><?php echo($row['provincia']);?></option><option value="sin-region">--</option>';

	jQuery.each(RegionesYcomunas.regiones, function () {
		htmlRegion = htmlRegion + '<option value="' + RegionesYcomunas.regiones[iRegion].NombreRegion + '">' + RegionesYcomunas.regiones[iRegion].NombreRegion + '</option>';
		iRegion++;
	});

	jQuery('#regiones').html(htmlRegion);
	jQuery('#comunas').html(htmlComunas);

	jQuery('#regiones').change(function () {
		var iRegiones = 0;
		var valorRegion = jQuery(this).val();
		var htmlComuna = '<option value="<?php echo($row['provincia']);?>"><?php echo($row['provincia']);?></option><option value="sin-comuna">--</option>';
		jQuery.each(RegionesYcomunas.regiones, function () {
			if (RegionesYcomunas.regiones[iRegiones].NombreRegion == valorRegion) {
				var iComunas = 0;
				jQuery.each(RegionesYcomunas.regiones[iRegiones].comunas, function () {
					htmlComuna = htmlComuna + '<option value="' + RegionesYcomunas.regiones[iRegiones].comunas[iComunas] + '">' + RegionesYcomunas.regiones[iRegiones].comunas[iComunas] + '</option>';
					iComunas++;
				});
			}
			iRegiones++;
		});
		jQuery('#comunas').html(htmlComuna);
	});
	jQuery('#comunas').change(function () {
		if (jQuery(this).val() == 'sin-region') {
			alert('selecciones Región');
		} else if (jQuery(this).val() == 'sin-comuna') {
			alert('selecciones Comuna');
		}
	});
	jQuery('#regiones').change(function () {
		if (jQuery(this).val() == 'sin-region') {
			alert('selecciones Región');
		}
	});

});
	</script>
	<!--Termino el conta

	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/main1.js"></script>


</body>
</html>
<?php
ob_end_flush();
?>