<?php
include ("../../operaciones.php");
conectar();
apruebadeintrusos();

if($_SESSION['cargo_user']=='Administrador'){
    $rut = $_POST['valorBusqueda'];
    $csql="select sueldo from trabajador where rut='$rut'";
    $consulta=mysql_query($csql);
    while($resultados = mysql_fetch_array($consulta)) {
                $sueldo = $resultados['sueldo'];
                $mensaje1 = '<input id="sueldo" readonly="readonly" class="form-control" type="string" name="sueldo" value="'.$sueldo.'" onFocus="startCalc();" onBlur="stopCalc();" />';
                echo $mensaje1;
    }
} else {
    echo"<script>window.location.href='../../index.php';</script>";
}
?>