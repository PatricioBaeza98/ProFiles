    <link rel="stylesheet" href="css/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "proyectod";

    include("funciones.php");

    $conn = new mysqli($servername, $username, $password, $dbname);
      if($conn->connect_error){
        die("Conexión fallida: ".$conn->connect_error);
      }

    $salida = "";

    $query = "SELECT usuario.rut,ofertas_laborales.id,ofertas_laborales.rut_empresa,ofertas_laborales.titulo,ofertas_laborales.nombre_empresa,ofertas_laborales.descripcion_trabajo,ofertas_laborales.lugar_trabajo,ofertas_laborales.fecha_publicacion,ofertas_laborales.salario,ofertas_laborales.tipo_puesto,ofertas_laborales.area,usuario.ruta_imagen
                  FROM ofertas_laborales,usuario WHERE (ofertas_laborales.rut_empresa=usuario.rut) AND (ofertas_laborales.estado='activa')";

     if (isset($_POST['consulta'])) {
     $q = $conn->real_escape_string($_POST['consulta']); 
     $query = "SELECT usuario.rut,ofertas_laborales.id,ofertas_laborales.rut_empresa,ofertas_laborales.titulo,ofertas_laborales.nombre_empresa,ofertas_laborales.descripcion_trabajo,ofertas_laborales.lugar_trabajo,ofertas_laborales.fecha_publicacion,ofertas_laborales.salario,ofertas_laborales.tipo_puesto,ofertas_laborales.area,usuario.ruta_imagen
                  FROM ofertas_laborales,usuario WHERE (ofertas_laborales.rut_empresa=usuario.rut) AND (ofertas_laborales.estado='activa') AND (ofertas_laborales.titulo LIKE '%".$q."%' OR ofertas_laborales.lugar_trabajo LIKE '%".$q."%'  OR ofertas_laborales.nombre_empresa LIKE '%".$q."%')";   
     }
   

    $resultado = $conn->query($query);

    if ($resultado->num_rows>0) {
        $salida.=
        "<br>
        <div class='row'>
            <div class='col-12'>
                <div class='card'>
                    <h3 class='text-center'>Ofertas laborales</h3>
                </div>
            </div>
        </div>
        <hr>
        <br>
        <form method='get'>
        <div class='container'>
        ";

        while ($fila = $resultado->fetch_assoc()) {
            $salida.=
            "
            <a href='trabajo.php?id_de_trabajo=".$fila['id']."' style='text-decoration:none;color:black;'>
             <div class='card mb-4' style='height:200px;'>
                <div class='row no-gutters'>
                    <div class='col-md-4'>
                        <img src='".$fila['ruta_imagen']."' class='card-img' alt='...'>
                    </div>
                    <div class='col-md-8'>  
                        <div class='card-body'>
                            <h4>".$fila['titulo']."</h4>
                            <hr>
                            <p><b>Salario: </b>".$fila['salario']."</p>
                            <p><b>Lugar: </b>".utf8_encode($fila['lugar_trabajo'])."</p>
                            <p><b>Fecha Publicación: </b>".$fila['fecha_publicacion']."</p>
                        </div>  
                    </div>
                </div>
             </div>
            </a>
            ";

        }
        $salida.="</div></form>";
    }else{
        $salida.="Solo Busqueda por Nombre de trabajo, Empresa o Comuna.";
    }


    echo $salida;

    $conn->close();



?>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>