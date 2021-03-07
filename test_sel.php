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
                    header("Location:index.php");
                    }
                ?>
        </div>
      </div>
    </nav>
  </header>
  <br>
      
      <?php
      $id= $_GET['id']; 
      $rut=$_SESSION['$varut'];
      $totall = mysqli_num_rows(mysqli_query($cnn,"SELECT nota_test FROM seleccion WHERE (rut_cv='$rut') AND (id='$id') AND (nota_test<>'NULL')"));
      if ($totall==1){
        ?>
        <center><h3 class="center"><?php echo $_SESSION['$vanombre']?>, Ya respondiste satisfactoriamente tu test.</h3></center>
        <?php
      }else{
        ?>
  <form method="post"> 
  <div class="container">
    <div class="row">
      <div class="col-12">
        <center><h3>Prueba Oracle Base de datos</h3></center>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-12">
        <h5><b>1- Indica las ciudades que están en Inglaterra (UK) y Japón (JP). De la Tabla
        Locations</b></h5>
        <hr>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pregunta1" id="exampleRadios1" value="0" checked>
          <label class="form-check-label" for="exampleRadios1">
              SELECT REGION FROM LOCALIDAD WHERE COUNTRY_ID
            IN('UK','JP');
          </label>
        </div>  
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pregunta1" id="exampleRadios1" value="1" checked>
          <label class="form-check-label" for="exampleRadios1">
              SELECT CITY FROM LOCATIONS WHERE 
            IN('UK','JP');
          </label>
        </div>  
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pregunta1" id="exampleRadios1" value="0" checked>
          <label class="form-check-label" for="exampleRadios1">
              SELECT CITY,COUNTRY_ID FROM Ciudad WHERE COUNTRY_ID=JAPON OR COUNTRY=UK;
          </label>
        </div>  
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pregunta1" id="exampleRadios1" value="0" checked>
          <label class="form-check-label" for="exampleRadios1">
              SELECT CITY FROM LOCATIONS WHERE CIUDAD='JAPAN' AND CIUDAD='UK';
          </label>
        </div>  
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-12">
        <h5><b>2- Realizar un insert en la tabla productos</b></h5>
        <hr>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pregunta2" id="exampleRadios1" value="1" checked>
          <label class="form-check-label" for="exampleRadios1">
              INSERT INTO PRODUCTOS VALUES (1,'CLAVOS' );
          </label>
        </div>  
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pregunta2" id="exampleRadios1" value="0" checked>
          <label class="form-check-label" for="exampleRadios1">
              INSERTA INTO PRODUCTOS VALUES(1,'CLAVOS');
          </label>
        </div>  
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pregunta2" id="exampleRadios1" value="0" checked>
          <label class="form-check-label" for="exampleRadios1">
              UPDATE PRODUCTOS
              SET NOMBRE='CLAVOS'
              WHERE ID=1;
          </label>
        </div>  
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pregunta2" id="exampleRadios1" value="0" checked>
          <label class="form-check-label" for="exampleRadios1">
              INSERT VALUES INTO PRODUCTOS (1,CLAVOS);
          </label>
        </div>  
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-12">
        <h5><b>3-¿Para que sirve el SAVEPOINT?</b></h5>
        <hr>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pregunta3" id="exampleRadios1" value="1" checked>
          <label class="form-check-label" for="exampleRadios1">
              Sirve para marcar un punto de referencia en la transacción para hacer un ROLLBACK parcial.
          </label>
        </div>  
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pregunta3" id="exampleRadios1" value="0" checked>
          <label class="form-check-label" for="exampleRadios1">
              Sirve para eliminar una fila.
          </label>
        </div>  
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pregunta3" id="exampleRadios1" value="0" checked>
          <label class="form-check-label" for="exampleRadios1">
              Sirve para actualizar una fila.
          </label>
        </div>  
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pregunta3" id="exampleRadios1" value="0" checked>
          <label class="form-check-label" for="exampleRadios1">
              Sirve para guardar una tabla en la base de datos.
          </label>
        </div>  
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-12">
        <h5><b>4-Como hacemos un punto de guardado?</b></h5>
        <hr>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pregunta4" id="exampleRadios1" value="0" checked>
          <label class="form-check-label" for="exampleRadios1">
              SAVEPOINT TO A;
          </label>
        </div>  
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pregunta4" id="exampleRadios1" value="0" checked>
          <label class="form-check-label" for="exampleRadios1">
              ALTER TABLE DUAL ADD SAVEPOINT A;
          </label>
        </div>  
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pregunta4" id="exampleRadios1" value="0" checked>
          <label class="form-check-label" for="exampleRadios1">
              CREATE SAVEPOINT A;
          </label>
        </div>  
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pregunta4" id="exampleRadios1" value="1" checked>
          <label class="form-check-label" for="exampleRadios1">
              SAVEPOINT A;
          </label>
        </div>  
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-12">
        <h5><b>5-Realizar una ROLLBACK hasta el SAVEPOINT anterior.</b></h5>
        <hr>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pregunta5" id="exampleRadios1" value="0" checked>
          <label class="form-check-label" for="exampleRadios1">
              ROLLBACK SAVEPOINT TO A;
          </label>
        </div>  
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pregunta5" id="exampleRadios1" value="0" checked>
          <label class="form-check-label" for="exampleRadios1">
              ROLLBACK A;
          </label>
        </div>  
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pregunta5" id="exampleRadios1" value="1" checked>
          <label class="form-check-label" for="exampleRadios1">
              ROLLBACK TO A;
          </label>
        </div>  
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pregunta5" id="exampleRadios1" value="0" checked>
          <label class="form-check-label" for="exampleRadios1">
              ROLLBACK TO SAVEPOINT A;
          </label>
        </div>  
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-12">
        <h5><b>6-Indicar el número de empleados del departamento 50 (ID_DEP) De la tabla EMPLOYEES</b></h5>
        <hr>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pregunta6" id="exampleRadios1" value="1" checked>
          <label class="form-check-label" for="exampleRadios1">
              SELECT COUNT(*) FROM EMPLOYEES WHERE ID_DEP=50;
          </label>
        </div>  
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pregunta6" id="exampleRadios1" value="0" checked>
          <label class="form-check-label" for="exampleRadios1">
              SELECT SUM(*) FROM EMPLOYEES WHERE ID_DEP=50;
          </label>
        </div>  
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pregunta6" id="exampleRadios1" value="0" checked>
          <label class="form-check-label" for="exampleRadios1">
              SELECT * FROM EMPLOYEES WHERE ID_DEP=50;
          </label>
        </div>  
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pregunta6" id="exampleRadios1" value="0" checked>
          <label class="form-check-label" for="exampleRadios1">
              SELECT MAX(*) FROM EMPLOYEES WHERE ID_DEP=50;
          </label>
        </div>  
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-12">
        <h5><b>7-Seleccione los campos E.JOB_ID, E.SALARY, D.DEPARTMENT_NAME de las tablas (Employees y Departments) cuando la media del salario
        sea mayor a 8000 y el job_id sea igual a ST_MAN o IT_PROG o FT_MGR o MK_MAN, Agrupelos y utilice el join.</b></h5>
        <hr>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pregunta7" id="exampleRadios1" value="1" checked>
          <label class="form-check-label" for="exampleRadios1">
              <b>SELECT</b> EMPLOYEES.JOB_ID,AVG(EMPLOYEES.SALARY),DEPARTMENTS.DEPARTMENT_NAME
              <b>FROM</b> EMPLOYEES <b>JOIN</b> DEPARTMENTS ON EMPLOYEES.DEPARTMENT_ID = DEPARTMENTS.DEPARTMENT_ID
              <b>WHERE</b> (JOB_ID='ST_MAN' OR JOB_ID='IT_PROG' OR JOB_ID='FI_MGR' OR JOB_ID='MK_MAN')
              <b>GROUP BY</b> JOB_ID,DEPARTMENT_NAME
              <b>HAVING</b> AVG(EMPLOYEES.SALARY)>=8000;
          </label>
        </div>  
        <br>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pregunta7" id="exampleRadios1" value="0" checked>
          <label class="form-check-label" for="exampleRadios1">
              <b>SELECT</b> EMPLOYEES.JOB_ID,AVG(EMPLOYEES.SALARY),DEPARTMENTS.DEPARTMENT_NAME
              <b>FROM</b> EMPLOYEES <b>JOIN</b> DEPARTMENTS ON EMPLOYEES.DEPARTMENT_ID = DEPARTMENTS.DEPARTMENT_ID
              <b>WHERE</b> (JOB_ID='ST_MAN' AND JOB_ID='IT_PROG' OR JOB_ID='FI_MGR' AND JOB_ID='MK_MAN')
              <b>HAVING</b> AVG(EMPLOYEES.SALARY)>=8000;
              <b>GROUP BY</b> JOB_ID,DEPARTMENT_NAME
          </label>
        </div>  
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-12">
        <h5><b>8-¿Qué significa SQL?</b></h5>
        <hr>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pregunta8" id="exampleRadios1" value="1" checked>
          <label class="form-check-label" for="exampleRadios1">
              Structured Query Language.
          </label>
        </div>  
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pregunta8" id="exampleRadios1" value="0" checked>
          <label class="form-check-label" for="exampleRadios1">
              Structured Querys Languages.
          </label>
        </div>  
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pregunta8" id="exampleRadios1" value="0" checked>
          <label class="form-check-label" for="exampleRadios1">
              Language Structured Query .
          </label>
        </div>  
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pregunta8" id="exampleRadios1" value="0" checked>
          <label class="form-check-label" for="exampleRadios1">
              Query Language Structured.
          </label>
        </div>  
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-12">
        <h5><b>9-¿Qué se utiliza para Actualizar un registro?</b></h5>
        <hr>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pregunta9" id="exampleRadios1" value="0" checked>
          <label class="form-check-label" for="exampleRadios1">
              DELETE.
          </label>
        </div>  
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pregunta9" id="exampleRadios1" value="1" checked>
          <label class="form-check-label" for="exampleRadios1">
              UPDATE.
          </label>
        </div>  
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pregunta9" id="exampleRadios1" value="0" checked>
          <label class="form-check-label" for="exampleRadios1">
              SELECT.
          </label>
        </div>  
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pregunta9" id="exampleRadios1" value="0" checked>
          <label class="form-check-label" for="exampleRadios1">
              WHERE.
          </label>
        </div>  
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-12">
        <h5><b>10-Elimine una base de datos</b></h5>
        <hr>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pregunta10" id="exampleRadios1" value="0" checked>
          <label class="form-check-label" for="exampleRadios1">
              DELETE DATABASE 'Nombre';
          </label>
        </div>  
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pregunta10" id="exampleRadios1" value="0" checked>
          <label class="form-check-label" for="exampleRadios1">
              TRUNCATE DATABASE 'Nombre';
          </label>
        </div>  
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pregunta10" id="exampleRadios1" value="0" checked>
          <label class="form-check-label" for="exampleRadios1">
              DROP BASEDEDATOS 'Nombre';
          </label>
        </div>  
        <div class="form-check">
          <input class="form-check-input" type="radio" name="pregunta10" id="exampleRadios1" value="1" checked>
          <label class="form-check-label" for="exampleRadios1">
              DROP DATABASE 'Nombre';
          </label>
        </div>  
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-12">
        <input type="submit" class="btn btn-primary my-2 my-sm-0" name="Boton" value="Enviar">
      </div>
    </div>
  </div>  
  </form>
        <?php
      }
      if ($_POST['Boton']=="Enviar") {
        $r1=$_POST['pregunta1'];
        $r2=$_POST['pregunta2'];
        $r3=$_POST['pregunta3'];
        $r4=$_POST['pregunta4'];
        $r5=$_POST['pregunta5'];
        $r6=$_POST['pregunta6'];
        $r7=$_POST['pregunta7'];
        $r8=$_POST['pregunta8'];
        $r9=$_POST['pregunta9'];
        $r10=$_POST['pregunta10'];
        $resultado=$r1+$r2+$r3+$r4+$r5+$r6+$r7+$r8+$r9+$r10;
        if($resultado<=6){
           $perso="Puntaje insuficiente. Menos de 70%.";
         }

         if($resultado>=7){
          $perso="Excelente. Mayor a 70%";
         }

        if ($resultado>=7) {
          $insertarn="UPDATE seleccion SET nota_test='$perso' , descripcion='Aprobado' WHERE id='$id' ";
          mysqli_query($cnn,$insertarn);
        }else{
          $insertarn="UPDATE seleccion SET nota_test='$perso' , descripcion='No Aprobado' WHERE id='$id'";
          mysqli_query($cnn,$insertarn);
        }
        echo "$insertarn"; 
        echo "$r1"; 
        echo "$r2"; 
        echo "$r3"; 
        echo "$r4"; 
        echo "$r5"; 
        echo "$r6"; 
        echo "$r7"; 
        echo "$r8"; 
        echo "$r9"; 
        echo "$r10"; 
        echo "$resultado"; 
        echo "$perso";

        
        if($insertarn==true){
        header("Location:misofertas.php");
        
        }
      }
      ?>


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
</body>
</html>
<?php
ob_end_flush();
?>