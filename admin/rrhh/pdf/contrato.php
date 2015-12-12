<?php
require('../../../fpdf.php');
include('../../../operaciones.php');
conectar();
apruebadeintrusos();

if($_SESSION['cargo_user']=="Administrador"){
    if(isset($_POST['rut'])){
        $sql_trabajador="select * from trabajador where rut='".$_POST['rut']."'";
        $resul_trabajador=mysql_query($sql_trabajador);
        $datos_trab=mysql_fetch_array($resul_trabajador);

        $mes=mesLetras(fecha_mes($datos_trab['fechaNacimiento']));
        $ano=fecha_ano($datos_trab['fechaNacimiento']);
        $dia=fecha_dia($datos_trab['fechaNacimiento']);
        $sueldo=$datos_trab['sueldo'];

        if($datos_trab['sexo']=='Masculino'){
            $sexo="señor";
            $cargo="trabajador";
            $diferenciador="el";
        } else {
            $sexo="señora";
            $cargo="trabajadora";
            $diferenciador="la";
        }


        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Helvetica','B',14);
        $pdf->Write(7,utf8_decode("La Empresa PENKAS RUT N° 99.512.151-3 ambos domiciliados para estos efectos en el lugar en que funciona el Establecimiento, calle asikalaos #6969 de esta misma ciudad, en adelante el señor Hugo Paez y $diferenciador $sexo ".$datos_trab['nombre']." ".$datos_trab['apellidoPaterno']." ".$datos_trab['apellidoMaterno'].", RUT N° ".$datos_trab['rut']." con domicilio en la calle ".$datos_trab['direccion']." de la ciudad de Pto.Velero, con fecha de nacimiento el $dia de $mes del $ano, en adelante el ".strtoupper($cargo).", se celebra el presente Contrato de ".$datos_trab['contrato'].":
        ".ucwords($diferenciador)." $cargo deberá confeccionar o elaborar las siguientes piezas o unidades.
        La duración y distribución de la jornada de trabajo será: Lunes a Viernes, desde las 9:30 horas hasta las 18:30 horas, con horario de colación desde las 13:30 horas hasta las 14:30 horas .
        Por cada pieza fabricada (o trabajo específico ejecutado) recibira la cantidad de $ $sueldo pagada en el período que se indica mensual.
        El empleador se compromete a otorgar a suministrar al trabajador los siguientes beneficios a)..........b)..........c)..........
        El trabajador se compromete y obliga expresamente a cumplir las instrucciones que le sean impartidas por su jefe inmediato o por la gerencia de la empresa, en relacion a su trabajo, y acatar en todas sus partes las normas del Reglamento Interno de Orden, Higiene y Seguridad (cuando exista en la empresa), las que declara conocer y que forman parte integrante del presente contrato, reglamento del cual se le entrega un ejemplar.
        El presente contrato de trabajo tendrá una duración de un año.
        Las partes acuerdan los siguientes Pactos:
        1.- El trabajador, aparte del trabajo especifico que se le encomienda, se compromete a reemplazar a otro trabajador, cuando por razones de enfermedad u otras, no concurra a sus labores y se trate de un trabajo compatible con el suyo, no percibiendo menos remuneración, es decir, manteniendo su Trato.
        ").$_POST['rut']);
        $pdf->Output('contrato.pdf','D');
    } else {
        header('Location: ../contrato.php');
    }
} else {
    header('Location: ../../login.php');
}
?>