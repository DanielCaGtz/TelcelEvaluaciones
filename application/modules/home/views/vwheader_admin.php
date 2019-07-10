<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Telcel | Dashboard</title>
		<script type="text/javascript">window.url = {base_url:"<?php echo nombre_ruta_host(); ?>"};</script>
		<link rel="shortcut icon" href="<?php echo base_url(); ?>img/icon.png">
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link rel="stylesheet" href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>plugins/datatables/dataTables.bootstrap.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/AdminLTE.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/skins/_all-skins.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>plugins/iCheck/flat/blue.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>plugins/morris/morris.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>plugins/jvectormap/jquery-jvectormap-1.2.2.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>plugins/datepicker/datepicker3.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>plugins/daterangepicker/daterangepicker.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	</head>
	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">
			<header class="main-header">
				<a href="<?php echo base_url(); ?>" class="logo">
					<span class="logo-mini"><b>T</b>elcel</span>
					<span class="logo-lg"><b>Admin</b>TELCEL</span>
				</a>
				<nav class="navbar navbar-static-top">
					<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<div class="navbar-custom-menu">
						<ul class="nav navbar-nav">
							<li class="dropdown user user-menu">
							  	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			  						<img src="<?php echo base_url(); ?>img/user.jpg" class="user-image" alt="User Image">
			  						<span class="hidden-xs"><?php echo $this->session->userdata("nombre"); ?></span>
								</a>
								<ul class="dropdown-menu">
			  						<li class="user-header">
										<img src="<?php echo base_url(); ?>img/user.jpg" class="img-circle" alt="User Image">
										<p><?php echo $this->session->userdata("nombre"); ?></p>
			  						</li>
			  						<li class="user-footer">
										<div class="pull-right"><a href="<?php echo base_url(); ?>signout" class="btn btn-default btn-flat">Cerrar sesión</a></div>
			  						</li>
								</ul>
		  					</li>
		  					<li>
								<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
		  					</li>
						</ul>
	  				</div>
				</nav>
  			</header>