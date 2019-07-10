	<?php
	$permisos=$controller->get_data_from_query("SELECT * FROM usuarios_permisos WHERE idUsuario='".$this->session->userdata("id")."'")[0];
	$w="";
	if($permisos!==FALSE){
		if(intval($permisos["idDespacho"])>0) $w=" id=(SELECT idCurso FROM despachos WHERE id='".$permisos["idDespacho"]."') OR is_admin=1";
    	elseif(intval($permisos["idInstructor"])>0) $w=" id=(SELECT idCurso FROM despachos WHERE id=(SELECT idDespacho FROM instructores WHERE id='".$permisos["idInstructor"]."')) OR is_admin=1";
	}
	$q="";
	if(intval($permisos["idInstructor"])>0) $q=" WHERE id='".$permisos["idInstructor"]."' ";
	elseif(intval($permisos["idDespacho"])>0) $q=" WHERE id IN (SELECT id FROM instructores WHERE idDespacho='".$permisos["idDespacho"]."') ";
	$instructores=$controller->get_data_from_query("SELECT id,nombre,idDespacho, (SELECT nombre FROM despachos WHERE id=idDespacho) AS despacho FROM instructores $q ORDER BY nombre");

	$q="";
	if(intval($permisos["idInstructor"])>0) $q=" WHERE idInstructor='".$permisos["idInstructor"]."' ";
	elseif(intval($permisos["idDespacho"])>0) $q=" WHERE idInstructor IN (SELECT id FROM instructores WHERE idDespacho='".$permisos["idDespacho"]."') ";
	$grupos=$controller->get_data_from_query("SELECT grupo.*, (SELECT idDespacho FROM instructores WHERE id=grupo.idInstructor) AS idDespacho FROM grupos AS grupo $q ORDER BY grupo.nombre");

	$q="";
	if(intval($permisos["idInstructor"])>0) $q=" WHERE id=(SELECT idDespacho FROM instructores WHERE id='".$permisos["idInstructor"]."') ";
	elseif(intval($permisos["idDespacho"])>0) $q=" WHERE id = '".$permisos["idDespacho"]."' ";
	$despachos=$controller->get_data_from_query("SELECT ppal.*, (SELECT nombre FROM cursos WHERE id=ppal.idCurso) AS curso FROM despachos AS ppal $q ORDER BY ppal.nombre"); ?>
	<style>.text_small{font-size:14px;margin-top:10px;}.loader_img{float: right;margin-top: -36px;display:none;}.button_footer{width: 200px;}</style>
	
	<div class="content-wrapper">
		<section class="content-header">
	  		<h1>Reportes <small></small></h1>
	  		<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="#">Gráficos</a></li>
				<li class="active">Gráficos y reportes</li>
	  		</ol>
		</section>
		<section class="content">
			<div class="callout callout-warning">
        		<h4>¡Aviso!</h4>
        		<p>Para visualizar correctamente los gráficos por favor permita pop-ups y ventanas emergentes para este sitio.</p>
      		</div>
	  		<div class="row">
	  			<?php if(intval($permisos["idDespacho"])==0 && intval($permisos["idInstructor"])==0){ ?>
	  			<div class="col-md-6">
					<div class="box box-primary">
						<div class="box-header with-border">
			  				<h3 class="box-title">Reporte administrativo</h3>
						</div>
	              		<form role="form">
	              			<div class="box-body">
				  				<div class="form-group" data-id="1">
				  					<div class="form-group"><label>Fecha de inicio</label><input type="date" class="form-control reporte_date_start"></div>
			  						<div class="form-group"><label>Fecha de fin</label><input type="date" class="form-control reporte_date_end"></div>
			  						<div class="form-group">
				  						<label>Despachos</label>
				  						<select class="reporte_despachos form-control">
				  							<option value="0">Todos los despachos</option>
											<?php foreach($despachos AS $i=>$item){ ?>
											<option value="<?php echo $item['id']; ?>"><?php echo $item['nombre']." (".$item["curso"].")"; ?></option>
											<?php } ?>
				  						</select>
				  					</div>
				  					<div class="form-group">
				  						<label>Instructores</label>
				  						<select class="reporte_instructores form-control">
				  							<option value="0">Todos los instructores</option>
											<?php foreach($instructores AS $i=>$item){ ?>
											<option data-idDespacho="<?php echo $item["idDespacho"]; ?>" value="<?php echo $item['id']; ?>"><?php echo $item['nombre']." (".$item["despacho"].")"; ?></option>
											<?php } ?>
				  						</select>
			  						</div>
			  						<div class="form-group">
				  						<label>Grupos</label>
				  						<select class="reporte_grupos form-control">
				  							<option value="0">Todos los grupos</option>
											<?php foreach($grupos AS $i=>$item){ ?>
											<option data-idDespacho="<?php echo $item["idDespacho"]; ?>" data-idInstructor="<?php echo $item["idInstructor"]; ?>" value="<?php echo $item['id']; ?>"><?php echo $item['nombre']; ?></option>
											<?php } ?>
				  						</select>
				  					</div>
			  						<div class="button_footer"><span><a href="javascript:;" class="btn btn-primary btn-block get_reporte_new" style="width:150px;">Reporte Nuevo</a><img class="loader_img" src="<?php echo base_url("img/loader.GIF"); ?>"></span></div>
			  					</div>
			  				</div>
			  			</form>
			  		</div>
			  	</div>
			  	<?php } ?>
			  	<div class="col-md-6">
					<div class="box box-success">
						<div class="box-header with-border">
			  				<h3 class="box-title">Reporte concentrado</h3>
						</div>
	              		<form role="form">
	              			<div class="box-body">
			  					<div class="form-group" data-id="2">
			  						<div class="form-group"><label>Fecha de inicio</label><input type="date" class="form-control reporte_date_start"></div>
			  						<div class="form-group"><label>Fecha de fin</label><input type="date" class="form-control reporte_date_end"></div>
			  						<div class="form-group">
				  						<label>Despachos</label>
				  						<select class="reporte_despachos form-control">
				  							<option value="0">Todos los despachos</option>
											<?php foreach($despachos AS $i=>$item){ ?>
											<option value="<?php echo $item['id']; ?>"><?php echo $item['nombre']." (".$item["curso"].")"; ?></option>
											<?php } ?>
				  						</select>
				  					</div>
			  						<div class="form-group">
				  						<label>Instructores</label>
				  						<select class="reporte_instructores form-control">
				  							<option value="0">Todos los instructores</option>
											<?php foreach($instructores AS $i=>$item){ ?>
											<option data-idDespacho="<?php echo $item["idDespacho"]; ?>" value="<?php echo $item['id']; ?>"><?php echo $item['nombre']." (".$item["despacho"].")"; ?></option>
											<?php } ?>
				  						</select>
				  					</div>
			  						<div class="form-group">
				  						<label>Grupos</label>
				  						<select class="reporte_grupos form-control">
				  							<option value="0">Todos los grupos</option>
											<?php foreach($grupos AS $i=>$item){ ?>
											<option data-idDespacho="<?php echo $item["idDespacho"]; ?>" data-idInstructor="<?php echo $item["idInstructor"]; ?>" value="<?php echo $item['id']; ?>"><?php echo $item['nombre']; ?></option>
											<?php } ?>
				  						</select>
				  					</div>
			  						<div class="button_footer"><span><a href="javascript:;" class="btn btn-success btn-block get_reporte" style="width:150px;">Reporte</a><img class="loader_img" src="<?php echo base_url("img/loader.GIF"); ?>"></span></div>
			  					</div>
			  				</div>
		  				</form>
		  			</div>
		  		</div>
		  		<div class="col-md-6">
					<div class="box box-success">
						<div class="box-header with-border">
			  				<h3 class="box-title">Reporte individual</h3>
						</div>
	              		<form role="form">
	              			<div class="box-body">
			  					<div class="form-group" data-id="2">
			  						<div class="form-group"><label>Fecha de inicio</label><input type="date" class="reporte_date_start form-control"></div>
			  						<div class="form-group"><label>Fecha de fin</label><input type="date" class="reporte_date_end form-control"></div>
			  						<div class="form-group">
				  						<label>Despachos</label>
				  						<select class="reporte_despachos form-control">
				  							<option value="0">Todos los despachos</option>
											<?php foreach($despachos AS $i=>$item){ ?>
											<option value="<?php echo $item['id']; ?>"><?php echo $item['nombre']." (".$item["curso"].")"; ?></option>
											<?php } ?>
				  						</select>
				  					</div>
			  						<div class="form-group">
				  						<label>Instructores</label>
				  						<select class="reporte_instructores form-control">
				  							<option value="0">Todos los instructores</option>
											<?php foreach($instructores AS $i=>$item){ ?>
											<option data-idDespacho="<?php echo $item["idDespacho"]; ?>" value="<?php echo $item['id']; ?>"><?php echo $item['nombre']." (".$item["despacho"].")"; ?></option>
											<?php } ?>
				  						</select>
				  					</div>
			  						<div class="form-group">
				  						<label>Grupos</label>
				  						<select class="reporte_grupos form-control">
				  							<option value="0">Todos los grupos</option>
											<?php foreach($grupos AS $i=>$item){ ?>
											<option data-idDespacho="<?php echo $item["idDespacho"]; ?>" data-idInstructor="<?php echo $item["idInstructor"]; ?>" value="<?php echo $item['id']; ?>"><?php echo $item['nombre']; ?></option>
											<?php } ?>
				  						</select>
				  					</div>
			  						<div class="button_footer"><span><a href="javascript:;" class="btn btn-success btn-block get_reporte_individual" style="width:150px;">Reporte Individual</a><img class="loader_img" src="<?php echo base_url("img/loader.GIF"); ?>"></span></div>
			  					</div>
			  				</div>
		  				</form>
		  			</div>
		  		</div>
		  	</div>
		</section>
	</div>


	<div class="content-wrapper">
		<section class="content-header">
	  		<h1>Gráficas <small></small></h1>
		</section>
		<section class="content">
	  		<div class="row">
				<div class="col-md-6">
					<div class="box box-info">
						<div class="box-header with-border">
			  				<h3 class="box-title">Gráficas comparativas por participante</h3>
						</div>
						<form role="form" id="grafica_individual">
	              			<div class="box-body">
								<div class="form-group">
				  					<div class="form-group">
					  					<label>Primer participante</label>
					  					<select class="first form-control" name="first_participante" required>
					  						<option value="" selected>Seleccione el primer participante</option>
					  						<?php
											if(intval($permisos["idInstructor"])>0) $q="AND ppal.idGrupo IN (SELECT id FROM grupos WHERE idInstructor='".$permisos["idInstructor"]."')";
											elseif(intval($permisos["idDespacho"])>0) $q="AND ppal.idGrupo IN (SELECT id FROM grupos WHERE idInstructor IN (SELECT id FROM instructores WHERE idDespacho='".$permisos["idDespacho"]."'))";
											elseif(intval($permisos["idDespacho"])==0 && intval($permisos["idInstructor"])==0) $q="";

											$query="SELECT ppal.*, (SELECT nombre FROM cuestionarios WHERE clave=ppal.clave) AS nombre_quest FROM usuarios AS ppal WHERE ppal.id IN (SELECT idUsuario FROM log_historial GROUP BY idUsuario) AND ppal.id NOT IN (SELECT idUsuario FROM usuarios_permisos GROUP BY idUsuario) $q ORDER BY nombre ;";
											$data=$controller->get_data_from_query($query); if($data !== FALSE){ foreach($data AS $u => $user){ ?>
											<option value="<?php echo $user["id"]; ?>"><?php echo $user["nombre"]." - ".$user["nombre_quest"]; ?></option>
											<?php }} ?>
					  					</select>
					  				</div>
					  				<div class="form-group">
					  					<label>Segundo participante (opcional)</label>
					  					<select class="second form-control" name="second_participante">
					  						<option value="0" selected>Seleccione el segundo participante</option>
					  						<?php
											if($data !== FALSE){ foreach($data AS $u => $user){ ?>
											<option value="<?php echo $user["id"]; ?>"><?php echo $user["nombre"]." - ".$user["nombre_quest"]; ?></option>
											<?php }} ?>
					  					</select>
					  				</div>
					  				<div class="form-group">
					  					<label>Tipo de cuestionario</label>
					  					<div class="radio"><label><input type="radio" checked name="type_test" class=" type_test[]" value="0">PRE</label></div>
					  					<div class="radio"><label><input type="radio" name="type_test" class=" type_test[]" value="1"> POST</label></div>
					  				</div>
					  				<div class="form-group">
					  					<label>Tipo de gráfico</label>
					  					<div class="radio"><label><input type="radio" checked name="type_graph" class=" type_graph[]" value="1"> Por calificación</label></div>
					  					<div class="radio"><label><input type="radio" name="type_graph" class=" type_graph[]" value="0">Por aciertos</label></div>
					  				</div>
								</div>
								<div class="button_footer"><span><a href="javascript:;" class="btn btn-info btn-block get_grafica_individual" data-type="1" style="width:150px;">Graficar</a></span></div>
			  				</div>
						</form>
		  			</div>
				</div>
				<div class="col-md-6">
					<div class="box box-info">
						<div class="box-header with-border">
			  				<h3 class="box-title">Gráficas comparativas por grupo</h3>
						</div>
						<form role="form">
	              			<div class="box-body">
								<div class="form-group">
				  					<div class="form-group"><label>Fecha de inicio</label><input type="date" name="date_start" class="form-control date_start"></div>
			  						<div class="form-group"><label>Fecha de fin</label><input type="date" name="date_end" class="form-control date_end"></div>
				  					<div class="form-group">
					  					<label>Primer grupo</label>
					  					<select class="first form-control" name="first_participante" required>
					  						<option value="" selected>Seleccione el primer grupo</option>
					  						<?php
											if(intval($permisos["idInstructor"])>0) $q="grupo.idInstructor='".$permisos["idInstructor"]."'";
											elseif(intval($permisos["idDespacho"])>0) $q="instructor.idDespacho='".$permisos["idDespacho"]."'";
											elseif(intval($permisos["idDespacho"])==0 && intval($permisos["idInstructor"])==0) $q="1";

											$query="SELECT grupo.id, grupo.nombre, instructor.nombre AS nombre_instructor FROM grupos AS grupo INNER JOIN instructores AS instructor ON grupo.idInstructor=instructor.id WHERE $q ORDER BY nombre_instructor, nombre ;";
											$data=$controller->get_data_from_query($query); if($data !== FALSE){ foreach($data AS $u => $grupo){ ?>
											<option value="<?php echo $grupo["id"]; ?>"><?php echo $grupo["nombre"]." - INSTRUCTOR: ".$grupo["nombre_instructor"]; ?></option>
											<?php }} ?>
					  					</select>
					  				</div>
					  				<div class="form-group">
					  					<label>Segundo grupo (opcional)</label>
					  					<select class="second form-control" name="second_participante">
					  						<option value="0" selected>Seleccione el segundo grupo</option>
					  						<?php
											if($data !== FALSE){ foreach($data AS $u => $grupo){ ?>
											<option value="<?php echo $grupo["id"]; ?>"><?php echo $grupo["nombre"]." - INSTRUCTOR: ".$grupo["nombre_instructor"]; ?></option>
											<?php }} ?>
					  					</select>
					  				</div>
					  				<div class="form-group">
					  					<label>Tipo de cuestionario</label>
					  					<div class="radio"><label><input type="radio" checked name="type_test" class=" type_test[]" value="0">PRE</label></div>
					  					<div class="radio"><label><input type="radio" name="type_test" class=" type_test[]" value="1"> POST</label></div>
					  				</div>
					  				<div class="form-group">
					  					<label>Tipo de gráfico</label>
					  					<div class="radio"><label><input type="radio" checked name="type_graph" class=" type_graph[]" value="1"> Por calificación</label></div>
					  					<div class="radio"><label><input type="radio" name="type_graph" class=" type_graph[]" value="0">Por aciertos</label></div>
					  				</div>
								</div>
								<div class="button_footer">
									<span><a href="javascript:;" class="btn btn-info btn-block get_grafica_grupo" data-type="2" style="width:210px;">Graficar</a>
									<a href="javascript:;" class="btn btn-warning btn-block get_grafica_grupo_completo" data-type="22" style="width:210px;">Graficar Primer grupo completo</a></span>
								</div>
			  				</div>
						</form>
		  			</div>
				</div>
				<?php if(intval($permisos["idInstructor"])==0){ ?>
				<div class="col-md-6">
					<div class="box box-warning">
						<div class="box-header with-border">
			  				<h3 class="box-title">Gráficas comparativas por despacho</h3>
						</div>
						<form role="form">
	              			<div class="box-body">
								<div class="form-group">
				  					<div class="form-group"><label>Fecha de inicio</label><input type="date" name="date_start" class="form-control date_start"></div>
			  						<div class="form-group"><label>Fecha de fin</label><input type="date" name="date_end" class="form-control date_end"></div>
				  					<div class="form-group">
					  					<label>Primer despacho</label>
					  					<select class="first form-control" name="first_participante" required>
					  						<option value="" selected>Seleccione el primer despacho</option>
					  						<?php
											if(intval($permisos["idDespacho"])>0) $q="despacho.id='".$permisos["idDespacho"]."'";
											elseif(intval($permisos["idDespacho"])==0 && intval($permisos["idInstructor"])==0) $q="1";

											$query="SELECT despacho.*, quest.nombre AS nombre_curso, quest.clave FROM despachos AS despacho INNER JOIN cuestionarios AS quest ON despacho.idCurso=quest.id WHERE $q ORDER BY despacho.nombre;";
											$data=$controller->get_data_from_query($query); if($data !== FALSE){ foreach($data AS $u => $despacho){ ?>
											<option value="<?php echo $despacho["id"]; ?>"><?php echo $despacho["nombre"]." - CURSO: ".$despacho["nombre_curso"]; ?></option>
											<?php }} ?>
					  					</select>
					  				</div>
					  				<div class="form-group">
					  					<label>Segundo despacho (opcional)</label>
					  					<select class="second form-control" name="second_participante">
					  						<option value="0" selected>Seleccione el segundo despacho</option>
					  						<?php
											if($data !== FALSE){ foreach($data AS $u => $despacho){ ?>
											<option value="<?php echo $despacho["id"]; ?>"><?php echo $despacho["nombre"]." - CURSO: ".$despacho["nombre_curso"]; ?></option>
											<?php }} ?>
					  					</select>
					  				</div>
					  				<div class="form-group">
					  					<label>Tipo de cuestionario</label>
					  					<div class="radio"><label><input type="radio" checked name="type_test" class=" type_test[]" value="0">PRE</label></div>
					  					<div class="radio"><label><input type="radio" name="type_test" class=" type_test[]" value="1"> POST</label></div>
					  				</div>
					  				<div class="form-group">
					  					<label>Tipo de gráfico</label>
					  					<div class="radio"><label><input type="radio" checked name="type_graph" class=" type_graph[]" value="1"> Por calificación</label></div>
					  					<div class="radio"><label><input type="radio" name="type_graph" class=" type_graph[]" value="0">Por aciertos</label></div>
					  				</div>
								</div>
								<div class="button_footer"><span><a href="javascript:;" class="btn btn-warning btn-block get_grafica_despacho" data-type="3" style="width:150px;">Graficar</a></span></div>
			  				</div>
						</form>
		  			</div>
				</div>
				<?php } ?>
				<div class="col-md-6">
					<div class="box box-info">
						<div class="box-header with-border">
			  				<h3 class="box-title">Gráficas comparativas generales</h3>
						</div>
						<form role="form">
	              			<div class="box-body">
								<div class="form-group">
									<div class="form-group">
										<label>Cuestionario</label>
					  					<select class="quests form-control" name="quests" required>
					  						<?php foreach($controller->get_data("id,nombre,clave","cuestionarios") AS $e=>$key){ ?>
					  						<option value="<?php echo $key['id']; ?>"><?php echo $key["nombre"]; ?></option>
					  						<?php } ?>
					  					</select>
					  				</div>
					  				<div class="form-group" style="display:none;" id="despachos_div">
										<label>Despacho</label>
					  					<select class="despachos form-control" name="despachos" required>
					  						<?php foreach($controller->get_data_from_query("SELECT ppal.id, ppal.nombre, det.nombre AS curso FROM despachos AS ppal INNER JOIN cuestionarios AS det ON ppal.idCurso=det.id;") AS $e=>$key){ ?>
					  						<option value="<?php echo $key['id']; ?>"><?php echo $key["nombre"]." - ".$key["curso"]; ?></option>
					  						<?php } ?>
					  					</select>
					  				</div>
					  				<div class="form-group">
					  					<label>Tipo de gráfica</label>
					  					<div class="radio"><label><input type="radio" checked name="type_new_graph" class=" type_new_graph[]" value="0">Por Meses</label></div>
					  					<div class="radio"><label><input type="radio" name="type_new_graph" class=" type_new_graph[]" value="1">Por Despacho</label></div>
					  					<div class="radio"><label><input type="radio" name="type_new_graph" class=" type_new_graph[]" value="2">Por Grupo</label></div>
					  				</div>
					  				<div class="form-group">
					  					<label>Tipo de cuestionario</label>
					  					<div class="radio"><label><input type="radio" checked name="type_test" class=" type_test[]" value="0">PRE</label></div>
					  					<div class="radio"><label><input type="radio" name="type_test" class=" type_test[]" value="1"> POST</label></div>
					  				</div>
					  					<label>Tipo de gráfico</label>
					  					<div class="radio"><label><input type="radio" checked name="type_graph" class=" type_graph[]" value="1"> Por calificación</label></div>
					  					<div class="radio"><label><input type="radio" name="type_graph" class=" type_graph[]" value="0">Por aciertos</label></div>
					  				</div>
								</div>
								<div class="button_footer">
									<span><a href="javascript:;" class="btn btn-info btn-block get_grafica_general" data-type="2" style="width:210px;">Graficar</a></span>
								</div>
			  				</div>
						</form>
		  			</div>
				</div>
	  		</div>
		</section>
  	</div>
  	<div id="create_here"></div>
