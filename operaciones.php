<?php

function conectar(){
	$db_host="localhost";
	$db_usuario="root";
	$db_password="123456";
	$db_nombre="erp";
	$conexion = @mysql_connect($db_host, $db_usuario, $db_password) or die(mysql_error());
	$db = @mysql_select_db($db_nombre, $conexion) or die(mysql_error());
	if( $conexion == false ) {
    	echo "Conexión no se pudo establecer.";
        die( print_r( sqlsrv_errors(), true));
	}
	mysql_query("SET NAMES 'utf8'");
}

function apruebadeintrusos(){
	session_start();
	if(!(isset($_SESSION['cargo_user']))){
		header('Location:intruso.php');
	}
}

function borrarPuntos($renta){
    $miles=str_replace('.','',$renta);
    
    return($miles);
}

function borrarGuion($renta){
    $miles=str_replace('_','',$renta);
    
    return($miles);
}

function borrarCompleto($renta){
    $miles=str_replace('.','',$renta);
    $guionormal=str_replace('-','',$miles);
    $guionbajo=str_replace('_','',$guionormal);
    
    return($guionbajo);
}

function generaPass(){
    $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    $longitudCadena=strlen($cadena);
    $pass = "";
    $longitudPass=10;
    for($i=1 ; $i<=$longitudPass ; $i++){
        $pos=rand(0,$longitudCadena-1);
        $pass= substr($cadena,$pos,1);
    }
    return $pass;
}

function mesLetras($fecha){
    if(strlen($fecha) == '10'){
        $mes=substr($fecha,5,2);
        if($mes=='01'){
            $fecha_escrita="Enero";
        } else if($mes=='02'){
            $fecha_escrita="Febrero";
        } else if($mes=='03'){
            $fecha_escrita="Marzo";
        } else if($mes=='04'){
            $fecha_escrita="Abril";
        } else if($mes=='05'){
            $fecha_escrita="Mayo";
        } else if($mes=='06'){
            $fecha_escrita="Junio";
        } else if($mes=='07'){
            $fecha_escrita="Julio";
        } else if($mes=='08'){
            $fecha_escrita="Agosto";
        } else if($mes=='09'){
            $fecha_escrita="Septiembre";
        } else if($mes=='10'){
            $fecha_escrita="Octubre";
        } else if($mes=='11'){
            $fecha_escrita="Noviembre";
        } else {
            $fecha_escrita="Diciembre";
        }
    } else {
        $mes = $fecha;
        if($mes=='01'){
            $fecha_escrita="Enero";
        } else if($mes=='02'){
            $fecha_escrita="Febrero";
        } else if($mes=='03'){
            $fecha_escrita="Marzo";
        } else if($mes=='04'){
            $fecha_escrita="Abril";
        } else if($mes=='05'){
            $fecha_escrita="Mayo";
        } else if($mes=='06'){
            $fecha_escrita="Junio";
        } else if($mes=='07'){
            $fecha_escrita="Julio";
        } else if($mes=='08'){
            $fecha_escrita="Agosto";
        } else if($mes=='09'){
            $fecha_escrita="Septiembre";
        } else if($mes=='10'){
            $fecha_escrita="Octubre";
        } else if($mes=='11'){
            $fecha_escrita="Noviembre";
        } else {
            $fecha_escrita="Diciembre";
        }
    }
    
	return($fecha_escrita);
}

function fecha_dia($fecha){
	$dia=substr($fecha,8,2);
	return($dia);
}

function fecha_mes($fecha){
	$mes=substr($fecha,5,2);
	return($mes);
}

function fecha_ano($fecha){
	$ano=substr($fecha,0,4);
	return($ano);
}

function fecha_esp($fecha){
	$dia=substr($fecha,8,2);
    $mes=substr($fecha,5,2);
    $ano=substr($fecha,0,4);

    $fecha_real=$dia."/".$mes."/".$ano;
	return($fecha_real);
}

function fecha_bd($fecha){
	$dia=substr($fecha,0,2);
    $mes=substr($fecha,3,2);
    $ano=substr($fecha,6,4);

    $fecha_real=$ano."-".$mes."-".$dia;
	return($fecha_real);
}
?>