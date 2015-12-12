<?php
include('../../operaciones.php');
conectar();
apruebadeintrusos();

if(isset($_POST['enviar'])){
	$sql_trab="select password from trabajador where rut='".$_SESSION['rut_user']."'";
	$query_trab=mysql_query($sql_trab);
	while($datos_trab=mysql_fetch_array($query_trab)){
		if($datos_trab['password']==$_POST['passprev']){
			$csql="update trabajador set password='".$_POST['passnew']."' where rut='".$_SESSION['rut_user']."'";
			mysql_query($csql);
			echo"<script>
						alert('Su password ha sido modificada');
						window.location.href='../../login.php';
					</script>";
		} else {
			echo"<script>alert('La contraseña anterior es incorrecta.');</script>";
		}
	}
}
?>
<html lang="en">
	<head>
		<title>PNKS - Cambiar Datos Personales</title>

		<!-- BEGIN META -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="keywords" content="your,keywords">
		<meta name="description" content="Short explanation about this website">
		<!-- END META -->

		<!-- BEGIN STYLESHEETS -->
		<link href='http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900' rel='stylesheet' type='text/css'/>
		<link type="text/css" rel="stylesheet" href="../../css/bootstrap.css" />
		<link type="text/css" rel="stylesheet" href="../../css/materialadmin.css" />
		<link type="text/css" rel="stylesheet" href="../../css/font-awesome.min.css" />
		<link type="text/css" rel="stylesheet" href="../../css/material-design-iconic-font.min.css" />
		<link type="text/css" rel="stylesheet" href="../../css/libs/DataTables/jquery.dataTables.css" />
		<link type="text/css" rel="stylesheet" href="../../css/libs/DataTables/extensions/dataTables.colVis.css" />
		<link type="text/css" rel="stylesheet" href="../../css/libs/DataTables/extensions/dataTables.tableTools.css" />
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
                                    if(file_exists('../../img/usuarios/'.$_SESSION['foto_user'])){
                                ?>
                                    <img src="../../img/usuarios/<?php echo $_SESSION['foto_user']; ?>" alt="" />
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
								<li><a href="cambiarclave.php">Cambiar Clave</a></li>
								<li><a href="cambiarficha.php">Cambiar Datos Personales</a></li>
                                <li><a href="cambiarfoto.php">Cambiar Foto de Perfil</a></li>
								<li class="divider"></li>
								<li><a href="../../login.php" onClick=""><i class="fa fa-fw fa-power-off text-danger"></i> Salir</a></li>
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
                        	<div class="col-lg-offset-1 col-md-8">
                                <div class="card-head style-primary">
								    <header>Cambiar Clave</header>
								</div>
								<form class="form form-validate floating-label" action="<?php echo $_SERVER['PHP_SELF']; ?>" accept-charset="utf-8" method="post" novalidate>
									<div class="card">
										<div class="card-body">
											<div class="form-group">
                                                <input type="password" class="form-control" id="passprev" name="passprev" required data-rule-minlength="5" maxlength="20">
                                                <label for="passprev">Contraseña Anterior</label>
                                                <span id="show-hide-passprev" action="hide" class="form-control-feedback glyphicon glyphicon-eye-open"></span>
											</div>
											<div class="form-group">
                                                <input type="password" class="form-control" id="passnew" name="passnew" required data-rule-minlength="5" maxlength="20">
                                                <label for="passnew">Contraseña Nueva</label>
                                                <span id="show-hide-passnew" action="hide" class="form-control-feedback glyphicon glyphicon-eye-open"></span>
											</div>
											<div class="form-group">
                                                <input type="password" class="form-control" id="repassnew" name="repassnew" required data-rule-minlength="5" maxlength="20" data-rule-equalTo="#passnew">
                                                <label for="repassnew">Rescribir Contraseña</label>
                                                <span id="show-hide-repassnew" action="hide" class="form-control-feedback glyphicon glyphicon-eye-open"></span>
											</div>
										</div><!--end .card-body -->
										<div class="card-actionbar">
											<div class="card-actionbar-row">
												<button type="submit" class="btn btn-flat btn-primary ink-reaction" name="enviar" id="enviar">Cambiar Clave</button>
											</div>
										</div><!--end .card-actionbar -->
									</div><!--end .card -->
								</form>
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
                        	<?php
								if($_SESSION['cargo_user']=="Administrador"){
									echo"<a href='../rrhh/index.php'>";
								}else if($_SESSION['cargo_user']=="Empleado"){
									echo"<a href='../empleado/index.php'>";
								} else {
								    echo"<a href='../bodega/index.php'>";
								}
							?>
								<div class="gui-icon"><i class="md md-home"></i></div>
								<span class="title">Inicio</span>
							</a>
						</li>
                        <!-- END DASHBOARD -->
                        <!-- BEGIN EMAIL -->
						<li>
							<a href="cambiarclave.php" class="active">
								<div class="gui-icon"><i class="md md-content-paste"></i></div>
								<span class="title">Cambiar Clave</span>
							</a>
						</li><!--end /menu-li -->
                        <!-- END EMAIL -->
                        <!-- BEGIN EMAIL -->
						<li>
							<a href="cambiarficha.php">
								<div class="gui-icon"><i class="md md-border-color"></i></div>
								<span class="title">Cambiar Datos Personales</span>
							</a>
						</li><!--end /menu-li -->
                        <!-- END EMAIL -->
                        <!-- BEGIN EMAIL -->
						<li>
							<a href="cambiarfoto.php">
								<div class="gui-icon"><i class="md md-perm-identity"></i></div>
								<span class="title">Cambiar Foto de Perfil</span>
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
		<script src="../../js/libs/jquery/jquery-1.11.2.min.js"></script>
		<script src="../../js/libs/jquery/jquery-migrate-1.2.1.min.js"></script>
		<script src="../../js/libs/bootstrap/bootstrap.min.js"></script>
		<script src="../../js/libs/spin.js/spin.min.js"></script>
		<script src="../../js/libs/autosize/jquery.autosize.min.js"></script>
        <script src="../../js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
        <script src="../../js/libs/jquery-validation/dist/jquery.validate.min.js"></script>
		<script src="../../js/libs/jquery-validation/dist/additional-methods.min.js"></script>
		<script src="../../js/core/source/App.js"></script>
		<script src="../../js/core/source/AppNavigation.js"></script>
		<script src="../../js/core/source/AppOffcanvas.js"></script>
		<script src="../../js/core/source/AppCard.js"></script>
		<script src="../../js/core/source/AppForm.js"></script>
		<script src="../../js/core/source/AppVendor.js"></script>
        <script src="../../js/ocultarpassword.js"></script>
		<!-- END JAVASCRIPT -->
	</body>
</html>