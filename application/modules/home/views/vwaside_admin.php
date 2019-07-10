		<?php
            function consulta_uri($txt){
                $url=explode("/",$_SERVER["REQUEST_URI"]); $url=$url[count($url)-1];
                foreach($txt AS $item){
                    if($item===$url) return "active";
                }
            }
            $permisos = $controller->get_data_from_query("SELECT * FROM usuarios_permisos WHERE idUsuario='".$this->session->userdata("id")."'")[0];
        ?>
		<aside class="main-sidebar">
			<section class="sidebar">
		  		<div class="user-panel">
					<div class="pull-left image">
			  			<img src="<?php echo base_url(); ?>img/user.jpg" class="img-circle" alt="User Image">
					</div>
					<div class="pull-left info">
			  			<p><?php echo $this->session->userdata("nombre"); ?></p>
			  			<a href="<?php echo base_url(); ?>"><i class="fa fa-circle text-success"></i> Online</a>
					</div>
		  		</div>
	  			<form action="#" method="get" class="sidebar-form">
					<div class="input-group">
		  				<input type="text" name="q" class="form-control" placeholder="Buscar...">
			  			<span class="input-group-btn">
							<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
			  			</span>
					</div>
	  			</form>
	  			<ul class="sidebar-menu">
					<li class="header">MENÚ PRINCIPAL</li>
					<li class="treeview <?php echo consulta_uri(array('home')); ?>">
		  				<a href="#">
							<i class="fa fa-dashboard"></i> <span>Home</span>
							<span class="pull-right-container">
			  					<i class="fa fa-angle-left pull-right"></i>
							</span>
		  				</a>
		  				<ul class="treeview-menu">
							<li class="<?php echo consulta_uri(array('home')); ?>"><a href="<?php echo base_url(); ?>"><i class="fa fa-circle-o"></i> Dashboard</a></li>
		  				</ul>
					</li>
					<li class="treeview <?php echo consulta_uri(array('graficas')); ?>">
		  				<a href="#">
							<i class="fa fa-pie-chart"></i>
							<span>Gráficos</span>
							<span class="pull-right-container">
			  					<i class="fa fa-angle-left pull-right"></i>
							</span>
		  				</a>
		  				<ul class="treeview-menu">
							<li class="<?php echo consulta_uri(array('graficas')); ?>"><a href="<?php echo base_url(); ?>graficas"><i class="fa fa-circle-o"></i> Gráficas y reportes</a></li>
		  				</ul>
					</li>
					<?php if(TRUE){ ?>
					<li class="treeview <?php echo consulta_uri(array('carga_calificaciones','carga_usuarios','carga_grupos','carga_instructores')); ?>">
		  				<a href="#">
							<i class="fa fa-laptop"></i>
							<span>Carga de archivos</span>
							<span class="pull-right-container">
			  					<i class="fa fa-angle-left pull-right"></i>
							</span>
		  				</a>
		  				<ul class="treeview-menu">
		  					<li class="<?php echo consulta_uri(array('carga_calificaciones')); ?>"><a href="<?php echo base_url(); ?>carga_calificaciones"><i class="fa fa-circle-o"></i> Carga de calificaciones</a></li>
							<li class="<?php echo consulta_uri(array('carga_usuarios')); ?>"><a href="<?php echo base_url(); ?>carga_usuarios"><i class="fa fa-circle-o"></i> Carga de usuarios</a></li>
							<li class="<?php echo consulta_uri(array('carga_grupos')); ?>"><a href="<?php echo base_url(); ?>carga_grupos"><i class="fa fa-circle-o"></i> Carga de grupos</a></li>
							<?php if(intval($permisos["idInstructor"])==0){ ?>
							<li class="<?php echo consulta_uri(array('carga_instructores')); ?>"><a href="<?php echo base_url(); ?>carga_instructores"><i class="fa fa-circle-o"></i> Carga de instructores</a></li>
							<?php } ?>
		  				</ul>
					</li>
					<?php } ?>
					<li class="treeview <?php echo consulta_uri(array('admon_usuarios','admon_grupos')); ?>">
          				<a href="#">
            				<i class="fa fa-table"></i> <span>Administración de datos</span>
            				<span class="pull-right-container">
              					<i class="fa fa-angle-left pull-right"></i>
            				</span>
          				</a>
          				<ul class="treeview-menu">
            				<li class="<?php echo consulta_uri(array('admon_usuarios')); ?>"><a href="<?php echo base_url() ?>admon_usuarios"><i class="fa fa-circle-o"></i> Edición de usuarios</a></li>
            				<li class="<?php echo consulta_uri(array('admon_grupos')); ?>"><a href="<?php echo base_url() ?>admon_grupos"><i class="fa fa-circle-o"></i> Edición de grupos</a></li>
          				</ul>
        			</li>
					<li class="treeview">
		  				<a href="#">
							<i class="fa fa-edit"></i> <span>Cuestionarios</span>
							<span class="pull-right-container">
			  					<i class="fa fa-angle-left pull-right"></i>
							</span>
		  				</a>
		  				<ul class="treeview-menu">
							<li><a target="_blank" href="<?php echo base_url(); ?>test"><i class="fa fa-circle-o"></i> Abrir cuestionarios</a></li>
		  				</ul>
					</li>
					<?php
						$temp = $controller->get_data("edit_preguntas", "usuarios", "id='".$this->session->userdata('id')."'");
						if ($temp !== FALSE && intval($temp[0]["edit_preguntas"]) > 0){
					?>
					<li class="treeview <?php echo consulta_uri(array('settings_questions')); ?>">
		  				<a href="#">
							<i class="fa fa-cog"></i> <span>Configuraciones</span>
							<span class="pull-right-container">
			  					<i class="fa fa-angle-left pull-right"></i>
							</span>
		  				</a>
		  				<ul class="treeview-menu">
							<li class="<?php echo consulta_uri(array('settings_questions')); ?>"><a href="<?php echo base_url(); ?>settings_questions"><i class="fa fa-circle-o"></i> Editar preguntas y respuestas</a></li>
		  				</ul>
					</li>
					<?php } ?>
	  			</ul>
			</section>
  		</aside>
