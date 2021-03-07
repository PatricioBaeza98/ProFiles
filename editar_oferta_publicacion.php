<?php
ob_start();
include("funciones.php");
session_start();
if(!isset($_SESSION['$varut'])){
	header('Location:index.php');
}
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
        <a href="empresa.php" class="navbar-brand">
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
                    header("Location:index.php");
                    }
                ?>
        </div>
      </div>
    </nav>
  </header>
	<br>
	<?php
							$id_trabajo= $_GET['publicacion']; 
							$datos="SELECT lugar_trabajo FROM ofertas_laborales WHERE id='$id_trabajo'";
							$resul=mysqli_query($cnn,$datos);
							if($rows=mysqli_fetch_array($resul)){
                    		$lugar=$rows["lugar_trabajo"];
                    		$separar=explode(',', $lugar);
                  			}
							 ?>
	<?php 
			$id_trabajo= $_GET['publicacion']; 


		    $sql_tra=" SELECT COUNT(envios_curriculum.oferta_laboral) as solicitantes,ofertas_laborales.id,ofertas_laborales.rut_empresa,ofertas_laborales.titulo,ofertas_laborales.nombre_empresa,ofertas_laborales.descripcion_trabajo,ofertas_laborales.lugar_trabajo,ofertas_laborales.fecha_publicacion,ofertas_laborales.salario,ofertas_laborales.tipo_puesto,ofertas_laborales.area,usuario.ruta_imagen,ofertas_laborales.Experiencia,ofertas_laborales.Tipo_empleo,ofertas_laborales.Funciones
                  FROM ofertas_laborales,usuario,envios_curriculum
                  WHERE(ofertas_laborales.rut_empresa=usuario.rut) AND (ofertas_laborales.id=envios_curriculum.oferta_laboral) AND (ofertas_laborales.id='$id_trabajo')";
        mysqli_query($cnn,$sql_tra);
        $res1=mysqli_query($cnn,$sql_tra);           
        while($fila=mysqli_fetch_assoc($res1)){
        $date=date_create($fila["fecha_publicacion"]);
        $soli= $fila['solicitantes'];

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
									<input type="text" name="titulo" class="form-control" value="<?php echo($fila['titulo']);?>">
								</div>
							</div>
							<div class="row">
								<div class="col-3">
									<h6>
										<b>
											<h6><?php echo($fila['nombre_empresa']);?></h6>
										</b>
									</h6>
								</div>
								<div class="col-9">•
								<img src="img/map.png" alt="">
								<?php echo(utf8_encode($fila['lugar_trabajo']));?>
								<select name="region" id="regiones" class="form-control">
								</select>
								<br>
								<select  id="comunas" name="provincia"  class="form-control">
								</select>
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
							<hr>
							<div class="row">
								<div class="col-8">
									<p>Descripción del empleo</p>
									<br>
<textarea name="descripcion" style="resize: none;" class="form-control" cols="65" rows="12"><?php echo(trim(utf8_encode($fila['descripcion_trabajo'])));?></textarea>
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
											<input type="text" name="nexperiencia" class="form-control" value="<?php echo(utf8_encode($fila['Experiencia']));?>">
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-12">
											<p style="margin-bottom: 0px;">Sector: </p>
											<input type="text" name="sector" class="form-control" value="<?php echo(utf8_encode($fila['area']));?>">
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-12">
											<p style="margin-bottom: 0px;">Tipo de empleo: </p>
											<input type="text" name="templeo" class="form-control" value="<?php echo(utf8_encode($fila['Tipo_empleo']));?>">
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-12">
											<p style="margin-bottom: 0px;">Funciones laborales: </p>
											<input type="text" name="flaborales" class="form-control" value="<?php echo(utf8_encode($fila['Funciones']));?>">
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-12">
									<p style="margin-bottom: 0px;">Salario: </p>
									<div class="input-group mb-3">
									  <div class="input-group-prepend">
									    <span class="input-group-text">$</span>
									  </div>
									 <input type="text" name="salario" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" value="<?php echo($fila['salario']);?>">
									</div>
								</div>
							</div>
							<br>
							<hr>
							<div class="row">
								<div class="col-6"></div>
								<div class="col-6">
									<a href="miperfil.php" class="btn btn-outline-danger">Cancelar</a>
									<input type="submit" name="editar" value="Editar Empleo" class="btn btn-outline-primary" style="float: right;">
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
	if($_POST['editar']=="Editar Empleo"){
	$id_trabajo=$_GET['publicacion'];
	$titulo=utf8_decode($_POST['titulo']);
	$lugar_trabajor=utf8_decode($_POST['region']);
	$lugar_trabajop=utf8_decode($_POST['provincia']);
	$descripcion=utf8_decode($_POST['descripcion']);
	$nexperiencia=utf8_decode($_POST['nexperiencia']);
	$sector=utf8_decode($_POST['sector']);
	$templeo=utf8_decode($_POST['templeo']);
	$flaborales=utf8_decode($_POST['flaborales']);
	$salario=utf8_decode($_POST['salario']);
	$editar="UPDATE ofertas_laborales
			SET titulo='$titulo',descripcion_trabajo='$descripcion',lugar_trabajo='$lugar_trabajop, $lugar_trabajor',salario='$salario',area='$sector',Experiencia='$nexperiencia',Tipo_empleo='$templeo',funciones='$flaborales' WHERE id='$id_trabajo'";
			mysqli_query($cnn,$editar);
			if($editar==true){
				header('Location:miperfil.php');
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

	<script>
		var RegionesYcomunas = {

	"regiones": [{
			"NombreRegion": "Arica y Parinacota",
			"comunas": ["Arica", "Camarones", "Putre", "General Lagos"]
	},
		{
			"NombreRegion": "Tarapacá",
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
			"NombreRegion": "Valparaíso",
			"comunas": ["Valparaíso", "Casablanca", "Concón", "Juan Fernández", "Puchuncaví", "Quintero", "Viña del Mar", "Isla de Pascua", "Los Andes", "Calle Larga", "Rinconada", "San Esteban", "La Ligua", "Cabildo", "Papudo", "Petorca", "Zapallar", "Quillota", "Calera", "Hijuelas", "La Cruz", "Nogales", "San Antonio", "Algarrobo", "Cartagena", "El Quisco", "El Tabo", "Santo Domingo", "San Felipe", "Catemu", "Llaillay", "Panquehue", "Putaendo", "Santa María", "Quilpué", "Limache", "Olmué", "Villa Alemana"]
	},
		{
			"NombreRegion": "Región del Libertador Gral. Bernardo O’Higgins",
			"comunas": ["Rancagua", "Codegua", "Coinco", "Coltauco", "Doñihue", "Graneros", "Las Cabras", "Machalí", "Malloa", "Mostazal", "Olivar", "Peumo", "Pichidegua", "Quinta de Tilcoco", "Rengo", "Requínoa", "San Vicente", "Pichilemu", "La Estrella", "Litueche", "Marchihue", "Navidad", "Paredones", "San Fernando", "Chépica", "Chimbarongo", "Lolol", "Nancagua", "Palmilla", "Peralillo", "Placilla", "Pumanque", "Santa Cruz"]
	},
		{
			"NombreRegion": "Región del Maule",
			"comunas": ["Talca", "ConsVtución", "Curepto", "Empedrado", "Maule", "Pelarco", "Pencahue", "Río Claro", "San Clemente", "San Rafael", "Cauquenes", "Chanco", "Pelluhue", "Curicó", "Hualañé", "Licantén", "Molina", "Rauco", "Romeral", "Sagrada Familia", "Teno", "Vichuquén", "Linares", "Colbún", "Longaví", "Parral", "ReVro", "San Javier", "Villa Alegre", "Yerbas Buenas"]
	},
		{
			"NombreRegion": "Región del Biobío",
			"comunas": ["Concepción", "Coronel", "Chiguayante", "Florida", "Hualqui", "Lota", "Penco", "San Pedro de la Paz", "Santa Juana", "Talcahuano", "Tomé", "Hualpén", "Lebu", "Arauco", "Cañete", "Contulmo", "Curanilahue", "Los Álamos", "Tirúa", "Los Ángeles", "Antuco", "Cabrero", "Laja", "Mulchén", "Nacimiento", "Negrete", "Quilaco", "Quilleco", "San Rosendo", "Santa Bárbara", "Tucapel", "Yumbel", "Alto Biobío", "Chillán", "Bulnes", "Cobquecura", "Coelemu", "Coihueco", "Chillán Viejo", "El Carmen", "Ninhue", "Ñiquén", "Pemuco", "Pinto", "Portezuelo", "Quillón", "Quirihue", "Ránquil", "San Carlos", "San Fabián", "San Ignacio", "San Nicolás", "Treguaco", "Yungay"]
	},
		{
			"NombreRegion": "Región de la Araucanía",
			"comunas": ["Temuco", "Carahue", "Cunco", "Curarrehue", "Freire", "Galvarino", "Gorbea", "Lautaro", "Loncoche", "Melipeuco", "Nueva Imperial", "Padre las Casas", "Perquenco", "Pitrufquén", "Pucón", "Saavedra", "Teodoro Schmidt", "Toltén", "Vilcún", "Villarrica", "Cholchol", "Angol", "Collipulli", "Curacautín", "Ercilla", "Lonquimay", "Los Sauces", "Lumaco", "Purén", "Renaico", "Traiguén", "Victoria", ]
	},
		{
			"NombreRegion": "Región de Los Ríos",
			"comunas": ["Valdivia", "Corral", "Lanco", "Los Lagos", "Máfil", "Mariquina", "Paillaco", "Panguipulli", "La Unión", "Futrono", "Lago Ranco", "Río Bueno"]
	},
		{
			"NombreRegion": "Región de Los Lagos",
			"comunas": ["Puerto Montt", "Calbuco", "Cochamó", "Fresia", "FruVllar", "Los Muermos", "Llanquihue", "Maullín", "Puerto Varas", "Castro", "Ancud", "Chonchi", "Curaco de Vélez", "Dalcahue", "Puqueldón", "Queilén", "Quellón", "Quemchi", "Quinchao", "Osorno", "Puerto Octay", "Purranque", "Puyehue", "Río Negro", "San Juan de la Costa", "San Pablo", "Chaitén", "Futaleufú", "Hualaihué", "Palena"]
	},
		{
			"NombreRegion": "Región Aisén del Gral. Carlos Ibáñez del Campo",
			"comunas": ["Coihaique", "Lago Verde", "Aisén", "Cisnes", "Guaitecas", "Cochrane", "O’Higgins", "Tortel", "Chile Chico", "Río Ibáñez"]
	},
		{
			"NombreRegion": "Región de Magallanes y de la AntárVca Chilena",
			"comunas": ["Punta Arenas", "Laguna Blanca", "Río Verde", "San Gregorio", "Cabo de Hornos (Ex Navarino)", "AntárVca", "Porvenir", "Primavera", "Timaukel", "Natales", "Torres del Paine"]
	},
		{
			"NombreRegion": "Región Metropolitana de Santiago",
			"comunas": ["Cerrillos", "Cerro Navia", "Conchalí", "El Bosque", "Estación Central", "Huechuraba", "Independencia", "La Cisterna", "La Florida", "La Granja", "La Pintana", "La Reina", "Las Condes", "Lo Barnechea", "Lo Espejo", "Lo Prado", "Macul", "Maipú", "Ñuñoa", "Pedro Aguirre Cerda", "Peñalolén", "Providencia", "Pudahuel", "Quilicura", "Quinta Normal", "Recoleta", "Renca", "San Joaquín", "San Miguel", "San Ramón", "Vitacura", "Puente Alto", "Pirque", "San José de Maipo", "Colina", "Lampa", "TilVl", "San Bernardo", "Buin", "Calera de Tango", "Paine", "Melipilla", "Alhué", "Curacaví", "María Pinto", "San Pedro", "Talagante", "El Monte", "Isla de Maipo", "Padre Hurtado", "Peñaflor"]
	}]
}


jQuery(document).ready(function () {

	var iRegion = 0;
	var htmlRegion = '<option value="<?php echo utf8_encode($separar[1]); ?>"><?php echo utf8_encode($separar[1]); ?></option><option value="sin-region">--</option>';
	var htmlComunas = '<option value="<?php echo utf8_encode($separar[0]); ?>"><?php echo utf8_encode($separar[0]); ?></option><option value="sin-region">--</option>';

	jQuery.each(RegionesYcomunas.regiones, function () {
		htmlRegion = htmlRegion + '<option value="' + RegionesYcomunas.regiones[iRegion].NombreRegion + '">' + RegionesYcomunas.regiones[iRegion].NombreRegion + '</option>';
		iRegion++;
	});

	jQuery('#regiones').html(htmlRegion);
	jQuery('#comunas').html(htmlComunas);

	jQuery('#regiones').change(function () {
		var iRegiones = 0;
		var valorRegion = jQuery(this).val();
		var htmlComuna = '<option value="<?php echo utf8_encode($separar[0]); ?>"><?php echo($row['provincia']);?></option><option value="sin-comuna">--</option>';
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
</body>
</html>
<?php
ob_end_flush();
?>	