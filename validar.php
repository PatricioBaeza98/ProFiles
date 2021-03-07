<?php 
session_start();
include('funciones.php');
$cnn=Conectar();
$user=mysqli_real_escape_string($cnn,$_POST["usuario"]);
$pass=mysqli_real_escape_string($cnn,$_POST["contraseña"]);
$login_de_usuarios="SELECT usuario.rut,usuario.nombre,usuario.usua,usuario.pass,tipos_usu.tipo_usuario FROM usuario INNER JOIN tipos_usu ON (usuario.tipo=tipos_usu.id) WHERE (usuario.usua='$user') AND (usuario.pass='$pass')";
$resultados=mysqli_query($cnn,$login_de_usuarios);
if(mysqli_num_rows($resultados)!=0){
	if($row=mysqli_fetch_array($resultados)){
		$_SESSION['$varut'] = $row['rut'];
   		$_SESSION['$vanombre'] = $row['nombre'];
    	$_SESSION['$vatipo'] = $row['tipo_usuario'];
    	switch($_SESSION['$vatipo']){
    		case 'Empresa':
    			echo "<script type='text/javascript'>window.location='empresa.php'</script>";
    			break;
    		case 'Cliente':
    			echo "<script type='text/javascript'>window.location='cliente.php'</script>";
    			break;
    		case 'Admin':
    			echo "<script type='text/javascript'>window.location='admin.php'</script>";
    			break;

    	}
	}

}else{
	echo "<script>alert('Usuario o Contraseña Incorrectos')</script>";
	echo "<script type='text/javascript'>window.location='index.php'</script>";
}
?>