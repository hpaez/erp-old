<?php
include ("../../../operaciones.php");
conectar();
apruebadeintrusos();

if($_SESSION['cargo_user']=='Administrador'){
    $rut = $_POST['valorBusqueda'];
    $csql="select afp from trabajador where rut='$rut'";
    $consulta=mysql_query($csql);
    while($resultados = mysql_fetch_array($consulta)) {
                $afp=$resultados['afp'];
                $mensaje2 ='<input id="afp"  readonly="readonly" class="form-control" type="string" name="afp" value="'.$afp.'" onFocus="startCalc();" onBlur="stopCalc();" />';
                echo $mensaje2;
    }
} else {
    echo"<script>window.location.href='../../../login.php';</script>";
}
?>