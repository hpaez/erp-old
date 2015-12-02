<?php
require('../../fpdf.php');
include('../../operaciones.php');
conectar();
apruebadeintrusos();

if($_SESSION['cargo_user']=="Administrador"){
    if(isset($_POST['rut'])){
        $query = "select * from trabajador where rut='".$_POST['rut']."'";
        $result = mysql_query($query);
        $total = mysql_num_rows($result);
        if($total>=1){
            while($row = mysql_fetch_array($result)){
                $nombre=$row["nombre"];
                $apellidop=$row["apellidoPaterno"];
                $apellidom=$row["apellidoMaterno"];
            }
        }
        
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Helvetica', 'B', 14);
        $pdf->Write (7,utf8_decode("Declara el trabajador que, en todo caso, y a todo evento, renuncia expresamente a cualquier derecho, accion o reclamo que eventualmente tuviere o pudiere corresponderle en contra del empleador, en relación directa o indirecta con su contrato de trabajo, con los servicios prestados, con la terminación del referido contrato o dichos servicios, sepa que esos derechos o acciones correspondan a remuneraciones, cotizaciones previsionales, de seguridad social o de salud, subsidios, beneficios contractuales adicionales a las remuneraciones, indemnizaciones compensaciones, o con cualquier otra causa o concepto.
        Para constancia, las partes firman el presente finiquito en tres ejemplares, quedando uno en poder de cada una de ellas, y en cumplimiento de la legislación vigente, Don(a) ".$nombre." ".$apellidop." ".$apellidom." lo lee, firma y lo ratifica ante .........................................................





        .........................................
        TRABAJADOR
        RUT ".$_POST['rut']."  	..........................................
        EMPLEADOR
        RUT ".$_SESSION['rut_user']."...........................................



        ..........................................
        MINISTRO DE FE
        RUT ............................................ 



        ").$_POST['rut']);
        $pdf->Output('finiquito.pdf','D');
        exit;
    } else {
        header('Location: ../contrato.php');
    }
} else {
    echo"<script>window.location.href='../../index.php';</script>";
}
?>
