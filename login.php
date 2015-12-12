<?php
include ("operaciones.php");

conectar();
session_start();
session_destroy();

if(isset($_POST['enviar'])){
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
			header('Location: admin/rrhh/index.php');
		}else if($datos['cargo']=="Empleado"){
			header('Location: admin/empleado/index.php');
		} else {
			header('Location: admin/bodega/index.php');
		}
	}else{
		echo"<script>
				alert('Usuario no encontrado o password erronea');
				window.location.href='index.php';
			</script>";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>PNKKS - Inicio de Sesión</title>

		<!-- BEGIN META -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="keywords" content="your,keywords">
		<meta name="description" content="Short explanation about this website">
		<!-- END META -->

		<!-- BEGIN STYLESHEETS -->
		<link href='http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900' rel='stylesheet' type='text/css'/>
		<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
		<link type="text/css" rel="stylesheet" href="css/materialadmin.css" />
		<link type="text/css" rel="stylesheet" href="css/font-awesome.min.css" />
		<link type="text/css" rel="stylesheet" href="css/material-design-iconic-font.min.css" />
		<!-- END STYLESHEETS -->
	</head>
	<body class="menubar-hoverable header-fixed ">
		<!-- BEGIN LOGIN SECTION -->
		<section class="section-account">
			<div class="img-backdrop"></div>
			<div class="spacer"></div>
			<div class="card contain-sm style-transparent">
				<div class="card-body">
					<div class="row">
						<div class="col-sm-6 col-sm-offset-3">
							<br/>
							<span class="text-lg text-bold text-primary">PNKS LTDA</span>
							<br/><br/>
							<form class="form form-validate floating-label" action="<?php echo $_SERVER['PHP_SELF']; ?>" accept-charset="utf-8" method="post">
								<div class="form-group">
									<input type="text" class="form-control" id="rut" name="rut" required data-rule-minlength="9" maxlength="12" data-rule-rut="true">
									<label for="rut">RUT</label>
								</div>
								<div class="form-group">
                                    <input type="password" class="form-control" id="password" name="password" required data-rule-minlength="5" maxlength="20">
                                    <label for="password">Contraseña</label>
                                    <span id="show-hide-password" action="hide" class="form-control-feedback glyphicon glyphicon-eye-open"></span>
									<p class="help-block"><a href="#">¿Olvidaste tu Contraseña?</a></p>
								</div>
								<br/>
								<div class="row">
									<div class="col-xs-6 text-left">
										<div class="checkbox checkbox-inline checkbox-styled">
											<label>
												<input type="checkbox"> <span>Recordar</span>
											</label>
										</div>
									</div><!--end .col -->
									<div class="col-xs-6 text-right">
										<button class="btn btn-primary btn-raised" type="submit" id="enviar" name="enviar">Iniciar Sesión</button>
									</div><!--end .col -->
								</div><!--end .row -->
							</form>
						</div><!--end .col -->
					</div><!--end .row -->
				</div><!--end .card-body -->
			</div><!--end .card -->
		</section>
		<!-- END LOGIN SECTION -->
		<!-- BEGIN JAVASCRIPT -->
		<script src="js/libs/jquery/jquery-1.11.2.min.js"></script>
        <script src="js/libs/jquery/jquery-migrate-1.2.1.min.js"></script>
        <script src="js/libs/bootstrap/bootstrap.min.js"></script>
        <script src="js/libs/spin.js/spin.min.js"></script>
        <script src="js/libs/autosize/jquery.autosize.min.js"></script>
        <script src="js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
        <script src="js/libs/jquery-validation/dist/jquery.validate.min.js"></script>
		<script src="js/libs/jquery-validation/dist/additional-methods.min.js"></script>
        <script src="js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
        <script src="js/core/source/App.js"></script>
        <script src="js/core/source/AppNavigation.js"></script>
        <script src="js/core/source/AppOffcanvas.js"></script>
        <script src="js/core/source/AppCard.js"></script>
        <script src="js/core/source/AppForm.js"></script>
        <script src="js/core/source/AppNavSearch.js"></script>
        <script src="js/core/source/AppVendor.js"></script>
        <script src="js/jquery.Rut.min.js"></script>
        <script src="js/ocultarpassword.js"></script>
        <script type="text/javascript">
			$(document).ready(function(){
				$('#rut').Rut({
					format_on: 'keyup'
				});
				$("#rut").validate();
			});
		</script>
        <!-- END JAVASCRIPT -->
    </body>
</html>
