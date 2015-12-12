<?php
include('../../../operaciones.php');
conectar();
apruebadeintrusos();
if($_SESSION['cargo_user']!="Empleado"){
	header('Location: ../../../login.php');
}

if($_SESSION['cargo_user']=="Empleado"){
	$sql_vac="select * from estado_vacacion where nombre='".date('Y')."'";
	$resul_vac=mysql_query($sql_vac);
	$datos_vac=mysql_fetch_array($resul_vac);
    
    $sql_trab="select fechaIngreso from trabajador where rut='".$_SESSION['rut_user']."'";
    $resul_trab=mysql_query($sql_trab);
	$datos_trab=mysql_fetch_array($resul_trab);
} else {
	header('Location: ../../../login.php');
}

if((isset($_POST['enviarVacacion'])) && (empty($_POST['end']) != true && empty($_POST['start']) != true && empty($_POST['motivo']) != true)){
    $rut=$_SESSION['rut_user'];
    $inicio=fecha_bd($_POST['start']);
    $estado=$datos_vac['idEstadoVacacion'];
    $fin=fecha_bd($_POST['end']);
    $motivo=$_POST['motivo'];
    $fechaIngreso=(date('Y') - fecha_ano($datos_trab['fechaIngreso']));
    if($fechaIngreso < 1){
        $tipoEmpleado = "Nuevo";
    } else if($fechaIngreso < 5){
        $tipoEmpleado = "Intermedio";
    } else {
        $tipoEmpleado = "Antiguo";
    }
    $csql="insert into solicitud_vacacion (idTrabajador,idEstadoVacacion,fechaInicio,fechaFin,tipoEmpleado,motivo,estado) values ('$rut','$estado','$inicio','$fin','$tipoEmpleado','$motivo','Pendiente')";
    mysql_query($csql);
    echo"<script>alert('Se ha enviado la solicitud de vacaciones correctamente.');</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>PNKS Portal Empleado - Solicitar Vacaciones</title>

		<!-- BEGIN META -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="keywords" content="your,keywords">
		<meta name="description" content="Short explanation about this website">
		<!-- END META -->

		<!-- BEGIN STYLESHEETS -->
		<link href='http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900' rel='stylesheet' type='text/css'/>
		<link type="text/css" rel="stylesheet" href="../../../css/bootstrap.css" />
		<link type="text/css" rel="stylesheet" href="../../../css/materialadmin.css" />
		<link type="text/css" rel="stylesheet" href="../../../css/font-awesome.min.css" />
		<link type="text/css" rel="stylesheet" href="../../../css/material-design-iconic-font.min.css" />
		<link type="text/css" rel="stylesheet" href="../../../css/libs/bootstrap-datepicker/datepicker3.css" />
		<!-- END STYLESHEETS -->

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script type="text/javascript" src="../../assets/js/libs/utils/html5shiv.js?1403934957"></script>
		<script type="text/javascript" src="../../assets/js/libs/utils/respond.min.js?1403934956"></script>
		<![endif]-->
	</head>
	<body class="menubar-hoverable header-fixed menubar-first menubar-visible menubar-pin">
		<!-- BEGIN HEADER-->
		<header id="header" >
			<div class="headerbar">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="headerbar-left">
					<ul class="header-nav header-nav-options">
						<li class="header-nav-brand" >
							<div class="brand-holder">
								<a href="">
									<span class="text-lg text-bold text-primary">PNKS LTDA</span>
								</a>
							</div>
						</li>
						<li>
							<a class="btn btn-icon-toggle menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
								<i class="fa fa-bars"></i>
							</a>
						</li>
					</ul>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="headerbar-right">
					<ul class="header-nav header-nav-profile">
						<li class="dropdown">
							<a href="javascript:void(0);" class="dropdown-toggle ink-reaction" data-toggle="dropdown">
								<?php
                                    if(file_exists('../../../img/usuarios/'.$_SESSION['foto_user'])){
                                ?>
                                    <img src="../../../img/usuarios/<?php echo $_SESSION['foto_user']; ?>" alt="" />
                                <?php
                                    } else {
                                ?>
                                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNzEiIGhlaWdodD0iMTgwIj48cmVjdCB3aWR0aD0iMTcxIiBoZWlnaHQ9IjE4MCIgZmlsbD0iI2VlZSI+PC9yZWN0Pjx0ZXh0IHRleHQtYW5jaG9yPSJtaWRkbGUiIHg9Ijg1LjUiIHk9IjkwIiBzdHlsZT0iZmlsbDojYWFhO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1zaXplOjEycHg7Zm9udC1mYW1pbHk6QXJpYWwsSGVsdmV0aWNhLHNhbnMtc2VyaWY7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+MTcxeDE4MDwvdGV4dD48L3N2Zz4="/>
                                <?php
                                    }
                                ?>
								<span class="profile-info">
									<?php echo $_SESSION['usuario_session']; ?>
									<small><?php echo $_SESSION['cargo_user']; ?></small>
								</span>
							</a>
							<ul class="dropdown-menu animation-dock">
								<li class="dropdown-header">Opciones de Cuenta</li>
								<li><a href="../../opcion/cambiarclave.php">Cambiar Clave</a></li>
								<li><a href="../../opcion/cambiarficha.php">Cambiar Datos Personales</a></li>
                                <li><a href="../../opcion/cambiarfoto.php">Cambiar Foto de Perfil</a></li>
								<li class="divider"></li>
								<li><a href="../../../login.php" onClick=""><i class="fa fa-fw fa-power-off text-danger"></i> Salir</a></li>
							</ul><!--end .dropdown-menu -->
						</li><!--end .dropdown -->
					</ul><!--end .header-nav-profile -->
				</div><!--end #header-navbar-collapse -->
			</div>
		</header>
		<!-- END HEADER-->
		<!-- BEGIN BASE-->
		<div id="base">

			<!-- BEGIN OFFCANVAS LEFT -->
			<div class="offcanvas">
			</div><!--end .offcanvas-->
			<!-- END OFFCANVAS LEFT -->

			<!-- BEGIN CONTENT-->
			<div id="content">
				<section>
					<div class="section-body">
						<div class="row">
							<div class="col-lg-offset col-md-12">
                                <div class="card">
                                    <div class="card-head style-primary">
										<header>Solicitud de Vacaciones</header>
									</div>
                                    <form class="form form-validate floating-label" action="<?php echo $_SERVER['PHP_SELF']; ?>" accept-charset="utf-8" method="post" novalidate>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <div class="input-group input-daterange" id="demo-date-range">
                                                    <div class="input-group-content">
                                                        <input type="text" class="form-control" name="start" id="start" required/>
                                                        <label for="start">Fecha Inicio</label>
                                                    </div>
                                                    <span class="input-group-addon">a</span>
                                                    <div class="input-group-content">
                                                        <input type="text" class="form-control" name="end" id="end" required/>
                                                        <label ="end">Fecha Fin</label>
                                                        <div class="form-control-line"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <textarea name="motivo" id="motivo" class="form-control" rows="3" maxlength="200" style="resize:none;" required></textarea>
                                                <label for="motivo">Motivo</label>
                                            </div>
                                        </div><!--end .card-body -->
                                        <div class="card-actionbar">
                                            <div class="card-actionbar-row">
                                                <button type="submit" class="btn btn-flat btn-primary ink-reaction" id="enviarVacacion" name="enviarVacacion">Enviar Solicitud</button>
                                                <button type="submit" class="btn btn-flat btn-primary ink-reaction" id="imprimirVacacion" name="imprimirVacacion">Enviar Solicitud & Imprimir</button>
                                            </div>
                                        </div><!--end .card-actionbar -->
                                    </form>
                                </div><!--end .card -->
                            </div>
						</div><!--end .row -->
						<!-- END TAGS INPUT -->
					</div><!--end .section-body -->
				</section>
			</div><!--end #content-->
			<!-- END CONTENT -->

			<!-- BEGIN MENUBAR-->
			<div id="menubar" class="menubar-first">
				<div class="menubar-fixed-panel">
					<div>
						<a class="btn btn-icon-toggle btn-default menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
							<i class="fa fa-bars"></i>
						</a>
					</div>
					<div class="expanded">
						<a href="">
							<span class="text-lg text-bold text-primary ">PNKS&nbsp;LTDA</span>
						</a>
					</div>
				</div>
				<div class="menubar-scroll-panel">
					<!-- BEGIN MAIN MENU -->
					<ul id="main-menu" class="gui-controls">
						<!-- BEGIN DASHBOARD -->
						<li>
							<a href="../index.php">
								<div class="gui-icon"><i class="md md-home"></i></div>
								<span class="title">Inicio</span>
							</a>
						</li>
                        <!-- END DASHBOARD -->
                        <!-- BEGIN DASHBOARD -->
                        <li>
							<a href="../personal.php">
								<div class="gui-icon"><i class="md md-web"></i></div>
								<span class="title">Información Personal</span>
							</a>
						</li><!--end /menu-li -->
						<!-- END DASHBOARD -->
                        <!-- BEGIN EMAIL -->
						<li>
                        <li>
							<a href="../contrato.php">
								<div class="gui-icon"><i class="glyphicon glyphicon-list-alt"></i></div>
								<span class="title">Contrato y Finiquito</span>
							</a>
						</li><!--end /menu-li -->
                        <!-- END EMAIL -->
                        <!-- BEGIN EMAIL -->
						<li>
                        <li>
							<a href="../liquidacion.php">
								<div class="gui-icon"><i class="fa fa-folder-open fa-fw"></i></div>
								<span class="title">Liquidaciones</span>
							</a>
						</li><!--end /menu-li -->
                        <!-- END EMAIL -->
                        <!-- BEGIN EMAIL -->
						<li class="gui-folder">
							<a>
								<div class="gui-icon"><i class="fa fa-table"></i></div>
								<span class="title">Vacaciones</span>
							</a>
                            <!--start submenu -->
							<ul>
                            	<li><a href="solicitud.php" class="active"><span class="title">Solicitud de Vacacion</span></a></li>
                            	<li><a href="consultar.php"><span class="title">Consultar Vacaciones</span></a></li>
							</ul><!--end /submenu -->
						</li><!--end /menu-li -->
                        <!-- END EMAIL -->
                        <!-- BEGIN EMAIL -->
						<li>
							<a href="../certificado.php">
								<div class="gui-icon"><i class="fa fa-cloud-download"></i></div>
								<span class="title">Certificado de Antiguedad</span>
							</a>
						</li><!--end /menu-li -->
                        <!-- END EMAIL -->
                        <!-- BEGIN EMAIL -->
						<li>
							<a href="../asistencia.php">
								<div class="gui-icon"><i class="md md-web"></i></div>
								<span class="title">Asistencia</span>
							</a>
						</li><!--end /menu-li -->
                        <!-- END EMAIL -->
                        <!-- BEGIN EMAIL -->
						<li>
							<a href="../licencia.php">
								<div class="gui-icon"><i class="fa fa-ambulance"></i></div>
								<span class="title">Licencias Médicas</span>
							</a>
						</li><!--end /menu-li -->
                        <!-- END EMAIL -->
                        <!-- BEGIN EMAIL -->
						<li>
							<a href="../anticipo.php">
								<div class="gui-icon"><i class="fa fa-usd"></i></div>
								<span class="title">Solicitar Anticipo</span>
							</a>
						</li><!--end /menu-li -->
                        <!-- END EMAIL -->
					</ul><!--end .main-menu -->
					<!-- END MAIN MENU -->
					<div class="menubar-foot-panel">
						<small class="no-linebreak hidden-folded">
							<span class="opacity-75">&copy; <?php echo date('Y'); ?></span> <strong>GH Soluciones Informáticas</strong>
						</small>
					</div>
				</div><!--end .menubar-scroll-panel-->
			</div><!--end #menubar-->
			<!-- END MENUBAR -->
		</div><!--end #base-->
		<!-- END BASE -->

		<!-- BEGIN JAVASCRIPT -->
		<script src="../../../js/libs/jquery/jquery-1.11.2.min.js"></script>
		<script src="../../../js/libs/jquery/jquery-migrate-1.2.1.min.js"></script>
		<script src="../../../js/libs/jquery-ui/jquery-ui.min.js"></script>
		<script src="../../../js/libs/bootstrap/bootstrap.min.js"></script>
		<script src="../../../js/libs/spin.js/spin.min.js"></script>
		<script src="../../../js/libs/autosize/jquery.autosize.min.js"></script>
        <script src="../../../js/libs/jquery-validation/dist/jquery.validate.min.js"></script>
		<script src="../../../js/libs/jquery-validation/dist/additional-methods.min.js"></script>
		<script src="../../../js/libs/moment/moment.min.js"></script>
		<script src="../../../js/libs/bootstrap-datepicker/bootstrap-datepicker.js"></script>
		<script src="../../../js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
		<script src="../../../js/core/source/App.js"></script>
		<script src="../../../js/core/source/AppNavigation.js"></script>
		<script src="../../../js/core/source/AppOffcanvas.js"></script>
		<script src="../../../js/core/source/AppCard.js"></script>
		<script src="../../../js/core/source/AppForm.js"></script>
		<script src="../../../js/core/source/AppNavSearch.js"></script>
		<script src="../../../js/core/source/AppVendor.js"></script>
		<script src="../../../js/core/demo/Demo.js"></script>
		<script src="../../../js/core/demo/DemoFormComponents.js"></script>
		<!-- END JAVASCRIPT -->

	</body>
</html>