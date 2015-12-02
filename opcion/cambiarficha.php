<?php
include('../operaciones.php');
conectar();
apruebadeintrusos();

if($_SESSION['cargo_user']=="Administrador" || $_SESSION['cargo_user']=="Empleado" || $_SESSION['cargo_user']=="Bodeguero"){
	$sql="select * from trabajador where rut='".$_SESSION['rut_user']."'";
	$resul=mysql_query($sql);
	$datos_trab=mysql_fetch_array($resul);
} else {
	echo"<script>window.location.href='../index.php';</script>";
}

if(isset($_POST['enviar'])){
	$csql="update trabajador set email='".$_POST['email']."',telefono='".$_POST['telefono']."',direccion='".$_POST['direccion']."',cargaFamiliar='".$_POST['carga']."',isapre='".$_POST['isapre']."',afp='".$_POST['afp']."',caja='".$_POST['caja']."' where rut ='".$_SESSION['rut_user']."'";
	mysql_query($csql);
	echo "<script>alert('Sus datos personales han sido actualizados');</script>";
	echo"<script>window.location.href='cambiarficha.php';</script>";
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
		<link type="text/css" rel="stylesheet" href="../css/bootstrap.css" />
		<link type="text/css" rel="stylesheet" href="../css/materialadmin.css" />
		<link type="text/css" rel="stylesheet" href="../css/font-awesome.min.css" />
		<link type="text/css" rel="stylesheet" href="../css/material-design-iconic-font.min.css" />
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
								<img src="../img/usuarios/<?php echo $_SESSION['foto_user']; ?>" alt="" />
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
					<div class="section-body contain-lg">
						<div class="row">
                        	<div class="col-lg-offset-1 col-md-8">
                                <div class="card">
                                    <div class="card-head style-primary">
										<header>Cambiar Datos Personales</header>
									</div>
                                    <form class="form form-validate floating-label" action="<?php echo $_SERVER['PHP_SELF']; ?>" accept-charset="utf-8" method="post" enctype="multipart/form-data" novalidate>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $datos_trab['nombre'];?>" required readonly>
                                                <label for="nombre">Nombre</label>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="paterno" name="paterno" value="<?php echo $datos_trab['apellidoPaterno'];?>" required readonly>
                                                        <label for="paterno">Apellido Paterno</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="materno" name="materno" value="<?php echo $datos_trab['apellidoMaterno'];?>" required readonly>
                                                        <label for="materno">Apellido Materno</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="email" class="form-control" id="email" name="email" required maxlength="30" value="<?php echo $datos_trab['email'];?>">
                                                <label for="email">Correo Electrónico</label>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="telefono" name="telefono"  maxlength="14" data-rule-minlength="14" data-inputmask="'mask': '+569 9999 9999'" value="<?php echo $datos_trab['telefono'];?>" required>
                                                        <label for="teleno">Teléfono</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="carga" name="carga"  maxlength="2" data-rule-minlength="1" data-rule-number="true" value="<?php echo $datos_trab['cargaFamiliar'];?>" required>
                                                        <label for="carga">Carga Familiar</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="direccion" name="direccion" maxlength="40" value="<?php echo $datos_trab['direccion'];?>" required>
                                                        <label for="direccion">Dirección</label>
                                                    </div>
                                            	</div>
                                                <div class="col-sm-6">
                                                	<div class="form-group">
                                                        <select id="caja" name="caja" class="form-control" required>
                                                            <option value="">&nbsp;</option>
                                                            <?php
                                                                $ca=mysql_query("select nombre from caja");
                                                                while (list($caja)=mysql_fetch_array($ca)){
                                                            ?>
                                                            <option <?php if($datos_trab['caja']==$caja){?> selected="selected" <?php } ?> value='<?php echo $caja ?>'><?php echo $caja ?></option>
                                                            <?php
                                                                }
                                                            ?>
                                                        </select>
                                                        <label for="caja">Caja</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <select id="isapre" name="isapre" class="form-control" required>
                                                            <option value="">&nbsp;</option>
                                                            <?php
                                                                $is=mysql_query("select nombre from isapre");
                                                                while (list($isapre)=mysql_fetch_array($is)){
                                                            ?>
                                                            <option <?php if($datos_trab['isapre']==$isapre){?> selected="selected" <?php } ?> value='<?php echo $isapre ?>'><?php echo $isapre ?></option>
                                                            <?php
                                                                }
                                                            ?>
                                                        </select>
                                                        <label for="isapre">ISAPRE</label>
                                                    </div>
                                            	</div>
                                                <div class="col-sm-6">
                                                	<div class="form-group">
                                                        <select id="afp" name="afp" class="form-control" required>
                                                            <option value="">&nbsp;</option>
                                                            <?php
                                                                $af=mysql_query("select nombre from afp");
                                                                while (list($afp)=mysql_fetch_array($af)){
                                                            ?>
                                                            <option <?php if($datos_trab['afp']==$afp){?> selected="selected" <?php } ?> value='<?php echo $afp ?>'><?php echo $afp ?></option>
                                                            <?php
                                                                }
                                                            ?>
                                                        </select>
                                                        <label for="isapre">AFP</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--end .card-body -->
                                        <div class="card-actionbar">
                                            <div class="card-actionbar-row">
                                                <button type="submit" class="btn btn-flat btn-primary ink-reaction" name="enviar" id="enviar">Cambiar Datos Personales</button>
                                            </div>
                                        </div><!--end .card-actionbar -->
                                    </form>
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
							<a href="cambiarclave.php">
								<div class="gui-icon"><i class="md md-content-paste"></i></div>
								<span class="title">Cambiar Clave</span>
							</a>
						</li><!--end /menu-li -->
                        <!-- END EMAIL -->
                        <!-- BEGIN EMAIL -->
						<li>
							<a href="cambiarficha.php" class="active">
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
		<script src="../js/libs/jquery/jquery-1.11.2.min.js"></script>
		<script src="../js/libs/jquery/jquery-migrate-1.2.1.min.js"></script>
		<script src="../js/libs/bootstrap/bootstrap.min.js"></script>
		<script src="../js/libs/spin.js/spin.min.js"></script>
		<script src="../js/libs/autosize/jquery.autosize.min.js"></script>
        <script src="../js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
        <script src="../js/libs/jquery-validation/dist/jquery.validate.min.js"></script>
		<script src="../js/libs/jquery-validation/dist/additional-methods.min.js"></script>
		<script src="../js/libs/inputmask/jquery.inputmask.bundle.min.js"></script>
		<script src="../js/core/source/App.js"></script>
		<script src="../js/core/source/AppNavigation.js"></script>
		<script src="../js/core/source/AppOffcanvas.js"></script>
		<script src="../js/core/source/AppCard.js"></script>
		<script src="../js/core/source/AppForm.js"></script>
		<script src="../js/core/source/AppVendor.js"></script>
        <script src="../js/core/demo/Demo.js"></script>
		<script src="../js/core/demo/DemoFormComponents.js"></script>
		<!-- END JAVASCRIPT -->
	</body>
</html>