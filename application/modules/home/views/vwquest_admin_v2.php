	<?php
		$colores=array("0"=>"3c8dbc","1"=>"fff","2"=>"3c8dbc","3"=>"fff","4"=>"3c8dbc");
	?>
	<style>
		.fs-title{text-align: justify;}
		body{
			background: url(../img/new/fondos-alta-nuevo.jpg) !important;
			background-size: cover !important;
		}
		.codrops-icon span{color:white !important;}
		.cs-skin-boxes > span {
			border: 3px solid #3580ba;
			border-radius: 5px;
			width: 200px;
			height: 200px;
			font-size: 1em;
			padding: 0 0 0 10px;
			background: #555b64;
			background: url(../img/new/new_fondo.jpg);
		    background-size: cover;
		}
		.fs-title{background: rgba(255, 255, 255, 0.3);}
		.aciertos{
			float: right;
    		background: rgba(255, 255, 255, 0.3);
    		padding: 12px;
    		margin-top: 0px;
    	}
    	.close_preguntas{float: right;font-size: 25px;margin: 10px;position: relative;}
	    div#users-contain { width: 350px; margin: 20px 0; }
	    div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
	    div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
	    .ui-dialog .ui-state-error { padding: .3em; }
	    .validateTips { border: 1px solid transparent; padding: 0.3em; }
	    @media screen and (max-width: 52.5em){.fs-form {top: 11em !important;}}
	    .fs-form-full {top: 36%;}
	</style>
	<body <?php echo $is_view ? "class='overview'" : ""; ?>>
		<div class="container">
			<div class="fs-form-wrap" id="fs-form-wrap">
				<div class="fs-title">
					<h1><?php echo $nombre_cuestionario; ?></h1>
					<h4>En cada una de las 11 afirmaciones, señale el grado de acuerdo o desacuerdo con los comportamientos que tiene en su trabajo, eligiendo el número apropiado, según las siguientes opciones de respuesta: 1. Totalmente en desacuerdo; 2. En desacuerdo; 3. Ni de acuerdo, ni en desacuerdo; 4. De acuerdo; 5. Totalmente de acuerdo</h4>
					<div class="codrops-top">
						<a class="codrops-icon codrops-icon-prev confirmar_alerta" href="<?php echo base_url(); ?>"><span>Regresar al menú principal</span></a>
						<a class="codrops-icon codrops-icon-info" href="#"><span>Responde a cada una de las preguntas.</span></a>
						<span id="clock"></span>
					</div>
				</div>
				<form id="myform" class="fs-form fs-form-full" data-user="<?php echo $user; ?>" data-id="<?php echo $id_cuestionario; ?>" autocomplete="off">
					<?php if($is_view){ ?>
					<?php $aciertos=$controller->get_data_from_query("SELECT SUM(idRespuesta) AS num FROM historial_preguntas WHERE idLog='$id_log';")[0]["num"]; ?>
					<?php $totales=$controller->get_data_from_query("SELECT COUNT(*) AS num FROM historial_preguntas WHERE idLog='$id_log';")[0]["num"]; ?>
					<h3 class="aciertos">PUNTOS: <?php echo intval($aciertos); ?></h3><br clear="all">
					<h3 class="aciertos">RANGO: <?php
						$rango = "";
						if($aciertos <= 18) $rango = "1 - 18 Competencia no desarrollada: Muestra un desarrollo nulo de la Competencia de Enfoque a Resultados.";
						elseif($aciertos>=19 && $aciertos <= 26) $rango = "19 - 26 Competencia ligeramente desarrollada: Asume el compromiso con los objetivos de la organización, actuando de manera Eficiente frente a los obstáculos o imprevistos, asumiendo la responsabilidad por los aciertos y errores cometidos. Realiza correctamente el trabajo, entregándolo en tiempo y con calidad.";
						elseif($aciertos>=27 && $aciertos <= 34) $rango = "27 - 34 Competencia medianamente desarrollada: Asume con seriedad sus tareas y obtiene los resultados esperados en los plazos establecidos, comprometiéndose con su equipo y con equipos de otras áreas en el logro de los mismos. Identifica claramente el impacto que tiene su contribución individual con los resultados globales de la empresa. Se ausenta sólo por motivos de fuerza mayor y hace lo posible para reponer el tiempo perdido.";
						elseif($aciertos>=35 && $aciertos <= 42) $rango = "35 - 42 Competencia altamente desarrollada: Alinea sus funciones y tareas asignadas con los objetivos estratégicos de la empresa. Facilita el alcance de resultados de otras áreas. Aporta soluciones de alto valor agregado para la organización, incluso frente a problemas complejos y en escenarios cambiantes.";
						elseif($aciertos>=43) $rango = "43 - 55 Competencia plenamente desarrollada: Actúa de manera pro activa al realizar cambios y mejoras en los métodos de trabajo para hacer más eficiente su operación. Promueve el mejoramiento de la calidad, la satisfacción del cliente interno y externo y/o las ventas.";
						echo $rango;
					?></h3>
					<?php }else{ if(count($data_temp)>0){ end($data_temp); $last=key($data_temp); $last=explode("P",$last)[1]; $last++; }else $last=0; } ?>
					<ol class="fs-fields">
						<?php $data=$controller->get_data("*","preguntas","idCuestionario = '$id_cuestionario' AND date_end IS NULL","id ASC","",""); if($data!==FALSE){ foreach($data AS $e => $key){ ?>
						<li data-input-trigger>
							<label class="fs-field-label fs-anim-upper" data-info="Escoge una de las cinco opciones señaladas"><?php echo $key["nombre"]; ?></label>
							<select data-id="<?php echo $key["id"]; ?>" class="cs-select cs-skin-boxes fs-anim-lower preguntas_select">
								<option value="0" disabled <?php echo !$is_view?"selected":""; ?>>Escoge una respuesta</option>
								<?php
								if($is_view) $idRespuesta=$controller->get_data("idRespuesta","historial_preguntas","idPregunta='".$key["id"]."' AND idLog='$id_log' AND idUsuario='$user'","","","1")[0]["idRespuesta"]; else $idRespuesta=0;
								if(!$is_view){ if(array_key_exists("P".$key["id"],$data_temp)) $idRespuesta=$data_temp["P".$key["id"]]; }
								$letters=array(0=>"A) 1. Totalmente en desacuerdo",1=>"B) 2. En desacuerdo",2=>"C) 3. Ni de acuerdo, ni en desacuerdo",3=>"D) 4. De acuerdo", 4=>"E) 5. Totalmente de acuerdo"); for($jj=0; $jj<5; $jj++){ ?>
								<option <?php echo intval($idRespuesta)===intval(($jj+1))?"selected data-selected='1'":"data-selected='0'"; ?> data-parent="<?php echo $key["id"]; ?>" value="<?php echo $jj+1; ?>" data-class="color-<?php echo $colores[$jj]; ?>"><?php echo $letters[$jj]; ?></option>
								<?php } ?>
							</select><br>
						</li>
						<?php }} ?>
					</ol>
					<?php if($is_view){ ?>
					<button class="fs-submit regresar_menu" type="button" data-href="<?php echo base_url(); ?>">Cerrar revisión</button>
					<?php }else{ ?>
					<button class="fs-submit" type="submit">Finalizar cuestionario</button>
					<div id="dialog-form" style="display:none;" title="Recuerda esto antes de continuar">
  						<img src="<?php echo base_url("img/protocolo1.png"); ?>" />
					</div>
					<?php } ?>
				</form>
			</div>
		</div>
		<?php if($is_view){ ?>
		<script>
			$(document).ready(function(){
				$("#myform").removeClass("fs-form-full").addClass("fs-form-overview").addClass("fs-show");
				$.each($(".fs-fields").find("li"),function(i,item){$(item).removeClass("fs-current")});
				$(".fs-controls").find(".fs-continue").removeClass("fs-show");
				$(".fs-controls").find(".fs-nav-dots").removeClass("fs-show");
				$(".fs-numbers").removeClass("fs-show");
				$(".fs-progress").removeClass("fs-show").css("width","100%");
				$(".regresar_menu").on("click",function(){
					window.location = $(this).attr('data-href');
				});
				$(".graficar").on("click",function(){
					var id=$(this).attr("data-idQuest");
					var user=$(this).attr("data-usuario");
					window.location.replace(window.url.base_url+"grafica/"+id+"A"+user);
				});
			});
		</script>
		<?php }else{ ?>
		<script>
			$(document).ready(function(){
				window.onbeforeunload = function() {
  					return "¿Desea salir de la página?";
				}
				$(".cs-options").append('<i class="fa fa-times close_preguntas" aria-hidden="true"></i>');
				//$("div.cs-select").after('<br><label style="color:white;">Observaciones:</label><textarea style="border: 1px solid white;border-radius: 10px;color: white;padding: 10px;margin:5px;" class="form-group preguntas_observaciones"></textarea>');
				$(".cs-options").on("click",".close_preguntas",function(){
					$(this).parent().parent().removeClass("cs-active");
				});
				$(".cs-options li").on("click",function(){
					var id=$(this).attr("data-value");
					var parent=$(this).attr("data-parent");
					$.post(window.url.base_url+"home/ctrhome/save_pregunta_temp",{id:id,parent:parent},function(resp){
						//resp=JSON.parse(resp);
						//console.log(resp);
						$(".fs-continue").click();
					});
				});
				$(".confirmar_alerta").on("click",function(e){
					e.preventDefault();
    				if(confirm("Hacer esto cancelará el envío del cuestionario. ¿Estás de acuerdo?")) window.location = $(this).attr('href');
				});
				function save_quest(){
					var id=$("#myform").attr("data-id");
					var id_user=$("#myform").attr("data-user");
					var data={};
					$.each($("#myform select"),function(i,item){
						var temp={};
						temp["idPregunta"]=$(item).attr("data-id");
						temp["idRespuesta"]=$(item).val();
						temp["observaciones"]=$(item).parent().parent().find("textarea").val();
						data[i]=temp;
					});
					//console.log(data);
					$.post(window.url.base_url+"home/ctrhome/save_quest_admin",{data:data,id:id,id_user:id_user},function(resp){
						resp=JSON.parse(resp);
						if(resp.success!==false){
							window.onbeforeunload = function() {}
							window.location.replace(window.url.base_url);
						}else alert(resp.msg);
					});
				}
				if(parseInt($(document).width())<1024) var w_temp=350;
				else w_temp=870;
				var dialog = $( "#dialog-form" ).dialog({
					autoOpen: false,
					height: 630,
					width: w_temp,
					modal: true,
					buttons: {
						"Aceptar": save_quest,
						"Cancelar": function() {
							dialog.dialog( "close" );
							$("#dialog-form").hide();
						}
					},
					close: function() {}
				});
				$("#myform").on("submit",function(e){
					e.preventDefault();
					save_quest();
					//$("#dialog-form").show();
					//dialog.dialog( "open" );
				});
			});
		</script>
		<?php } ?>
