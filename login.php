<?php

include ("operaciones.php");
conectar();

$csql="select * from trabajador where (password='".$_POST['password']."' and rut='".$_POST['rut']."') and estado = '1'";
$result=mysql_query($csql);
$datos=mysql_fetch_array($result);
$cont=mysql_num_rows($result);

if($cont!=0){
	session_start();
	$_SESSION['usuario_session']=$datos['nombre']." ".$datos['apellidoPaterno'];
    $_SESSION['nombre_completo']=$datos['nombre']." ".$datos['apellidoPaterno']. " ".$datos['apellidoMaterno'];
	$_SESSION['rut_user']=$datos['rut'];
	$_SESSION['cargo_user']=$datos['cargo'];
    $_SESSION['contrato_user']=$datos['contrato'];
	$_SESSION['tel_user']=$datos['telefono'];
	$_SESSION['email_user']=$datos['email'];
    $_SESSION['fecha_ingreso']=$datos['fechaIngreso'];
    $_SESSION['sexo_user']=$datos['sexo'];
    $_SESSION['fecha_nac']=$datos['fechaNacimiento'];
	$_SESSION['dir_user']=$datos['direccion'];
    $_SESSION['foto_user']=str_replace('-','',str_replace('.','',$datos['rut'])).".png";
	if($datos['cargo']=="Administrador"){
		header('Location: rrhh/index.php');
	}else if($datos['cargo']=="Empleado"){
		header('Location: empleado/index.php');
	} else {
		header('Location: bodega/index.php');
	}
}else{
	echo"<script>
			alert('Usuario no encontrado o password erronea');
			window.location.href='index.php';
		</script>";
}
?>