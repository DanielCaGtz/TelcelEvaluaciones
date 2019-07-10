<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
		Administración de grupos
		<small>edición</small>
	  </h1>
	  <ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="#">Administración</a></li>
		<li class="active">Grupos</li>
	  </ol>
	</section>

	<!-- Main content -->
	<section class="content">
	  <div class="row">
		<div class="col-xs-12">
		  <div class="box">
			<div class="box-header">
			  <h3 class="box-title">Lista completa de grupos (códigos únicos)</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <table id="example1" class="table table-bordered table-striped">
				<thead>
				<tr>
				  	<th>Nombre</th>
				  	<th>Instructor</th>
				  	<th>Fecha de inicio</th>
				  	<th>Fecha de fin</th>
				  	<th>Seleccionar</th>
				</tr>
				</thead>
				<tbody>
					<?php
					$permisos=$controller->get_data_from_query("SELECT * FROM usuarios_permisos WHERE idUsuario='".$this->session->userdata("id")."'")[0];
					
					$q="";
					if(intval($permisos["idInstructor"])>0) $q=" WHERE id='".$permisos["idInstructor"]."' ";
					elseif(intval($permisos["idDespacho"])>0) $q=" WHERE id IN (SELECT id FROM instructores WHERE idDespacho='".$permisos["idDespacho"]."') ";
					$instructores=$controller->get_data_from_query("SELECT id,nombre,idDespacho, (SELECT nombre FROM cursos WHERE id=(SELECT idCurso FROM despachos WHERE id=idDespacho)) AS curso, (SELECT nombre FROM despachos WHERE id=idDespacho) AS despacho FROM instructores $q ORDER BY nombre");

					$q="";
		  			if(intval($permisos["idInstructor"])>0) $q=" WHERE idInstructor='".$permisos["idInstructor"]."' ";
					elseif(intval($permisos["idDespacho"])>0) $q=" WHERE idInstructor IN (SELECT id FROM instructores WHERE idDespacho='".$permisos["idDespacho"]."') ";
					$grupos=$controller->get_data_from_query("SELECT grupo.* FROM grupos AS grupo $q ORDER BY grupo.nombre");

					$q="";
					if(intval($permisos["idInstructor"])>0) $q="AND ppal.id IN (SELECT id FROM grupos WHERE idInstructor='".$permisos["idInstructor"]."')";
					elseif(intval($permisos["idDespacho"])>0) $q="AND ppal.idInstructor IN (SELECT id FROM instructores WHERE idDespacho='".$permisos["idDespacho"]."')";
					$query_new="SELECT ppal.*, (SELECT nombre FROM instructores WHERE id=ppal.idInstructor) AS nombreInstructor FROM grupos AS ppal WHERE ppal.idInstructor>0 $q ORDER BY nombre ; ";
					$data=$controller->get_data_from_query($query_new); if($data!==FALSE){ foreach($data AS $e=>$key){ ?>
					<tr data-activo="1" data-id="<?php echo $key['id']; ?>">
						<td class="nombre editable"><p data-original="<?php echo $key["nombre"]; ?>" contenteditable="true"><?php echo $key["nombre"]; ?></p></td>
						<td class="instructor editable"><p data-id="<?php echo $key['idInstructor']; ?>" data-idoriginal="<?php echo $key['idInstructor']; ?>" data-original="<?php echo $key["nombreInstructor"]; ?>"><?php echo $key["nombreInstructor"]; ?></p></td>
						<td class="fecha_from editable"><p data-original="<?php echo $key["date_from"]; ?>" contenteditable="true"><?php echo $key["date_from"]; ?></p></td>
						<td class="fecha_to editable"><p data-original="<?php echo $key["date_to"]; ?>" contenteditable="true"><?php echo $key["date_to"]; ?></p></td>
						<td class="select_user"><input type="checkbox" class="select_user_checkbox"></td>
					</tr>
					<?php }} ?>
				</tbody>
				<tfoot>
				<tr>
				  	<th>Nombre</th>
				  	<th>Instructor</th>
				  	<th>Fecha de inicio</th>
				  	<th>Fecha de fin</th>
				  	<th>Seleccionar</th>
				</tr>
				</tfoot>
			  </table>
			</div>
			<!-- /.box-body -->
		  </div>
		  <!-- /.box -->
		</div>
		<!-- /.col -->
	  </div>
	  	<div class="row">
	  		<div class="col-md-6">
		  		<div class="box box-info">
	            	<div class="box-header with-border">
	              		<h3 class="box-title">Cambiar múltiples</h3>
	            	</div>
	            	<div class="box-body">
	              		<form role="form">
	              			<div class="form-group">
	              				<a href="javascript:;" class="seleccionar" id="select_all">Seleccionar todos</a>
	              			</div>
			  				<div class="form-group">
								<label>Instructores</label>
							  	<select id="instructores_gral" class="form-control">
							  		<option value="0">Seleccione una opción</option>
									<?php foreach($instructores AS $i=>$item){ ?>
									<option value="<?php echo $item['id']; ?>" data-nombre="<?php echo $item['nombre']; ?>"><?php echo $item['nombre']." (".$item["despacho"]." - ".$item["curso"].")"; ?></option>
									<?php } ?>
								</select>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="box box-info">
					<div class="box-body">
	              		<form role="form">
			  				<div class="form-group">
								<button id="save_cambios" type="button" class="btn btn-block btn-success btn-lg">Guardar <i class="fa fa-save"></i></button>
							</div>
							<div class="form-group">
								<button id="cancelar_cambios" type="button" class="btn btn-block btn-warning btn-lg">Cancelar cambios <i class="fa fa-remove"></i></button>
							</div>
							<div class="form-group">
								<button id="eliminar_usuario" type="button" class="btn btn-block btn-danger btn-lg">Eliminar <i class="fa fa-trash-o"></i></button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="alert alert-danger alert-dismissible" id="mensaje_error_edicion">
        			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        			<h4><i class="icon fa fa-ban"></i> Hubo un problema</h4>
        			Los grupos seleccionados no pueden alterarse. Por favor contacte al administrador del sistema.
      			</div>
      			<div class="alert alert-success alert-dismissible" id="mensaje_success_edicion">
        			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        			<h4><i class="icon fa fa-check"></i> Éxito</h4>
        			Los cambios en los grupos se han realizado correctamente.
      			</div>
			</div>
	  	</div>
	</section>
	<!-- /.content -->
  </div>