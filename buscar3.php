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

    $query = "SELECT id, nombre_curso, recomendacion, objetivo, ruta_curso, ruta_img FROM subir_cursos where estado='activo'";

     if (isset($_POST['consulta'])) {
     $q = $conn->real_escape_string($_POST['consulta']); 
     $query = "SELECT id, nombre_curso, recomendacion, objetivo, ruta_curso, ruta_img FROM subir_cursos where estado='activo'";   
     }
   

    $resultado = $conn->query($query);

    if ($resultado->num_rows>0) {
        $salida.=
        "<br>
        <div class='row'>
            <div class='col-12'>

            </div>
        </div>
        <br>
        <form method='get'>
        <div class='container'>
        ";

        while ($fila = $resultado->fetch_assoc()) {
            $salida.=
            "<a href='".$fila['ruta_curso']."' style='text-decoration:none;color:black;'>
             <div class='card mb-4' style='height:200px;'>
                <div class='row no-gutters'>
                    <div class='col-md-4' align='center'>
                        <img src='".$fila['ruta_img']."' class='card-img' alt='...' style='height: 150px; width: 190px;' VSPACE=25>
                    </div>

                    <div class='col-md-8'>  
                        <div class='card-body'>

                            <h4>".$fila['nombre_curso']."</h4>
                            <hr>

                            <p><b>Recomendacion: </b>".$fila['recomendacion']."</p>

                            <p><b>Objetivo: </b>".utf8_encode($fila['objetivo'])."</p>

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

    <!--<img src=".$fila['ruta_imagen'].">
                    <a href='trabajo.php?id_trabajo=".$fila['id']."' style='text-decoration:none;color:black;'>
            <div class='card mb-1' style='heigth:200px;'>
            <div class='row no-gutters'>
            <div class='col-md-4'>
                <img src='".$fila['ruta_imagen']."' class='card-img' alt='...'>
            </div>
            <div class='col-md-8'>
                <div class='card-body'>
                    <h5>".$fila['titulo']."</h5>
                </div>
            </div>
            </div></div></a>-->

