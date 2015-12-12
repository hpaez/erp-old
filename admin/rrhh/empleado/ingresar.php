<?php
include('../../../operaciones.php');
conectar();
apruebadeintrusos();

if($_SESSION['cargo_user']!="Administrador"){
	header('Location: ../../login.php');
}

if(isset($_POST['enviar'])){
    $sql_trab="select rut from trabajador where rut='".$_POST['rut']."'";
    $result_trab=mysql_query($sql_trab);
    $cont_trab=mysql_num_rows($result_trab);
    if($cont_trab==0){
        if ((($_FILES["archivo"]["type"] == "image/gif") ||
        ($_FILES["archivo"]["type"] == "image/jpeg") ||
        ($_FILES["archivo"]["type"] == "image/png") ||
        ($_FILES["archivo"]["type"] == "image/jpg")) &&
        ($_FILES["archivo"]["size"] < 1000000)) {
            $rut=$_POST['rut'];
            $afp=$_POST['afp'];
            $contrato=$_POST['contrato'];
            $finiquito=$_POST['finiquito'];
            $caja=$_POST['caja'];
            $isapre=$_POST['isapre'];
            $nombre=$_POST['nombre'];
            $apellidop=$_POST['paterno'];
            $apellidom=$_POST['materno'];
            $password=$_POST['password'];
            $telefono=$_POST['telefono'];
            $direccion=$_POST['direccion'];
            $cargo=$_POST['cargo'];
            $email=$_POST['email'];
            $carga=$_POST['carga'];
            $sexo=$_POST['sexo'];
            $fechanac=$_POST['fechanac'];
            $sueldo=borrarCompleto($_POST['sueldo']);
            $fechaingreso=date('Y')."-".date('m')."-".date('d');
            $estado="1";
            $tmp_name=$_FILES['archivo']['tmp_name'];
            $nombre_file=$_FILES['archivo']['name'];
            $foto=str_replace('-','',str_replace('.','',$rut)).".png";
            move_uploaded_file($_FILES['archivo']['tmp_name'],"../../img/usuarios/".$foto);
            $fechaingreso=date('Y')."-".date('m')."-".date('d');
            $csql="insert into trabajador values ('$rut','$nombre','$apellidop','$apellidom','".fecha_bd($fechanac)."','$fechaingreso','$sexo','$direccion','$email','$telefono','$sueldo','$carga','$cargo','$afp','$isapre','$contrato','$caja','$finiquito','$password','$estado')";
            mysql_query($csql);
            echo"<script>alert('Se ha ingresado un nuevo empleado');</script>";
        } else {
            echo"<script>alert('No se ha podido subir la foto, verifique que sea gif, jpeg, png o jpg y que no pese más de 1MB.');</script>";
        }
    } else {
        echo"<script>alert('El usuario ingresado ya existe.');</script>";
    }
}
?>
<html lang="en">
	<head>
		<title>PNKS Recurso Humano - Ingresar Empleado</title>

		<!-- BEGIN META -->
		<meta http-equiv="content-type" content="text/html; UTF-8" />
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
					<div class="section-body contain-lg">
						<div class="row">
                        	<div class="col-lg-offset col-md-12">
                                <div class="card">
                                    <div class="card-head style-primary">
										<header>Ingresar Trabajador</header>
									</div>
                                    <div class="card-body">
                                        <form class="form form-validate floating-label" action="<?php echo $_SERVER['PHP_SELF']; ?>" accept-charset="utf-8" method="post" enctype="multipart/form-data" novalidate>
                                            <div class="row">
												<div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="rut" name="rut" required data-rule-minlength="11" data-rule-rut="true" maxlength="12">
                                                        <label for="rut">RUT</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="nombre" name="nombre" required maxlength="20" data-rule-lettersonly="true">
                                                        <label for="nombre">Nombre</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
												<div class="col-sm-6">
													<div class="form-group">
                                                        <input type="text" class="form-control" id="paterno" name="paterno" required maxlength="20" data-rule-lettersonly="true">
                                                        <label for="paterno">Apellido Paterno</label>
                                                    </div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
                                                        <input type="text" class="form-control" id="materno" name="materno" required maxlength="20" data-rule-lettersonly="true">
                                                        <label for="materno">Apellido Materno</label>
                                                    </div>
												</div>
											</div>
                                            <div class="form-group">
												<div>
                                                    <label class="radio-inline radio-styled">
														<input type="radio" name="sexo" value="Masculino" checked><span>Masculino</span>
													</label>
													<label class="radio-inline radio-styled">
														<input type="radio" name="sexo" value="Femenino"><span>Femenino</span>
													</label>
                                                </div>
                                            </div>
                                            <div class="row">
												<div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="email" class="form-control" id="email" name="email" required maxlength="40">
                                                        <label for="email">Correo Eletrónico</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="telefono" name="telefono" required data-rule-minlength="14" maxlength="20" data-inputmask="'mask': '+569 9999 9999'">
                                                        <label for="telefono">Teléfono</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
												<div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="direccion" name="direccion" required maxlength="40">
                                                        <label for="direccion">Dirección</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control peso-mask" id="sueldo" name="sueldo" required maxlength="10">
                                                        <label for="sueldo">Sueldo</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
												<div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="password" class="form-control" id="password" name="password" required data-rule-minlength="5">
                                                        <label for="password">Contraseña</label>
                                                        <span id="show-hide-password" action="hide" class="form-control-feedback glyphicon glyphicon-eye-open"></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="password" class="form-control" id="repass" name="repass" required data-rule-minlength="5" data-rule-equalTo="#password">
                                                        <label for="repass">Rescribir Contraseña</label>
                                                        <span id="show-hide-repass" action="hide" class="form-control-feedback glyphicon glyphicon-eye-open"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="carga" name="carga" required maxlength="2" data-rule-number="true">
                                                        <label for="carga">Carga Familiar</label>
                                                    </div>
                                                </div>
												<div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="input-group date" id="demo-date">
                                                            <div class="input-group-content">
                                                                <input type="text" class="form-control" name="fechanac" id="fechanac" required data-rule-minlength="10">
                                                                <label>Fecha de Nacimiento</label>
                                                            </div>
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <select id="cargo" name="cargo" class="form-control" required>
                                                            <option value="">&nbsp;</option>
                                                            <?php
                                                                $ca=mysql_query("select nombre from cargo");
                                                                while (list($cargo)=mysql_fetch_array($ca)){
                                                            ?>
                                                            <option value='<?php echo $cargo ?>'><?php echo $cargo ?></option>
                                                            <?php
                                                                }
                                                            ?>
                                                        </select>
                                                        <label for="cargo">Cargo</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <select id="contrato" name="contrato" class="form-control" required>
                                                            <option value="">&nbsp;</option>
                                                            <?php
                                                                $co=mysql_query("select tipoContrato from contrato");
                                                                while (list($contrato)=mysql_fetch_array($co)){
                                                            ?>
                                                            <option value='<?php echo $contrato ?>'><?php echo $contrato ?></option>
                                                            <?php
                                                                }
                                                            ?>
                                                        </select>
                                                        <label for="contrato">Número Contrato</label>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <select id="finiquito" name="finiquito" class="form-control" required>
                                                            <option value="">&nbsp;</option>
                                                            <?php
                                                                $fi=mysql_query("select tipoFiniquito from finiquito");
                                                                while (list($finiquito)=mysql_fetch_array($fi)){
                                                            ?>
                                                            <option value='<?php echo $finiquito ?>'><?php echo $finiquito ?></option>
                                                            <?php
                                                                }
                                                            ?>
                                                        </select>
                                                        <label for="finiquito">Finiquito</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <select id="isapre" name="isapre" class="form-control" required>
                                                            <option value="">&nbsp;</option>
                                                            <?php
                                                                $is=mysql_query("select nombre from isapre");
                                                                while (list($isapre)=mysql_fetch_array($is)){
                                                            ?>
                                                            <option value='<?php echo $isapre ?>'><?php echo $isapre ?></option>
                                                            <?php
                                                                }
                                                            ?>
                                                        </select>
                                                        <label for="isapre">ISAPRE</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <select id="afp" name="afp" class="form-control" required>
                                                            <option value="">&nbsp;</option>
                                                            <?php
                                                                $af=mysql_query("select nombre from afp");
                                                                while (list($afp)=mysql_fetch_array($af)){
                                                            ?>
                                                            <option value='<?php echo $afp ?>'><?php echo $afp ?></option>
                                                            <?php
                                                                }
                                                            ?>
                                                        </select>
                                                        <label for="afp">AFP</label>
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
                                                            <option value='<?php echo $caja ?>'><?php echo $caja ?></option>
                                                            <?php
                                                                }
                                                            ?>
                                                        </select>
                                                        <label for="caja">Caja Compensación</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="file" class="form-control" id="archivo" name="archivo" required>
                                            </div>
                                        </div><!--end .card-body -->
                                        <div class="card-actionbar">
                                            <div class="card-actionbar-row">
                                                <button type="submit" class="btn btn-flat btn-primary ink-reaction" id="enviar" name="enviar">Ingresar Empleado</button>
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
							<a href="../index.php">
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
                            	<li><a href="ingresar.php" class="active"><span class="title">Ingresar Empleado</span></a></li>
                            	<li><a href="actualizar.php"><span class="title">Modificar Empleado</span></a></li>
                                <li><a href="eliminar.php"><span class="title">Eliminar Empleado</span></a></li>
							</ul><!--end /submenu -->
						</li><!--end /menu-li -->
                        <!-- END EMAIL -->
                        <!-- BEGIN EMAIL -->
						<li>
							<a href="../personal.php">
								<div class="gui-icon"><i class="md md-computer"></i></div>
								<span class="title">Ficha Personal</span>
							</a>
						</li><!--end /menu-li -->
                        <!-- END EMAIL -->
                        <!-- BEGIN EMAIL -->
						<li>
							<a href="../liquidacion.php">
								<div class="gui-icon"><i class="glyphicon glyphicon-file"></i></div>
								<span class="title">Generar Liquidación</span>
							</a>
						</li><!--end /menu-li -->
                        <!-- END EMAIL -->
                        <!-- BEGIN EMAIL -->
                        <li>
							<a href="../contrato.php">
								<div class="gui-icon"><i class="glyphicon glyphicon-list-alt"></i></div>
								<span class="title">Contrato y Finiquito</span>
							</a>
						</li><!--end /menu-li -->
                        <!-- END EMAIL -->
                        <!-- BEGIN EMAIL -->
                        <li>
							<a href="../licencia.php">
								<div class="gui-icon"><i class="fa fa-folder-open fa-fw"></i></div>
								<span class="title">Licencias Médicas</span>
							</a>
						</li><!--end /menu-li -->
                        <!-- END EMAIL -->
                        <!-- BEGIN EMAIL -->
						<li>
							<a href="../asistencia.php">
								<div class="gui-icon"><i class="fa fa-table"></i></div>
								<span class="title">Control de Asistencia</span>
							</a>
						</li><!--end /menu-li -->
                        <!-- END EMAIL -->
                        <!-- BEGIN EMAIL -->
						<li>
							<a href="../vacacion.php">
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
                            	<li><a href="../informe/certificado.php"><span class="title">Certificados</span></a></li>
                            	<li><a href="../informe/contrato.php"><span class="title">Contratos y Finiquitos</span></a></li>
                                <li><a href="../informe/fvacacion.php"><span class="title">Ficha de Vacaciones</span></a></li>
                                <li><a href="../informe/renta.php"><span class="title">Historial Rentas</span></a></li>
                                <li><a href="../informe/asistencia.php"><span class="title">Libro de Asistencia</span></a></li>
                                <li><a href="../informe/licencia.php"><span class="title">Licencias</span></a></li>
								<li><a href="../informe/calculo.php"><span class="title">Modelo de Calculo</span></a></li>
                                <li><a href="../informe/pvacacion.php" ><span class="title">Planificacion de Vacaciones</span></a></li>
								<li><a href="../informe/imposicion.php"><span class="title">Planillas de Imposición</span></a></li>
							</ul><!--end /submenu -->
						</li><!--end /menu-li -->
                        <!-- END EMAIL -->
					</ul><!--end .main-menu -->
					<!-- END MAIN MENU -->

					<div class="menubar-foot-panel">
						<small class="no-linebreak hidden-folded">
							<span class="opacity-75">&copy; 2015</span> <strong>GH Soluciones Informáticas</strong>
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
		<script src="../../../js/libs/bootstrap/bootstrap.min.js"></script>
		<script src="../../../js/libs/spin.js/spin.min.js"></script>
		<script src="../../../js/libs/autosize/jquery.autosize.min.js"></script>
        <script src="../../../js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
        <script src="../../../js/libs/jquery-validation/dist/jquery.validate.min.js"></script>
		<script src="../../../js/libs/jquery-validation/dist/additional-methods.min.js"></script>
        <script src="../../../js/libs/bootstrap-datepicker/bootstrap-datepicker.js"></script>
        <script src="../../../js/libs/dropzone/dropzone.min.js"></script>
		<script src="../../../js/libs/inputmask/jquery.inputmask.bundle.min.js"></script>
		<script src="../../../js/core/source/App.js"></script>
		<script src="../../../js/core/source/AppNavigation.js"></script>
		<script src="../../../js/core/source/AppOffcanvas.js"></script>
		<script src="../../../js/core/source/AppCard.js"></script>
		<script src="../../../js/core/source/AppForm.js"></script>
		<script src="../../../js/core/source/AppVendor.js"></script>
        <script src="../../../js/core/demo/Demo.js"></script>
		<script src="../../../js/core/demo/DemoFormComponents3.js"></script>
        <script src="../../../js/ocultarpassword.js"></script>
        <script src="../../../js/jquery.Rut.min.js"></script>
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