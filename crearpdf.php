<?php
include("funciones.php");
$cnn=Conectar();
session_start();
$id=$_GET["id"];
$rut=$_GET["rut_postulante"];
      
      $traerCV = mysqli_num_rows(mysqli_query($cnn,"SELECT usuario.rut,usuario.nombre,usuario.apellido,usuario.correo,usuario.telefono,usuario.sexo,usuario.ruta_imagen,cv.dia,cv.mes,cv.anio,cv.nacionalidad,cv.estado_civil,cv.salario,cv.prefijo_cel,cv.provincia,cv.ciudad,cv.calle,cv.colegio,cv.liceo,cv.instituto,cv.titulo,cv.nombre_empresa,cv.actividad_empresa,cv.puesto,cv.nivel_experiencia,cv.desde_mes,cv.desde_anio,cv.hasta_mes,cv.hasta_anio,cv.area_puesto,cv.subarea,cv.responsabilidades,cv.idioma,cv.nivel_oral,cv.nivel_escrito
      FROM usuario INNER JOIN cv ON (usuario.rut=cv.rut)  WHERE (usuario.rut=cv.rut) AND (cv.id='$id') AND (usuario.rut='$rut')"));
      if($traerCV==0){
      ?>
      <script>alert('Usted no ha subido su Curriculum, por favor llene su curriculum antes de visualizar esta pagina.')</script>
      <script type="text/javascript">window.location="curriculumvitae.php";</script>
      <?php
      }else{
      
      $resu = "SELECT usuario.rut,usuario.nombre,usuario.apellido,usuario.correo,usuario.telefono,usuario.sexo,usuario.ruta_imagen,cv.dia,cv.mes,cv.anio,cv.nacionalidad,cv.estado_civil,cv.salario,cv.prefijo_cel,cv.provincia,cv.ciudad,cv.calle,cv.colegio,cv.liceo,cv.instituto,cv.titulo,cv.nombre_empresa,cv.actividad_empresa,cv.puesto,cv.nivel_experiencia,cv.desde_mes,cv.desde_anio,cv.hasta_mes,cv.hasta_anio,cv.area_puesto,cv.subarea,cv.responsabilidades,cv.idioma,cv.nivel_oral,cv.nivel_escrito
      FROM usuario,cv
      WHERE (usuario.rut=cv.rut) AND (cv.id='$id')";
      $rs=mysqli_query($cnn,$resu);
      while($row3=mysqli_fetch_array($rs)){
                        $nombre=utf8_encode($row3["nombre"]);
                  $apellido=utf8_encode($row3["apellido"]);
                  $correo=utf8_encode($row3["correo"]);
                  $telefono=utf8_encode($row3["telefono"]);
                  $sexo=utf8_encode($row3["sexo"]);
                  $foto=utf8_encode($row3["ruta_imagen"]);
                  $dia=utf8_encode($row3["dia"]);
                  $mes=utf8_encode($row3["mes"]);
                  $anio=utf8_encode($row3["anio"]);
                  $nacionalidad=utf8_encode($row3["nacionalidad"]);
                  $estado_civil=utf8_encode($row3["estado_civil"]);
                  $salario=utf8_encode($row3["salario"]);
                  $provincia=utf8_encode($row3["provincia"]);
                  $ciudad=utf8_encode($row3["ciudad"]);
                  $calle=utf8_encode($row3["calle"]);
                  $nombre_empresa=utf8_encode($row3["nombre_empresa"]);
                  $actividad_empresa=utf8_encode($row3["actividad_empresa"]);
                  $puesto=utf8_encode($row3["puesto"]);
                  $nivel_experiencia=utf8_encode($row3["nivel_experiencia"]);
                  $area_puesto=utf8_encode($row3["area_puesto"]);
                  $subarea=utf8_encode($row3["subarea"]);
                  $colegio=utf8_encode($row3["colegio"]);
                  $liceo=utf8_encode($row3["liceo"]);
                  $instituto=utf8_encode($row3["instituto"]);
                  $titulo=utf8_encode($row3["titulo"]);
                  $pre=utf8_encode($row3["prefijo_cel"]);
                  $desde_mes=utf8_encode($row3["desde_mes"]);
                  $desde_año=utf8_encode($row3["desde_anio"]);
                  $hasta_mes=utf8_encode($row3["hasta_mes"]);
                  $hasta_año=utf8_encode($row3["hasta_anio"]);
                  $responsabilidades=utf8_encode($row3["responsabilidades"]);
                  $idioma=utf8_encode($row3["idioma"]);
                  $nivel_oral=utf8_encode($row3["nivel_oral"]);
                  $nivel_escrito=utf8_encode($row3["nivel_escrito"]);
      }
      ?>
<?php
require 'fpdf/fpdf.php';
$pdf= new FPDF();
$pdf->AddPage('PORTRAIT','letter');
$pdf->SetFont('Arial','',30);
$pdf->Cell(195,10,utf8_decode('Curriculum Vitae'),0,0,'C');
$pdf->ln();
$pdf->ln();
$pdf->SetFont('Arial','U',20);
$pdf->Cell(195,8,utf8_decode(' Datos Personales'),0,0,'L');
$pdf->ln();
$pdf->ln();
$pdf->SetFont('Arial','',11);
$pdf->Cell(100,10,utf8_decode($nombre .' '.$apellido),0,0,'L');
$pdf->Cell(100,10, $pdf->Image($foto, $pdf->GetX()+25, $pdf->GetY()+0, 50) ,0,"C");
$pdf->ln();
$pdf->SetFont('Arial','B',11);
$pdf->Cell(42,10,utf8_decode('Tel:' ),0,0,'L');
$pdf->SetFont('Arial','',11);
$pdf->Cell(75,10,utf8_decode('(+'.$pre.') '.$telefono ),0,0,'L');
$pdf->ln();
$pdf->ln();
$pdf->SetFont('Arial','B',11);
$pdf->Cell(42,10,utf8_decode('Dirección:' ),0,0,'L');
$pdf->SetFont('Arial','',11);
$pdf->Cell(75,10,utf8_decode($ciudad .' '.$calle ),0,0,'L');
$pdf->ln();

$pdf->SetFont('Arial','B',11);
$pdf->Cell(42,10,utf8_decode('Sexo:' ),0,0,'L');
$pdf->SetFont('Arial','',11);
$pdf->Cell(75,10,utf8_decode($sexo),0,0,'L');
$pdf->ln();
$pdf->SetFont('Arial','B',11);
$pdf->Cell(42,10,utf8_decode('Correo Electronico:' ),0,0,'L');
$pdf->SetFont('Arial','',11);
$pdf->Cell(75,10,utf8_decode($correo),0,0,'L');
$pdf->ln();
$pdf->SetFont('Arial','B',11);
$pdf->Cell(42,10,utf8_decode('Lugar de Nacimiento:' ),0,0,'L');
$pdf->SetFont('Arial','',11);
$pdf->Cell(75,10,utf8_decode($ciudad.', '.$dia.' de '.$mes. ' de '.$anio),0,0,'L');
$pdf->ln();
$pdf->SetFont('Arial','B',11);
$pdf->Cell(42,10,utf8_decode('Estado Civil:' ),0,0,'L');
$pdf->SetFont('Arial','',11);
$pdf->Cell(75,10,utf8_decode($estado_civil),0,0,'L');
$pdf->ln();
$pdf->SetFont('Arial','',11);
$pdf->Cell(117,10,utf8_decode($ciudad.' - '.$nacionalidad),0,0,'L');
$pdf->ln();
$pdf->SetFont('Arial','U',15);
$pdf->Cell(195,20,utf8_decode(' Educación'),0,0,'L');
$pdf->ln();
$pdf->SetFont('Arial','B',11);
$pdf->Cell(45,10,utf8_decode('Colegio:' ),0,0,'L');
$pdf->SetFont('Arial','',11);
$pdf->Cell(75,10,utf8_decode($colegio),0,0,'L');
$pdf->ln();
$pdf->SetFont('Arial','B',11);
$pdf->Cell(45,10,utf8_decode('Liceo:' ),0,0,'L');
$pdf->SetFont('Arial','',11);
$pdf->Cell(75,10,utf8_decode($liceo),0,0,'L');
$pdf->ln();
$pdf->SetFont('Arial','B',11);
$pdf->Cell(45,10,utf8_decode('Instituto o Universidad:' ),0,0,'L');
$pdf->SetFont('Arial','',11);
$pdf->Cell(75,10,utf8_decode($instituto),0,0,'L');
$pdf->ln();
$pdf->SetFont('Arial','B',11);
$pdf->Cell(45,10,utf8_decode('Titulo:' ),0,0,'L');
$pdf->SetFont('Arial','',11);
$pdf->Cell(75,10,utf8_decode($titulo),0,0,'L');
$pdf->ln();
$pdf->AddPage('PORTRAIT','letter');
$pdf->ln();
$pdf->SetFont('Arial','U',20);
$pdf->Cell(195,10,utf8_decode(' Experiencia Laboral'),0,0,'L');
$pdf->ln();
$pdf->SetFont('Arial','B',11);
$pdf->Cell(45,10,utf8_decode('Empresa:' ),0,0,'L');
$pdf->SetFont('Arial','',11);
$pdf->Cell(75,10,utf8_decode($nombre_empresa),0,0,'L');
$pdf->ln();
$pdf->SetFont('Arial','B',11);
$pdf->Cell(45,10,utf8_decode('Actividad:' ),0,0,'L');
$pdf->SetFont('Arial','',11);
$pdf->Cell(75,10,utf8_decode($actividad_empresa),0,0,'L');
$pdf->ln();
$pdf->SetFont('Arial','B',11);
$pdf->Cell(45,10,utf8_decode('Puesto:' ),0,0,'L');
$pdf->SetFont('Arial','',11);
$pdf->Cell(75,10,utf8_decode($puesto),0,0,'L');
$pdf->ln();
$pdf->SetFont('Arial','B',11);
$pdf->Cell(45,10,utf8_decode('Nivel Experiencia:' ),0,0,'L');
$pdf->SetFont('Arial','',11);
$pdf->Cell(75,10,utf8_decode($nivel_experiencia),0,0,'L');
$pdf->ln();
$pdf->SetFont('Arial','B',11);
$pdf->Cell(45,10,utf8_decode('Desde:'),0,0,'L');
$pdf->SetFont('Arial','',11);
$pdf->Cell(45,10,utf8_decode($desde_mes .' '.$desde_año),0,0,'L');
$pdf->SetFont('Arial','B',11);
$pdf->Cell(45,10,utf8_decode('Hasta:'),0,0,'L');
$pdf->SetFont('Arial','',11);
$pdf->Cell(45,10,utf8_decode($hasta_mes .' '.$hasta_año),0,0,'L');
$pdf->ln();
$pdf->SetFont('Arial','B',11);
$pdf->Cell(45,10,utf8_decode('Area:' ),0,0,'L');
$pdf->SetFont('Arial','',11);
$pdf->Cell(75,10,utf8_decode($area_puesto),0,0,'L');
$pdf->ln();
$pdf->SetFont('Arial','B',11);
$pdf->Cell(45,10,utf8_decode('Subarea:' ),0,0,'L');
$pdf->SetFont('Arial','',11);
$pdf->Cell(75,10,utf8_decode($subarea),0,0,'L');
$pdf->ln();
$pdf->SetFont('Arial','B',11);
$pdf->Cell(45,10,utf8_decode('Responsabilidades:' ),0,0,'L');
$pdf->SetFont('Arial','',11);
$pdf->MultiCell(140, 10, utf8_decode($responsabilidades), 'C');
$pdf->ln();
$pdf->ln();
$pdf->SetFont('Arial','U',20);
$pdf->Cell(195,10,utf8_decode('Idiomas'),0,0,'L');
$pdf->ln();
$pdf->SetFont('Arial','B',11);
$pdf->Cell(45,10,utf8_decode('Idioma:' ),0,0,'L');
$pdf->SetFont('Arial','',11);
$pdf->Cell(75,10,utf8_decode($idioma),0,0,'L');
$pdf->ln();
$pdf->SetFont('Arial','B',11);
$pdf->Cell(45,10,utf8_decode('Nivel Oral:' ),0,0,'L');
$pdf->SetFont('Arial','',11);
$pdf->Cell(75,10,utf8_decode($nivel_oral),0,0,'L');
$pdf->ln();
$pdf->SetFont('Arial','B',11);
$pdf->Cell(45,10,utf8_decode('Nivel Escrito:' ),0,0,'L');
$pdf->SetFont('Arial','',11);
$pdf->Cell(75,10,utf8_decode($nivel_escrito),0,0,'L');
//$modo="I";
//$pdf->Output('Mi Curriclum Vitae',$modo);
$pdf->Close();
$pdf->Output('I','Mi Curriculum Vitae.pdf');

}
?>