<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
		Administración de usuarios
		<small>edición</small>
	  </h1>
	  <ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="#">Administración</a></li>
		<li class="active">Usuarios</li>
	  </ol>
	</section>

	<!-- Main content -->
	<section class="content">
	  <div class="row">
		<div class="col-xs-12">
		  <div class="box">
			<div class="box-header">
			  <h3 class="box-title">Lista completa de usuarios</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <table id="example1" class="table table-bordered table-striped">
				<thead>
				<tr>
				  	<th>Nombre</th>
				  	<th>No. de empleado</th>
				  	<th>Instructor</th>
				  	<th>Grupo</th>
				  	<th>Curso</th>
				  	<th>Fecha de inserción</th>
				  	<th>Estatus</th>
				  	<th>Activo</th>
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
		  			if(intval($permisos["idInstructor"])>0) $q=" WHERE id=(SELECT idCurso FROM despachos WHERE id=(SELECT idDespacho FROM instructores WHERE id='".$permisos["idInstructor"]."')) ";
					elseif(intval($permisos["idDespacho"])>0) $q=" WHERE id = (SELECT idCurso FROM despachos WHERE id='".$permisos["idDespacho"]."') ";
					$quest=$controller->get_data_from_query("SELECT * FROM cuestionarios $q ORDER BY nombre");

					$q="";
					if(intval($permisos["idInstructor"])>0) $q="AND ppal.idGrupo IN (SELECT id FROM grupos WHERE idInstructor='".$permisos["idInstructor"]."')";
					elseif(intval($permisos["idDespacho"])>0) $q="AND ppal.idInstructor IN (SELECT id FROM instructores WHERE idDespacho='".$permisos["idDespacho"]."')";
					$query_new="SELECT ppal.*, DATE(ppal.date_start) AS date_user, (SELECT nombre FROM grupos WHERE id=ppal.idGrupo) AS nombreGrupo FROM usuarios AS ppal WHERE ppal.id NOT IN (SELECT idUsuario FROM usuarios_permisos) $q ORDER BY ppal.date_start DESC LIMIT 1500";
					#echo $query_new;
					$data=$controller->get_data_from_query($query_new); if($data!==FALSE){ foreach($data AS $e=>$key){

					$data_child=$controller->get_data_from_query("SELECT ins.id, ins.nombre, d.nombre AS despacho, d.idCurso, (SELECT nombre FROM cuestionarios WHERE id=d.idCurso) AS nombreQuest, (SELECT clave FROM cuestionarios WHERE id=d.idCurso) AS clave from instructores AS ins INNER JOIN despachos AS d ON ins.idDespacho=d.id WHERE ins.id=".$key["idInstructor"].";")[0]; ?>
					<tr data-activo="1" data-id="<?php echo $key['id']; ?>">
						<td class="nombre editable"><p data-original="<?php echo $key["nombre"]; ?>" contenteditable="true"><?php echo $key["nombre"]; ?></p></td>
						<td class="numero editable"><p data-original="<?php echo $key["numero"]; ?>" contenteditable="true"><?php echo $key["numero"]; ?></p></td>
						<td class="instructor editable"><p data-id="<?php echo $data_child['id']; ?>" data-idoriginal="<?php echo $data_child['id']; ?>" data-original="<?php echo $data_child["nombre"]; ?>"><?php echo $data_child["nombre"]; ?></p></td>
						<td class="grupo editable"><p data-id="<?php echo $key['idGrupo']; ?>" data-idoriginal="<?php echo $key['idGrupo']; ?>" data-original="<?php echo $key["nombreGrupo"]; ?>"><?php echo $key["nombreGrupo"]; ?></p></td>
						<td class="curso editable"><p data-id="<?php echo $data_child['clave']; ?>" data-idoriginal="<?php echo $data_child['clave']; ?>" data-original="<?php echo $data_child["nombreQuest"]; ?>"><?php echo $data_child["nombreQuest"]; ?></p></td>
						<td class="fecha editable"><p data-original="<?php echo $key["date_user"]; ?>" contenteditable="true"><?php echo $key["date_user"]; ?></p></td>
						<td>
							<select class="change_status">
								<option value=""></option>
								<?php
									if (strlen($key["estatus"]) > 0) $s = $key["estatus"];
									else $s = "";
									$pagos=array("AS"=>"ASISTIÓ","NA"=>"NO ASISTIÓ","AP"=>"ASISTENCIA PARCIAL","APR"=>"APROBADO","RPR"=>"REPROBADO","EP"=>"EN PAPEL");
									foreach($pagos AS $p=>$pago){
								?>
								<option <?php echo $p==$s ? "selected":""; ?> value="<?php echo $p; ?>"><?php echo $p; ?></option>
								<?php } ?>
							</select>
						</td>
						<td class="active editable" data-original="<?php echo strlen($key["date_end"])>0 ? 0 : 1; ?>">
							<?php if(strlen($key["date_end"])===0){ ?>
							<span class="label active_user label-success">Activo</span>
							<?php }else{ ?>
							<span class="label active_user label-danger">Inactivo</span>
							<?php } ?>
						</td>
						<td class="select_user"><input type="checkbox" class="select_user_checkbox"></td>
					</tr>
					<?php }} ?>
				</tbody>
				<tfoot>
				<tr>
				  	<th>Nombre</th>
				  	<th>No. de empleado</th>
				  	<th>Instructor</th>
				  	<th>Grupo</th>
				  	<th>Curso</th>
				  	<th>Fecha de inserción</th>
				  	<th>Estatus</th>
				  	<th>Activo</th>
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
							<div class="form-group">
								<label>Grupos</label>
								<select id="grupos_gral" class="form-control">
									<option value="0">Seleccione una opción</option>
									<?php foreach($grupos AS $i=>$item){ ?>
									<option data-idInstructor="<?php echo $item['idInstructor']; ?>" value="<?php echo $item['id']; ?>"><?php echo $item['nombre']; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group">
								<label>Cursos</label>
								<select id="cursos_gral" class="form-control">
									<option value="0">Seleccione una opción</option>
									<?php foreach($quest AS $i=>$item){ ?>
									<option value="<?php echo $item['id']; ?>" data-clave="<?php echo $item["clave"]; ?>"><?php echo $item['nombre']; ?></option>
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
							<div class="form-group"><br></div>
							<div class="form-group">
								<button id="activar_usuarios" type="button" class="btn btn-block btn-success btn-lg">Activar <i class="fa fa-check"></i></button>
							</div>
							<div class="form-group">
								<button id="desactivar_usuarios" type="button" class="btn btn-block btn-danger btn-lg">Desactivar <i class="fa fa-ban"></i></button>
							</div>
							<?php if(intval($permisos["idDespacho"])==0 && intval($permisos["idInstructor"])==0){ ?>
							<div class="form-group"><br></div>
							<div class="form-group">
								<button id="desactivar_todos_usuarios" type="button" class="btn btn-block btn-danger btn-lg">Desactivar Todos <i class="fa fa-ban"></i></button>
							</div>
							<?php } ?>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="alert alert-danger alert-dismissible" id="mensaje_error_edicion">
        			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        			<h4><i class="icon fa fa-ban"></i> Hubo un problema</h4>
        			Los usuarios seleccionados no pueden alterarse. Por favor contacte al administrador del sistema.
      			</div>
      			<div class="alert alert-success alert-dismissible" id="mensaje_success_edicion">
        			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        			<h4><i class="icon fa fa-check"></i> Éxito</h4>
        			Los cambios en los usuarios se han realizado correctamente.
      			</div>
			</div>
	  	</div>
	</section>
	<!-- /.content -->
  </div>