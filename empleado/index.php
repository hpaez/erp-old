<?php
include('../operaciones.php');
conectar();
apruebadeintrusos();
if($_SESSION['cargo_user']!="Empleado"){
	header('Location: ../index.php');
}
?>
<html lang="en">
	<head>
		<title>PNKS Portal Empleado - Inicio</title>

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
							</a>
							<ul class="dropdown-menu animation-dock">
								<li class="dropdown-header">Opciones de Cuenta</li>
								<li><a href="../opcion/cambiarclave.php">Cambiar Clave</a></li>
								<li><a href="../opcion/cambiarficha.php">Cambiar Datos Personales</a></li>
                                <li><a href="../opcion/cambiarfoto.php">Cambiar Foto de Perfil</a></li>
								<li class="divider"></li>
								<li><a href="../index.php" onClick=""><i class="fa fa-fw fa-power-off text-danger"></i> Salir</a></li>
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
							<!-- BEGIN NEW REGISTRATIONS -->
                            <div class="col-lg-offset col-md-4">
								<div class="card">
                                    <div class="card-head style-primary">
										<header>Datos Personales</header>
									</div>
									<div class="card-body">
                                        <div class="table-responsive">
                                            <ul class="list">
                                                <li class="tile">
                                                    <a class="tile-content ink-reaction">
                                                        <div class="tile-icon">
                                                            <i class="fa fa-graduation-cap"></i>
                                                        </div>
                                                        <div class="tile-text">
                                                            <span class="text-sm">
                                                                <?php echo $_SESSION['cargo_user']; ?>
                                                            </span>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="tile">
                                                    <a class="tile-content ink-reaction">
                                                        <div class="tile-icon">
                                                            <i class="fa fa-gift"></i>
                                                        </div>
                                                        <div class="tile-text">
                                                            <span class="text-sm">
                                                                <?php echo fecha_esp($_SESSION['fecha_nac']); ?>
                                                            </span>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="tile">
                                                    <a class="tile-content ink-reaction">
                                                        <div class="tile-icon">
                                                            <i class="fa fa-envelope-square"></i>
                                                        </div>
                                                        <div class="tile-text">
                                                            <span class="text-sm">
                                                                <?php echo $_SESSION['email_user']; ?>
                                                            </span>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="tile">
                                                    <a class="tile-content ink-reaction">
                                                        <div class="tile-icon">
                                                            <i class="fa fa-phone"></i>
                                                        </div>
                                                        <div class="tile-text">
                                                            <span class="text-sm">
                                                                <?php echo $_SESSION['tel_user']; ?>
                                                            </span>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="tile">
                                                    <a class="tile-content ink-reaction">
                                                        <div class="tile-icon">
                                                            <i class="fa fa-location-arrow"></i>
                                                        </div>
                                                        <div class="tile-text">
                                                            <span class="text-sm">
                                                                <?php echo $_SESSION['dir_user']; ?>
                                                            </span>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div><!--end .table-responsive -->
                                </div><!--end .card-body -->
                            </div><!--end .card -->
                            
                            <!-- END NEW REGISTRATIONS -->
                            <div class="col-md-8">
                            	<div class="card">
                                    <div class="card-head style-primary">
										<header>Vacaciones Tomadas</header>
									</div>
                            		<div class="card-body">
                                  		<!--end .card-head -->
                                        <div class="table-responsive">
                                            <table class="table table-condensed no-margin">
                                                <thead>
                                                    <tr>
                                                        <th>Rut</th>
                                                        <th>Días Tomado</th>
                                                        <th>Motivo</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $query = "select * from solicitud_vacacion where idTrabajador='".$_SESSION['rut_user']."' and estado='Aprobado'";
                                                        $result = mysql_query($query);
                                                        $numero = 1;
                                                        while(($row = mysql_fetch_array($result)) && $numero < 5){
                                                            $diasTomado=abs((strtotime($row["fechaInicio"]) - strtotime($row["fechaFin"]))/86400);
                                                            echo "<tr>";
                                                            echo "<td>".$row["idTrabajador"]."</td>";
                                                            echo "<td>".$diasTomado." dias</td>";
                                                            echo "<td>".$row["motivo"]."</td>";
                                                            echo "</tr>";
                                                            $numero++;
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                              		<!--end .card-body --> 
                              	</div>
                              	<!--end .card --> 
                            </div>
                            <!--end .col -->
						</div>
                        <!--end .row -->
						<div class="row">
                        	<!-- BEGIN NEW REGISTRATIONS -->
							<div class="col-lg-offset col-md-4">
								<div class="card">
                                    <div class="card-head style-primary">
										<header>Asistencia</header>
									</div>
									<div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-condensed no-margin">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Hora Inicio</th>
                                                        <th>Hora Fin</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $query = "select * from asistencia where idTrabajador='".$_SESSION['rut_user']."'";
                                                        $result = mysql_query($query);
                                                        $total = mysql_num_rows($result);
                                                        $numero = 0;
                                                        if($total>=1 ){
                                                            while(($row = mysql_fetch_array($result)) && $numero < 5){
                                                                echo "<tr>";
                                                                echo "<td>".mesLetras($row["fecha"])."</td>";
                                                                echo "<td>".$row["horaEntrada"]."</td>";
                                                                echo "<td>".$row["horaSalida"]."</td>";
                                                                echo "</tr>";
                                                                $numero++;
                                                            }
                                                        }
                                                    ?>
                                            </table>
                                        </div>
                                    </div><!--end .table-responsive -->
                                </div><!--end .card-body -->
                            </div><!--end .card -->
                            
                        	<div class="col-md-8">
								<div class="card">
                                    <div class="card-head style-primary">
										<header>Liquidación</header>
									</div>
									<div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-condensed no-margin">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Descargar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Septiembre</td>
                                                        <td><a href=""><i class="fa fa-file-pdf-o"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Agosto</td>
                                                        <td><a href=""><i class="fa fa-file-pdf-o"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Julio</td>
                                                        <td><a href=""><i class="fa fa-file-pdf-o"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Junio</td>
                                                        <td><a href=""><i class="fa fa-file-pdf-o"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Mayo</td>
                                                        <td><a href=""><i class="fa fa-file-pdf-o"></i></a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
									</div><!--end .card-body -->
								</div><!--end .card -->
							</div><!--end .col -->
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
							<a href="index.php" class="active">
								<div class="gui-icon"><i class="md md-home"></i></div>
								<span class="title">Inicio</span>
							</a>
						</li>
                        <!-- END DASHBOARD -->
                        <!-- BEGIN DASHBOARD -->
                        <li>
							<a href="personal.php">
								<div class="gui-icon"><i class="md md-web"></i></div>
								<span class="title">Información Personal</span>
							</a>
						</li><!--end /menu-li -->
						<!-- END DASHBOARD -->
                        <!-- BEGIN EMAIL -->
                        <li>
							<a href="liquidacion.php">
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
                            	<li><a href="vacacion/solicitud.php"><span class="title">Solicitud de Vacacion</span></a></li>
                            	<li><a href="vacacion/consultar.php"><span class="title">Consultar Vacaciones</span></a></li>
							</ul><!--end /submenu -->
						</li><!--end /menu-li -->
                        <!-- END EMAIL -->
                        <!-- BEGIN EMAIL -->
						<li>
							<a href="certificado.php">
								<div class="gui-icon"><i class="fa fa-cloud-download"></i></div>
								<span class="title">Certificado de Antiguedad</span>
							</a>
						</li><!--end /menu-li -->
                        <!-- END EMAIL -->
                        <!-- BEGIN EMAIL -->
						<li>
							<a href="asistencia.php">
								<div class="gui-icon"><i class="md md-web"></i></div>
								<span class="title">Asistencia</span>
							</a>
						</li><!--end /menu-li -->
                        <!-- END EMAIL -->
                        <!-- BEGIN EMAIL -->
						<li>
							<a href="licencia.php">
								<div class="gui-icon"><i class="fa fa-ambulance"></i></div>
								<span class="title">Licencias Médicas</span>
							</a>
						</li><!--end /menu-li -->
                        <!-- END EMAIL -->
                        <!-- BEGIN EMAIL -->
						<li>
							<a href="anticipo.php">
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
		<script src="../js/libs/jquery/jquery-1.11.2.min.js"></script>
		<script src="../js/libs/jquery/jquery-migrate-1.2.1.min.js"></script>
		<script src="../js/libs/bootstrap/bootstrap.min.js"></script>
		<script src="../js/libs/spin.js/spin.min.js"></script>
		<script src="../js/libs/autosize/jquery.autosize.min.js"></script>
		<script src="../js/libs/DataTables/jquery.dataTables.min.js"></script>
		<script src="../js/libs/DataTables/extensions/ColVis/js/dataTables.colVis.min.js"></script>
		<script src="../js/libs/DataTables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
		<script src="../js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
		<script src="../js/core/source/App.js"></script>
		<script src="../js/core/source/AppNavigation.js"></script>
		<script src="../js/core/source/AppOffcanvas.js"></script>
		<script src="../js/core/source/AppCard.js"></script>
		<script src="../js/core/source/AppForm.js"></script>
		<script src="../js/core/source/AppVendor.js"></script>
		<!-- END JAVASCRIPT -->
	</body>
</html>