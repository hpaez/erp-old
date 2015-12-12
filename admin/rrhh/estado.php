<?php
include("../../operaciones.php");
conectar();

if($_SESSION['cargo_user']!="Administrador"){
	header('Location: ../../login.php');
}

switch($_GET['opcion']){
	case 1: modificarAprobadoLicencia();
	        break;
    case 2: modificarRechazadoLicencia();
	        break;
    case 4: modificarAprobadoVacacion();
        break;
    case 3: modificarRechazadoVacacion();
        break;
}

function modificarAprobadoLicencia(){
    $sql="update licencia set estado='Rechazado' where idLicencia=".$_GET['id'];
	mysql_query($sql);
	
	header("Location: licencia.php");
}

function modificarRechazadoLicencia(){
    $sql="update licencia set estado='Aprobado' where idLicencia=".$_GET['id'];
	mysql_query($sql);
	
	header("Location: licencia.php");
}

function modificarAprobadoVacacion(){
    $sql="update solicitud_vacacion set estado='Rechazado' where idVacacion=".$_GET['id'];
	mysql_query($sql);
	
	header("Location: vacacion.php");
}

function modificarRechazadoVacacion(){
    $sql="update solicitud_vacacion set estado='Aprobado' where idVacacion=".$_GET['id'];
	mysql_query($sql);
	
	header("Location: vacacion.php");
}
?>