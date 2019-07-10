<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="<?php echo base_url(); ?>img/icon.png">
		<script type="text/javascript">window.url = {base_url:"<?php echo nombre_ruta_host(); ?>"};</script>
		<title>Telcel | Administrador</title>
		<link href="<?php echo base_url(); ?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>vendors/nprogress/nprogress.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>build/css/custom.min.css" rel="stylesheet">
		<style>.text_small{font-size:14px;margin-top:10px;}.loader_img{float: right;margin-top: -36px;display:none;}.button_footer{width: 200px;}</style>
	</head>
	<body class="nav-md">
		<div class="container body">
			<div class="main_container">
				<div class="right_col" role="main">
					<?php $permisos=$controller->get_data_from_query("SELECT * FROM usuarios_permisos WHERE idUsuario='".$this->session->userdata("id")."'")[0];
					$w="";
					if($permisos!==FALSE){
						if(intval($permisos["idDespacho"])>0) $w=" id=(SELECT idCurso FROM despachos WHERE id='".$permisos["idDespacho"]."') OR is_admin=1";
			        	elseif(intval($permisos["idInstructor"])>0) $w=" id=(SELECT idCurso FROM despachos WHERE id=(SELECT idDespacho FROM instructores WHERE id='".$permisos["idInstructor"]."')) OR is_admin=1";
					}
					foreach($controller->get_data("*","cuestionarios","$w") AS $q => $quest){ ?>
					<div class="containers_quests" data-idQuest="<?php echo $quest["id"]; ?>">
						<div class="page-title">
							<div class="title_left"><h3>Gráficas comparativas <p class="text_small"><?php echo $quest["nombre"]; ?></p></h3></div>
							<div class="title_right">
								<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
									<div class="input-group"></div>
								</div>
			  				</div>
						</div>
						<div class="clearfix"></div>
						<div class="row">
			  				<div class="col-md-6 col-sm-6 col-xs-12">
			  					<label> Fecha de inicio </label> <input type="date" class="form-control date_start"><br>
			  					<select class="form-control usuarios" data-idQuest="<?php echo $quest["id"]; ?>">
									<option value="0">Seleccione un usuario</option>
									<?php
									if(intval($permisos["idInstructor"])>0) $q="AND idGrupo IN (SELECT id FROM grupos WHERE idInstructor='".$permisos["idInstructor"]."')";
									elseif(intval($permisos["idDespacho"])>0) $q="AND idGrupo IN (SELECT id FROM grupos WHERE idInstructor IN (SELECT id FROM instructores WHERE idDespacho='".$permisos["idDespacho"]."'))";
									elseif(intval($permisos["idDespacho"])==0 && intval($permisos["idInstructor"])==0) $q="";

									$data=$controller->get_data_from_query("SELECT * FROM usuarios WHERE id IN (SELECT idUsuario FROM log_historial WHERE idCuestionario='".$quest["id"]."' GROUP BY idUsuario) $q ORDER BY nombre "); if($data !== FALSE){ foreach($data AS $u => $user){ ?>
									<option value="<?php echo $user["id"]; ?>"><?php echo $user["nombre"]; ?></option>
									<?php }} ?>
								</select>
								<div class="x_panel">
				  					<div class="x_title">
										<h2>Gráfica por USUARIO: Aciertos usuario / Aciertos promedio</h2>
										<ul class="nav navbar-right panel_toolbox">
					  						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
										</ul>
										<div class="clearfix"></div>
				  					</div>
				  					<div class="x_content"><canvas id="grafica1_<?php echo $quest["id"]; ?>" class="graph"></canvas></div>
								</div>
			  				</div>
			  				<?php if(intval($quest["is_admin"])===0){ ?>
			  				<div class="col-md-6 col-sm-6 col-xs-12">
			  					<label> Fecha de fin </label> <input type="date" class="form-control date_end"><br>
			  					<select class="form-control grupos" data-idQuest="<?php echo $quest["id"]; ?>">
									<option value="0">Seleccione un grupo</option>
									<?php
									if(intval($permisos["idInstructor"])>0) $q="grupo.idInstructor='".$permisos["idInstructor"]."'";
									elseif(intval($permisos["idDespacho"])>0) $q="instructor.idDespacho='".$permisos["idDespacho"]."'";
									elseif(intval($permisos["idDespacho"])==0 && intval($permisos["idInstructor"])==0) $q="1";

									$data=$controller->get_data_from_query("SELECT grupo.id, grupo.nombre, instructor.nombre AS nombre_instructor FROM grupos AS grupo INNER JOIN instructores AS instructor ON grupo.idInstructor=instructor.id WHERE $q ORDER BY nombre_instructor, nombre");
									if($data !== FALSE){ foreach($data AS $g => $grupo){ ?>
									<option value="<?php echo $grupo["id"]; ?>"><?php echo $grupo["nombre"]." INSTRUCTOR: ".$grupo["nombre_instructor"]; ?></option>
									<?php }} ?>
								</select>
								<div class="x_panel">
				  					<div class="x_title">
										<h2>Gráfica por GRUPOS: Aciertos grupo / Aciertos promedio</h2>
										<ul class="nav navbar-right panel_toolbox">
					  						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
										</ul>
										<div class="clearfix"></div>
				  					</div>
				  					<div class="x_content"><canvas id="grafica2_<?php echo $quest["id"]; ?>" class="graph"></canvas></div>
								</div>
			  				</div>
			  				<?php } ?>
			  			</div>
			  		</div>
			  		<?php } ?>
			  		<div class="col-md-6">
			  			<?php
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
						<div class="box-body">
		              		<form role="form">
		              			<?php if(intval($permisos["idDespacho"])==0 && intval($permisos["idInstructor"])==0){ ?>
				  				<div class="form-group" data-id="1" style="border: 1px solid #26b99a;padding: 10px;border-radius: 10px;">
			  						<label>Fecha de inicio</label><input type="date" class="reporte_date_start">
			  						<label>Fecha de fin</label><input type="date" class="reporte_date_end">
			  						<label>Despachos
			  						<select class="reporte_despachos">
			  							<option value="0">Todos los despachos</option>
										<?php foreach($despachos AS $i=>$item){ ?>
										<option value="<?php echo $item['id']; ?>"><?php echo $item['nombre']." (".$item["curso"].")"; ?></option>
										<?php } ?>
			  						</select></label>
			  						<label>Instructores
			  						<select class="reporte_instructores">
			  							<option value="0">Todos los instructores</option>
										<?php foreach($instructores AS $i=>$item){ ?>
										<option data-idDespacho="<?php echo $item["idDespacho"]; ?>" value="<?php echo $item['id']; ?>"><?php echo $item['nombre']." (".$item["despacho"].")"; ?></option>
										<?php } ?>
			  						</select></label>
			  						<label>Grupos
			  						<select class="reporte_grupos">
			  							<option value="0">Todos los grupos</option>
										<?php foreach($grupos AS $i=>$item){ ?>
										<option data-idDespacho="<?php echo $item["idDespacho"]; ?>" data-idInstructor="<?php echo $item["idInstructor"]; ?>" value="<?php echo $item['id']; ?>"><?php echo $item['nombre']; ?></option>
										<?php } ?>
			  						</select></label>
			  						<div class="button_footer"><span><a href="javascript:;" class="btn btn-primary btn-block get_reporte_new" style="width:150px;">Reporte Nuevo</a><img class="loader_img" src="<?php echo base_url("img/loader.GIF"); ?>"></span></div>
			  					</div>
			  					<?php } ?>
			  					<div class="form-group" data-id="2" style="border: 1px solid #337ab7;padding: 10px;border-radius: 10px;">
			  						<label>Fecha de inicio</label><input type="date" class="reporte_date_start">
			  						<label>Fecha de fin</label><input type="date" class="reporte_date_end">
			  						<label>Despachos
			  						<select class="reporte_despachos">
			  							<option value="0">Todos los despachos</option>
										<?php foreach($despachos AS $i=>$item){ ?>
										<option value="<?php echo $item['id']; ?>"><?php echo $item['nombre']." (".$item["curso"].")"; ?></option>
										<?php } ?>
			  						</select></label>
			  						<label>Instructores
			  						<select class="reporte_instructores">
			  							<option value="0">Todos los instructores</option>
										<?php foreach($instructores AS $i=>$item){ ?>
										<option data-idDespacho="<?php echo $item["idDespacho"]; ?>" value="<?php echo $item['id']; ?>"><?php echo $item['nombre']." (".$item["despacho"].")"; ?></option>
										<?php } ?>
			  						</select></label>
			  						<label>Grupos
			  						<select class="reporte_grupos">
			  							<option value="0">Todos los grupos</option>
										<?php foreach($grupos AS $i=>$item){ ?>
										<option data-idDespacho="<?php echo $item["idDespacho"]; ?>" data-idInstructor="<?php echo $item["idInstructor"]; ?>" value="<?php echo $item['id']; ?>"><?php echo $item['nombre']; ?></option>
										<?php } ?>
			  						</select></label>
			  						<div class="button_footer"><span><a href="javascript:;" class="btn btn-success btn-block get_reporte" style="width:150px;">Reporte</a><img class="loader_img" src="<?php echo base_url("img/loader.GIF"); ?>"></span></div>
			  					</div>
			  					<div class="form-group" data-id="2" style="border: 1px solid #337ab7;padding: 10px;border-radius: 10px;">
			  						<label>Fecha de inicio</label><input type="date" class="reporte_date_start">
			  						<label>Fecha de fin</label><input type="date" class="reporte_date_end">
			  						<label>Despachos
			  						<select class="reporte_despachos">
			  							<option value="0">Todos los despachos</option>
										<?php foreach($despachos AS $i=>$item){ ?>
										<option value="<?php echo $item['id']; ?>"><?php echo $item['nombre']." (".$item["curso"].")"; ?></option>
										<?php } ?>
			  						</select></label>
			  						<label>Instructores
			  						<select class="reporte_instructores">
			  							<option value="0">Todos los instructores</option>
										<?php foreach($instructores AS $i=>$item){ ?>
										<option data-idDespacho="<?php echo $item["idDespacho"]; ?>" value="<?php echo $item['id']; ?>"><?php echo $item['nombre']." (".$item["despacho"].")"; ?></option>
										<?php } ?>
			  						</select></label>
			  						<label>Grupos
			  						<select class="reporte_grupos">
			  							<option value="0">Todos los grupos</option>
										<?php foreach($grupos AS $i=>$item){ ?>
										<option data-idDespacho="<?php echo $item["idDespacho"]; ?>" data-idInstructor="<?php echo $item["idInstructor"]; ?>" value="<?php echo $item['id']; ?>"><?php echo $item['nombre']; ?></option>
										<?php } ?>
			  						</select></label>
			  						<div class="button_footer"><span><a href="javascript:;" class="btn btn-success btn-block get_reporte_individual" style="width:150px;">Reporte Individual</a><img class="loader_img" src="<?php echo base_url("img/loader.GIF"); ?>"></span></div>
			  					</div>
			  					<div class="form-group">
			  						<a href="<?php echo base_url(); ?>" class="btn btn-primary btn-block" style="width:150px;">Regresar</a>
			  					</div>
			  				</form>
			  			</div>
			  		</div>
		  		</div>
			</div>
		</div>
		<div id="create_here"></div>

		<script src="<?php echo base_url(); ?>vendors/jquery/dist/jquery.min.js"></script>
		<script src="<?php echo base_url(); ?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url(); ?>vendors/fastclick/lib/fastclick.js"></script>
		<script src="<?php echo base_url(); ?>vendors/nprogress/nprogress.js"></script>
		<script src="<?php echo base_url(); ?>vendors/Chart.js/dist/Chart.min.js"></script>
		<script src="<?php echo base_url(); ?>build/js/custom.min.js"></script>
		<script>
			$(document).ready(function(){
				$(".reporte_despachos").on("change",function(){
					var id=parseInt($(this).val());
					var element=$(this).parent().parent();
					element.find(".reporte_instructores").val("0");
					element.find(".reporte_grupos").val("0");
					if(id>0){
						$.each(element.find(".reporte_instructores option"),function(i,item){
							if(parseInt($(item).attr("data-idDespacho"))!=id && parseInt($(item).attr("data-idDespacho"))>0) $(item).hide();
							else $(item).show();
						});
						$.each(element.find(".reporte_grupos option"),function(i,item){
							if(parseInt($(item).attr("data-idDespacho"))!=id && parseInt($(item).attr("data-idDespacho"))>0) $(item).hide();
							else $(item).show();
						});
					}else{
						$.each(element.find(".reporte_instructores option"),function(i,item){
							$(item).show();
						});
						$.each(element.find(".reporte_grupos option"),function(i,item){
							$(item).show();
						});
					}
				});
				$(".reporte_instructores").on("change",function(){
					var id=parseInt($(this).val());
					var element=$(this).parent().parent();
					element.find(".reporte_grupos").val("0");
					if(id>0){
						$.each(element.find(".reporte_grupos option"),function(i,item){
							if(parseInt($(item).attr("data-idInstructor"))!=id && parseInt($(item).attr("data-idInstructor"))>0) $(item).hide();
							else $(item).show();
						});
					}else{
						var temp=parseInt(element.find(".reporte_despachos").val());
						$.each(element.find(".reporte_grupos option"),function(i,item){
							if(temp>0){
								if(parseInt($(item).attr("data-idDespacho"))!=temp && parseInt($(item).attr("data-idDespacho"))>0) $(item).hide();
								else $(item).show();
							}else $(item).show();
						});
					}
				});
				$(".get_reporte_individual").on("click",function(){
					$(this).parent().find(".loader_img").show();
					var element = $(this);
					
					var fecha_inicio=$(this).parent().parent().parent().find(".reporte_date_start").val();
					var fecha_fin=$(this).parent().parent().parent().find(".reporte_date_end").val();
					var despachos=$(this).parent().parent().parent().find(".reporte_despachos").val();
					var instructores=$(this).parent().parent().parent().find(".reporte_instructores").val();
					var grupos=$(this).parent().parent().parent().find(".reporte_grupos").val();
					
					$.post(window.url.base_url+"home/ctrhome/get_reporte_completo_individual",{fecha_inicio:fecha_inicio, fecha_fin:fecha_fin, despachos:despachos, instructores:instructores, grupos:grupos},function(resp){
						resp=JSON.parse(resp);
						element.parent().find(".loader_img").hide();
						var link = "<a id='download_xlsx' href='"+window.url.base_url+"files/"+resp.ruta+"' download style='display:none'></a>";
	                    $("#create_here").html(link);
	                    jQuery("#download_xlsx")[0].click();
					});
				});
				$(".get_reporte").on("click",function(){
					$(this).parent().find(".loader_img").show();
					var element = $(this);
					
					var fecha_inicio=$(this).parent().parent().parent().find(".reporte_date_start").val();
					var fecha_fin=$(this).parent().parent().parent().find(".reporte_date_end").val();
					var despachos=$(this).parent().parent().parent().find(".reporte_despachos").val();
					var instructores=$(this).parent().parent().parent().find(".reporte_instructores").val();
					var grupos=$(this).parent().parent().parent().find(".reporte_grupos").val();
					
					$.post(window.url.base_url+"home/ctrhome/get_reporte_completo",{fecha_inicio:fecha_inicio, fecha_fin:fecha_fin, despachos:despachos, instructores:instructores, grupos:grupos},function(resp){
						resp=JSON.parse(resp);
						element.parent().find(".loader_img").hide();
						var link = "<a id='download_xlsx' href='"+window.url.base_url+"files/"+resp.ruta+"' download style='display:none'></a>";
	                    $("#create_here").html(link);
	                    jQuery("#download_xlsx")[0].click();
					});
				});
				$(".get_reporte_new").on("click",function(){
					$(this).parent().find(".loader_img").show();
					var element = $(this);

					var fecha_inicio=$(this).parent().parent().parent().find(".reporte_date_start").val();
					var fecha_fin=$(this).parent().parent().parent().find(".reporte_date_end").val();
					var despachos=$(this).parent().parent().parent().find(".reporte_despachos").val();
					var instructores=$(this).parent().parent().parent().find(".reporte_instructores").val();
					var grupos=$(this).parent().parent().parent().find(".reporte_grupos").val();

					$.post(window.url.base_url+"home/ctrhome/get_reporte_completo_azul",{fecha_inicio:fecha_inicio, fecha_fin:fecha_fin, despachos:despachos, instructores:instructores, grupos:grupos},function(resp){
						resp=JSON.parse(resp);
						element.parent().find(".loader_img").hide();
						var link = "<a id='download_xlsx' href='"+window.url.base_url+"files/"+resp.ruta+"' download style='display:none'></a>";
	                    $("#create_here").html(link);
	                    jQuery("#download_xlsx")[0].click();
					});
				});
				Chart.defaults.global.legend = {enabled: true};
				$.each($(".graph"),function(i,item){
					document.getElementById($(item).attr("id")).getContext("2d").canvas.height = 150;
				});
				$(".usuarios").on("change",function(){
					if(parseInt($(this).val())>0){
						var id =$(this).parent().find(".graph").attr("id");
						var date_start= $(this).parent().parent().find(".date_start").val();
						var date_end= $(this).parent().parent().find(".date_end").val();
						console.log(date_start,date_end);
						ajustar_graficas(id,$(this).attr("data-idQuest"),$(this).val(),date_start,date_end);
					}
				});

				$(".grupos").on("change",function(){
					if(parseInt($(this).val())>0){
						var id =$(this).parent().find(".graph").attr("id");
						var date_start= $(this).parent().parent().find(".date_start").val();
						var date_end= $(this).parent().parent().find(".date_end").val();
						ajustar_graficas_grupo(id,$(this).attr("data-idQuest"),$(this).val(),date_start,date_end);
					}
				});

				//ajustar_graficas();
				function define_grafica(size_font,name,labels,array1,array2,array3,array4,tot){
					var parent=$("#"+name).parent();
					$("#"+name).remove();
					parent.append("<canvas id='"+name+"' class='graph'></canvas>");
					var ctx = document.getElementById(name);
				  	var mybarChart = new Chart(ctx, {type: 'bar',data: {labels: labels,datasets: [{label: 'Resultado',backgroundColor: "#26B99A",data: array1}, {label: 'Calificación',backgroundColor: "#5BBB27",data: array3}, {label: 'Promedio',backgroundColor: "#337ab7",data: array2}, {label: 'Calificación',backgroundColor: "#B8B834",data: array4}]},options: {scales: {yAxes: [{ticks: {beginAtZero: true, max:parseInt(tot), stepSize: 1}}], xAxes: [{ticks: {fontSize: size_font}}] }}});
				}
				function ajustar_graficas(id,quest,user,date_start,date_end){
					$.post(window.url.base_url+"home/ctrhome/get_graficas",{quest:quest,id:user,date_start:date_start,date_end:date_end},function(resp){
						resp=JSON.parse(resp);
						//console.log(resp);
						var labels_array_grafica1=[];
					  	var data_array1_grafica1=[];
					  	var data_array1_grafica2=[];
					  	var data_array1_grafica3=[];
					  	var data_array1_grafica4=[];
					  	labels_array_grafica1.push(resp.alumno_pre.nombre);
					  	labels_array_grafica1.push(resp.alumno_post.nombre);

					  	data_array1_grafica1.push(resp.alumno_pre.aciertos);
					  	data_array1_grafica1.push(resp.alumno_post.aciertos);

					  	data_array1_grafica3.push(resp.alumno_pre.aciertos*10/resp.alumno_pre.totales);
					  	data_array1_grafica3.push(resp.alumno_post.aciertos*10/resp.alumno_pre.totales);

					  	data_array1_grafica2.push(resp.promedio_pre.aciertos);
					  	data_array1_grafica2.push(resp.promedio_post.aciertos);

					  	data_array1_grafica4.push(resp.promedio_pre.aciertos*10/resp.alumno_pre.totales);
					  	data_array1_grafica4.push(resp.promedio_post.aciertos*10/resp.alumno_pre.totales);
						define_grafica(12,id,labels_array_grafica1,data_array1_grafica1,data_array1_grafica2,data_array1_grafica3,data_array1_grafica4,resp.alumno_pre.totales);
					});
				}

				function ajustar_graficas_grupo(id,quest,grupo,date_start,date_end){
					$.post(window.url.base_url+"home/ctrhome/get_graficas_grupo",{quest:quest,id:grupo,date_start:date_start,date_end:date_end},function(resp){
						resp=JSON.parse(resp);
						//console.log(resp);
						var labels_array_grafica1=[];
					  	var data_array1_grafica1=[];
					  	var data_array1_grafica2=[];
					  	var data_array1_grafica3=[];
					  	var data_array1_grafica4=[];
					  	labels_array_grafica1.push(resp.alumno_pre.nombre);
					  	labels_array_grafica1.push(resp.alumno_post.nombre);

					  	data_array1_grafica1.push(resp.alumno_pre.aciertos);
					  	data_array1_grafica1.push(resp.alumno_post.aciertos);

					  	data_array1_grafica3.push(resp.alumno_pre.aciertos*10/resp.alumno_pre.totales);
					  	data_array1_grafica3.push(resp.alumno_post.aciertos*10/resp.alumno_pre.totales);

					  	data_array1_grafica2.push(resp.promedio_pre.aciertos);
					  	data_array1_grafica2.push(resp.promedio_post.aciertos);

					  	data_array1_grafica4.push(resp.promedio_pre.aciertos*10/resp.alumno_pre.totales);
					  	data_array1_grafica4.push(resp.promedio_post.aciertos*10/resp.alumno_pre.totales);
						define_grafica(12,id,labels_array_grafica1,data_array1_grafica1,data_array1_grafica2,data_array1_grafica3,data_array1_grafica4,resp.alumno_pre.totales);
					});
				}
			});
		</script>
  	</body>
</html>