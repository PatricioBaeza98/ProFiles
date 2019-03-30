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

    $query = "SELECT usuario.rut as rut,usuario.nombre as nombre,usuario.apellido as apellido,usuario.correo as correo,cv.salario as salario,cv.actividad_empresa as actividad,cv.puesto as puesto,cv.nivel_experiencia as nivel,test.respuesta as respuesta FROM usuario,test,cv WHERE (test.cv=cv.id) AND (usuario.rut=cv.rut) AND usuario.nombre NOT LIKE '' ORDER By usuario.rut";

     if (isset($_POST['consulta'])) {
     $q = $conn->real_escape_string($_POST['consulta']); 
     $query = "SELECT usuario.rut as rut,usuario.nombre as nombre,usuario.apellido as apellido,usuario.correo as correo,cv.salario as salario,cv.actividad_empresa as actividad,cv.puesto as puesto,cv.nivel_experiencia as nivel,test.respuesta as respuesta FROM usuario,test,cv WHERE (test.cv=cv.id) AND (usuario.rut=cv.rut) AND (usuario.nombre LIKE '%".$q."%'  OR usuario.rut LIKE '%".$q."%' )  ";   
     }
   

    $resultado = $conn->query($query);

    if ($resultado->num_rows>0) {
        $salida.=
        "<br>
        <form method='GET'>
        <h3 class='text-center'>Curriculum</h3>
        <hr>
        <div class='row'>
            <div class='col-sm'>
                 <table class='table table-hover' style='width:200px; height:200px;'>
                    <thead class='thead-dark'>
                        <tr id='titulo'>
                            <th>Rut</th>
                            <th>Nombre</th>
                            <th>Apellido</th>                            
                            <th>Salario</th>
                            <th>Actividad</th>
                            <th>Puesto</th>
                            <th>Test</th>
                        </tr>
                    </thead>
            <tbody>";

        while ($fila = $resultado->fetch_assoc()) {
            $salida.=
            "<tr>
                        <td><b><a href=vercurriculum2.php?rut_usu=".$fila['rut'].">".$fila['rut']."</a></b></td>
                        <td>".$fila['nombre']."</td>
                        <td>".$fila['apellido']."</td>
                        <td>".$fila['salario']."</td>
                        <td>".$fila['actividad']."</td>
                        <td>".$fila['puesto']."</td>
                        <td>".$fila['respuesta']."</td>
            </tr>";

        }
        $salida.="</tbody></table></div></div></form>";
    }else{
        $salida.="Solo Busqueda por nombre Usuario o rut";
    }


    echo $salida;

    $conn->close();



?>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>