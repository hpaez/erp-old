<?php
include('../operaciones.php');
conectar();
apruebadeintrusos();
if($_SESSION['cargo_user']!="Administrador"){
	header('Location: ../index.php');
}
?>
<html lang="en">
	<head>
		<title>PNKS Recurso Humano - Generar Liquidación</title>

		<!-- BEGIN META -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="keywords" content="your,keywords">
		<meta name="description" content="Short explanation about this website">
		<!-- END META -->

		<!-- BEGIN STYLESHEETS -->
		<link href='http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900' rel='stylesheet' type='text/css'/>
		<link type="text/css" rel="stylesheet" href="../css/bootstrap.css" />
		<link type="text/css" rel="stylesheet" href="../css/materialadmin.css" />
		<link type="text/css" rel="stylesheet" href="../css/font-awesome.min.css" />
		<link type="text/css" rel="stylesheet" href="../css/material-design-iconic-font.min.css" />
		<link type="text/css" rel="stylesheet" href="../css/libs/DataTables/jquery.dataTables.css" />
		<link type="text/css" rel="stylesheet" href="../css/libs/DataTables/extensions/dataTables.colVis.css" />
		<link type="text/css" rel="stylesheet" href="../css/libs/DataTables/extensions/dataTables.tableTools.css" />
		<!-- END STYLESHEETS -->

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script type="text/javascript" src="js/libs/utils/html5shiv.js?1403934957"></script>
		<script type="text/javascript" src="js/libs/utils/respond.min.js?1403934956"></script>
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
                                    if(file_exists('../img/usuarios/'.$_SESSION['foto_user'])){
                                ?>
                                    <img src="../img/usuarios/<?php echo $_SESSION['foto_user']; ?>" alt="" />
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
								</span>
							</a>
							<ul class="dropdown-menu animation-dock">
								<li class="dropdown-header">Opciones de Cuenta</li>
								<li><a href="../opcion/cambiarclave.php">Cambiar Clave</a></li>
								<li><a href="../opcion/cambiarficha.php">Cambiar Datos Personales</a></li>
                                <li><a href="../opcion/cambiarfoto.php">Cambiar Foto de Perfil</a></li>
								<li class="divider"></li>
								<li><a href="../index.php"onClick=""><i class="fa fa-fw fa-power-off text-danger"></i> Salir</a></li>
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
										<header>Generar Liquidación</header>
									</div>
                                    <form class="form form-validate floating-label" action="<?php echo $_SERVER['PHP_SELF']; ?>" accept-charset="utf-8" method="post" enctype="multipart/form-data" novalidate>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <select id="rut" name="rut" class="form-control" required>
                                                            <option value="">&nbsp;</option>
                                                            <?php
                                                                $ru=mysql_query("select rut from trabajador where estado='1'");
                                                                while (list($rut)=mysql_fetch_array($ru)){
                                                            ?>
                                                            <option value='<?php echo $rut ?>'><?php echo $rut ?></option>
                                                            <?php
                                                                }
                                                            ?>
                                                        </select>
                                                        <label for="rut">RUT</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="sueldo" name="sueldo" required>
                                                        <label for="sueldo">Sueldo</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="graficacion" name="graficacion" required>
                                                        <label for="graficacion">Graficación</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="comision" name="comision" required>
                                                        <label for="comision">Comisión</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="bono1" name="bono1" required>
                                                        <label for="bono1">Bono 1</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="bono2" name="bono2" required>
                                                        <label for="bono2">Bono 2</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="horaextra" name="horaextra" required>
                                                        <label for="horaextra">Hora Extra</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="colacion" name="colacion" required>
                                                        <label for="colacion">Colación</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="movilizacion" name="moviilizacion" required>
                                                        <label for="movilizacion">Movilización</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="haber" name="haber" required>
                                                        <label for="haber">Total Haber</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="baseimponible" name="baseimponible" required>
                                                        <label for="baseimponible">Base Imponible</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="afp" name="afp" required>
                                                        <label for="afp">AFP</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="isapre" name="isapre" required>
                                                        <label for="isapre">ISAPRE</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="bimponible" name="bimponible" required>
                                                        <label for="bimponible">Base Imponible</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="seguro" name="seguro" required>
                                                        <label for="seguro">Seguro</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="apv" name="apv" required>
                                                        <label for="apv">APV</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="basetributable" name="basetributable" required>
                                                        <label for="basetributable">Base Tributable</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="impuesto" name="impuesto" required>
                                                        <label for="impuesto">Impuesto</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="descuento" name="descuento" required>
                                                        <label for="descuento">Total Descuento</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="liquido" name="liquido" required>
                                                        <label for="liquido">Total Liquido</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-actionbar">
                                            <div class="card-actionbar-row">
                                                <button type="submit" class="btn btn-flat btn-primary ink-reaction" name="enviar" id="enviar">Ingresar Liquidación</button>
                                            </div>
                                        </div><!--end .card-actionbar -->
                                    </form>
                                </div>
                            </div>
						</div><!--end .row -->
					</div><!--end .section-body -->
				</section>
			</div><!--end #content-->
			<!-- END CONTENT -->

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
							<a href="index.php">
								<div class="gui-icon"><i class="md md-home"></i></div>
								<span class="title">Inicio</span>
							</a>
						</li>
                        <!-- END DASHBOARD -->
                        <!-- BEGIN EMAIL -->
						<li class="gui-folder">
							<a>
								<div class="gui-icon"><i class="md md-web"></i></div>
								<span class="title">Empleados</span>
							</a>
							<!--start submenu -->
							<ul>
                            	<li><a href="empleado/ingresar.php"><span class="title">Ingresar Empleado</span></a></li>
                            	<li><a href="empleado/actualizar.php"><span class="title">Modificar Empleado</span></a></li>
                                <li><a href="empleado/eliminar.php"><span class="title">Eliminar Empleado</span></a></li>
							</ul><!--end /submenu -->
						</li><!--end /menu-li -->
                        <!-- END EMAIL -->
                        <!-- BEGIN EMAIL -->
						<li>
							<a href="personal.php">
								<div class="gui-icon"><i class="md md-computer"></i></div>
								<span class="title">Ficha Personal</span>
							</a>
						</li><!--end /menu-li -->
                        <!-- END EMAIL -->
                        <!-- BEGIN EMAIL -->
						<li>
							<a href="liquidacion.php" class="active">
								<div class="gui-icon"><i class="glyphicon glyphicon-file"></i></div>
								<span class="title">Generar Liquidación</span>
							</a>
						</li><!--end /menu-li -->
                        <!-- END EMAIL -->
                        <!-- BEGIN EMAIL -->
                        <li>
							<a href="contrato.php">
								<div class="gui-icon"><i class="glyphicon glyphicon-list-alt"></i></div>
								<span class="title">Contrato y Finiquito</span>
							</a>
						</li><!--end /menu-li -->
                        <!-- END EMAIL -->
                        <!-- BEGIN EMAIL -->
                        <li>
							<a href="licencia.php">
								<div class="gui-icon"><i class="fa fa-folder-open fa-fw"></i></div>
								<span class="title">Licencias Médicas</span>
							</a>
						</li><!--end /menu-li -->
                        <!-- END EMAIL -->
                        <!-- BEGIN EMAIL -->
						<li>
							<a href="asistencia.php">
								<div class="gui-icon"><i class="fa fa-table"></i></div>
								<span class="title">Control de Asistencia</span>
							</a>
						</li><!--end /menu-li -->
                        <!-- END EMAIL -->
                        <!-- BEGIN EMAIL -->
						<li>
							<a href="vacacion.php">
								<div class="gui-icon"><i class="md md-web"></i></div>
								<span class="title">Control de Vacaciones</span>
							</a>
						</li><!--end /menu-li -->
                        <!-- END EMAIL -->
                        <!-- BEGIN EMAIL -->
						<li class="gui-folder">
							<a>
								<div class="gui-icon"><i class="md md-assessment"></i></div>
								<span class="title">Informes</span>
							</a>
							<!--start submenu -->
							<ul>
                            	<li><a href="informe/certificado.php"><span class="title">Certificados</span></a></li>
                            	<li><a href="informe/contrato.php"><span class="title">Contratos y Finiquitos</span></a></li>
                                <li><a href="informe/fvacacion.php"><span class="title">Ficha de Vacaciones</span></a></li>
                                <li><a href="informe/renta.php"><span class="title">Historial Rentas</span></a></li>
                                <li><a href="informe/asistencia.php"><span class="title">Libro de Asistencia</span></a></li>
                                <li><a href="informe/licencia.php"><span class="title">Licencias</span></a></li>
								<li><a href="informe/calculo.php"><span class="title">Modelo de Calculo</span></a></li>
                                <li><a href="informe/pvacacion.php" ><span class="title">Planificacion de Vacaciones</span></a></li>
								<li><a href="informe/imposicion.php"><span class="title">Planillas de Imposición</span></a></li>
							</ul><!--end /submenu -->
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
		<script src="../js/libs/jquery/jquery-1.11.2.min.js"></script>
		<script src="../js/libs/jquery/jquery-migrate-1.2.1.min.js"></script>
		<script src="../js/libs/bootstrap/bootstrap.min.js"></script>
		<script src="../js/libs/spin.js/spin.min.js"></script>
		<script src="../js/libs/autosize/jquery.autosize.min.js"></script>
        <script src="../js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
        <script src="../js/libs/jquery-validation/dist/jquery.validate.min.js"></script>
		<script src="../js/libs/jquery-validation/dist/additional-methods.min.js"></script>
        <script src="../js/libs/bootstrap-datepicker/bootstrap-datepicker.js"></script>
        <script src="../js/libs/dropzone/dropzone.min.js"></script>
		<script src="../js/libs/inputmask/jquery.inputmask.bundle.min.js"></script>
		<script src="../js/core/source/App.js"></script>
		<script src="../js/core/source/AppNavigation.js"></script>
		<script src="../js/core/source/AppOffcanvas.js"></script>
		<script src="../js/core/source/AppCard.js"></script>
		<script src="../js/core/source/AppForm.js"></script>
		<script src="../js/core/source/AppVendor.js"></script>
        <script src="../js/core/demo/Demo.js"></script>
		<script src="../js/core/demo/DemoFormComponents3.js"></script>
        <script src="../js/ocultarpassword.js"></script>
        <script src="../js/jquery.Rut.min.js"></script>
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