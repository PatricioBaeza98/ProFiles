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
        $listar1="SELECT sexo FROM usuario WHERE rut='$rut'";
        $resultado1=mysqli_query($cnn,$listar1);
        while($rss=mysqli_fetch_array($resultado1)){
            $sex= $rss['sexo'] ;
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
						<button class="btn btn-primary my-2 my-sm-0" type="submit" name="btncerrar">Cerrar Sesi??n</button>
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
	<form method="post">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h3>Publicar Oferta</h3>
					<hr>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-6">
					<h4>Titulo</h4>
					<input type="text" name="titulo" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
				</div>
				<div class="col-6">
					<h4>Salario</h4>
					<input type="text" name="salario" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
				</div>
			</div>
			<div class="row">
				<div class="col-6">
					<h4>Regi??n</h4>
					<select name="region" id="regiones" class="form-control">
					</select>
				</div>
				<div class="col-6">
					<h4>Comuna</h4>
					<select  id="comunas" name="provincia"  class="form-control">
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-6">
					<h4>??rea</h4>
					<input type="text" name="area" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
				</div>
			</div>	
			<div class="row">
				<div class="col-6">
					<h4>Tipo de puesto</h4>
					<input type="text" name="tpuesto" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
				</div>
				<div class="col-6">
					<h4>Experiencia</h4>
					<input type="text" name="experiencia" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
				</div>
			</div>
			<div class="row">
				<div class="col-6">
					<h4>Tipo de Empleo</h4>
					<input type="text" name="templeo" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
				</div>
				<div class="col-6">
					<h4>funciones</h4>
					<input type="text" name="funciones" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<h4>Responsabilidades</h4>
					<textarea name="responsabilidades" class="form-control" cols="155" rows="10"></textarea>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-3">
					<input type="submit" class="btn btn-outline-primary" name="publicar" value="Publicar">
				</div>
			</div>
		</div>
	</form>
	

	<?php 
	if($_POST['publicar']=="Publicar"){
		date_default_timezone_get('America/Santiago');
		$titulo=utf8_decode($_POST["titulo"]);
		$salario=utf8_decode($_POST["salario"]);
		$region=utf8_decode($_POST["region"]);
		$provincia=utf8_decode($_POST["provincia"]);
		$area=utf8_decode($_POST["area"]);
		$tpuesto=utf8_decode($_POST["tpuesto"]);
		$experiencia=utf8_decode($_POST["experiencia"]);
		$templeo=utf8_decode($_POST["templeo"]);
		$funciones=utf8_decode($_POST["funciones"]);
		$responsabilidades=utf8_decode($_POST["responsabilidades"]);
		$vaFecha=date('Y-m-d');
		$rut=$_SESSION['$varut'];
		$nombre_empresa=$_SESSION['$nombre_empresa']; 
		$insertar="INSERT INTO ofertas_laborales (rut_empresa,titulo,nombre_empresa,descripcion_trabajo,lugar_trabajo,fecha_publicacion,salario,tipo_puesto,area,experiencia,tipo_empleo,funciones,estado) VALUES ('$rut','$titulo','$nombre_empresa','$responsabilidades','$provincia, $region','$vaFecha','$salario','$tpuesto','$area','$experiencia','$templeo','$funciones','activa')";
		mysqli_query($cnn,$insertar);
		echo "$insertar";

	}

	?>
	
	<br>
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
	<script>
		var RegionesYcomunas = {

	"regiones": [{
			"NombreRegion": "Arica y Parinacota",
			"comunas": ["Arica", "Camarones", "Putre", "General Lagos"]
	},
		{
			"NombreRegion": "Tarapac??",
			"comunas": ["Iquique", "Alto Hospicio", "Pozo Almonte", "Cami??a", "Colchane", "Huara", "Pica"]
	},
		{
			"NombreRegion": "Antofagasta",
			"comunas": ["Antofagasta", "Mejillones", "Sierra Gorda", "Taltal", "Calama", "Ollag??e", "San Pedro de Atacama", "Tocopilla", "Mar??a Elena"]
	},
		{
			"NombreRegion": "Atacama",
			"comunas": ["Copiap??", "Caldera", "Tierra Amarilla", "Cha??aral", "Diego de Almagro", "Vallenar", "Alto del Carmen", "Freirina", "Huasco"]
	},
		{
			"NombreRegion": "Coquimbo",
			"comunas": ["La Serena", "Coquimbo", "Andacollo", "La Higuera", "Paiguano", "Vicu??a", "Illapel", "Canela", "Los Vilos", "Salamanca", "Ovalle", "Combarbal??", "Monte Patria", "Punitaqui", "R??o Hurtado"]
	},
		{
			"NombreRegion": "Valpara??so",
			"comunas": ["Valpara??so", "Casablanca", "Conc??n", "Juan Fern??ndez", "Puchuncav??", "Quintero", "Vi??a del Mar", "Isla de Pascua", "Los Andes", "Calle Larga", "Rinconada", "San Esteban", "La Ligua", "Cabildo", "Papudo", "Petorca", "Zapallar", "Quillota", "Calera", "Hijuelas", "La Cruz", "Nogales", "San Antonio", "Algarrobo", "Cartagena", "El Quisco", "El Tabo", "Santo Domingo", "San Felipe", "Catemu", "Llaillay", "Panquehue", "Putaendo", "Santa Mar??a", "Quilpu??", "Limache", "Olmu??", "Villa Alemana"]
	},
		{
			"NombreRegion": "Regi??n del Libertador Gral. Bernardo O???Higgins",
			"comunas": ["Rancagua", "Codegua", "Coinco", "Coltauco", "Do??ihue", "Graneros", "Las Cabras", "Machal??", "Malloa", "Mostazal", "Olivar", "Peumo", "Pichidegua", "Quinta de Tilcoco", "Rengo", "Requ??noa", "San Vicente", "Pichilemu", "La Estrella", "Litueche", "Marchihue", "Navidad", "Paredones", "San Fernando", "Ch??pica", "Chimbarongo", "Lolol", "Nancagua", "Palmilla", "Peralillo", "Placilla", "Pumanque", "Santa Cruz"]
	},
		{
			"NombreRegion": "Regi??n del Maule",
			"comunas": ["Talca", "ConsVtuci??n", "Curepto", "Empedrado", "Maule", "Pelarco", "Pencahue", "R??o Claro", "San Clemente", "San Rafael", "Cauquenes", "Chanco", "Pelluhue", "Curic??", "Huala????", "Licant??n", "Molina", "Rauco", "Romeral", "Sagrada Familia", "Teno", "Vichuqu??n", "Linares", "Colb??n", "Longav??", "Parral", "ReVro", "San Javier", "Villa Alegre", "Yerbas Buenas"]
	},
		{
			"NombreRegion": "Regi??n del Biob??o",
			"comunas": ["Concepci??n", "Coronel", "Chiguayante", "Florida", "Hualqui", "Lota", "Penco", "San Pedro de la Paz", "Santa Juana", "Talcahuano", "Tom??", "Hualp??n", "Lebu", "Arauco", "Ca??ete", "Contulmo", "Curanilahue", "Los ??lamos", "Tir??a", "Los ??ngeles", "Antuco", "Cabrero", "Laja", "Mulch??n", "Nacimiento", "Negrete", "Quilaco", "Quilleco", "San Rosendo", "Santa B??rbara", "Tucapel", "Yumbel", "Alto Biob??o", "Chill??n", "Bulnes", "Cobquecura", "Coelemu", "Coihueco", "Chill??n Viejo", "El Carmen", "Ninhue", "??iqu??n", "Pemuco", "Pinto", "Portezuelo", "Quill??n", "Quirihue", "R??nquil", "San Carlos", "San Fabi??n", "San Ignacio", "San Nicol??s", "Treguaco", "Yungay"]
	},
		{
			"NombreRegion": "Regi??n de la Araucan??a",
			"comunas": ["Temuco", "Carahue", "Cunco", "Curarrehue", "Freire", "Galvarino", "Gorbea", "Lautaro", "Loncoche", "Melipeuco", "Nueva Imperial", "Padre las Casas", "Perquenco", "Pitrufqu??n", "Puc??n", "Saavedra", "Teodoro Schmidt", "Tolt??n", "Vilc??n", "Villarrica", "Cholchol", "Angol", "Collipulli", "Curacaut??n", "Ercilla", "Lonquimay", "Los Sauces", "Lumaco", "Pur??n", "Renaico", "Traigu??n", "Victoria", ]
	},
		{
			"NombreRegion": "Regi??n de Los R??os",
			"comunas": ["Valdivia", "Corral", "Lanco", "Los Lagos", "M??fil", "Mariquina", "Paillaco", "Panguipulli", "La Uni??n", "Futrono", "Lago Ranco", "R??o Bueno"]
	},
		{
			"NombreRegion": "Regi??n de Los Lagos",
			"comunas": ["Puerto Montt", "Calbuco", "Cocham??", "Fresia", "FruVllar", "Los Muermos", "Llanquihue", "Maull??n", "Puerto Varas", "Castro", "Ancud", "Chonchi", "Curaco de V??lez", "Dalcahue", "Puqueld??n", "Queil??n", "Quell??n", "Quemchi", "Quinchao", "Osorno", "Puerto Octay", "Purranque", "Puyehue", "R??o Negro", "San Juan de la Costa", "San Pablo", "Chait??n", "Futaleuf??", "Hualaihu??", "Palena"]
	},
		{
			"NombreRegion": "Regi??n Ais??n del Gral. Carlos Ib????ez del Campo",
			"comunas": ["Coihaique", "Lago Verde", "Ais??n", "Cisnes", "Guaitecas", "Cochrane", "O???Higgins", "Tortel", "Chile Chico", "R??o Ib????ez"]
	},
		{
			"NombreRegion": "Regi??n de Magallanes y de la Ant??rVca Chilena",
			"comunas": ["Punta Arenas", "Laguna Blanca", "R??o Verde", "San Gregorio", "Cabo de Hornos (Ex Navarino)", "Ant??rVca", "Porvenir", "Primavera", "Timaukel", "Natales", "Torres del Paine"]
	},
		{
			"NombreRegion": "Regi??n Metropolitana de Santiago",
			"comunas": ["Cerrillos", "Cerro Navia", "Conchal??", "El Bosque", "Estaci??n Central", "Huechuraba", "Independencia", "La Cisterna", "La Florida", "La Granja", "La Pintana", "La Reina", "Las Condes", "Lo Barnechea", "Lo Espejo", "Lo Prado", "Macul", "Maip??", "??u??oa", "Pedro Aguirre Cerda", "Pe??alol??n", "Providencia", "Pudahuel", "Quilicura", "Quinta Normal", "Recoleta", "Renca", "San Joaqu??n", "San Miguel", "San Ram??n", "Vitacura", "Puente Alto", "Pirque", "San Jos?? de Maipo", "Colina", "Lampa", "TilVl", "San Bernardo", "Buin", "Calera de Tango", "Paine", "Melipilla", "Alhu??", "Curacav??", "Mar??a Pinto", "San Pedro", "Talagante", "El Monte", "Isla de Maipo", "Padre Hurtado", "Pe??aflor"]
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
			alert('selecciones Regi??n');
		} else if (jQuery(this).val() == 'sin-comuna') {
			alert('selecciones Comuna');
		}
	});
	jQuery('#regiones').change(function () {
		if (jQuery(this).val() == 'sin-region') {
			alert('selecciones Regi??n');
		}
	});

});
	</script>


</body>
</html>
<?php
ob_end_flush();
?>