	<?php
	if(intval($id_cuestionario)>1){$colores=array("0"=>"314889","1"=>"2d2a71","2"=>"1b9dbf","3"=>"147c9c");}
	elseif(intval($id_cuestionario)==1){$colores=array("0"=>"3fade2","1"=>"13499f","2"=>"eaa54a","3"=>"9db73a");}
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
			background: url(../img/new/cuadro-respuesta-<?php echo $id_cuestionario; ?>.jpg);
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
	</style>
	<body <?php echo $is_view ? "class='overview'" : ""; ?>>
		<div id="actual_time" data-time="<?php echo $actual_time; ?>"></div>
		<div class="container">
			<div class="fs-form-wrap" id="fs-form-wrap">
				<div class="fs-title">
					<h1><?php echo $nombre_cuestionario; ?></h1>
					<div class="codrops-top">
						<a class="codrops-icon codrops-icon-prev confirmar_alerta" href="<?php echo base_url(); ?>"><span>Regresar al menú principal</span></a>
						<a class="codrops-icon codrops-icon-info" href="#"><span>Responde a cada una de las preguntas. Recuerda que tienes un tiempo límite para responder el cuestionario.</span></a>
						<span id="clock"></span>
					</div>
				</div>
				<form id="myform" class="fs-form fs-form-full" data-id="<?php echo $id_cuestionario; ?>" autocomplete="off">
					<?php if($is_view){ ?>
					<?php $aciertos=$controller->get_data_from_query("SELECT COUNT(*) AS num FROM historial_preguntas WHERE idLog='$id_log' AND idRespuesta IN (SELECT id FROM respuestas WHERE is_correct=1);")[0]["num"]; ?>
					<?php $totales=$controller->get_data_from_query("SELECT COUNT(*) AS num FROM historial_preguntas WHERE idLog='$id_log';")[0]["num"]; ?>
					<h3 class="aciertos">ACIERTOS: <?php echo $aciertos; ?> DE <?php echo $totales; ?></h3><br clear="all">
					<h3 class="aciertos">CALIFICACIÓN: <?php $calif=$aciertos>0 ? (number_format(floatval(($aciertos*10)/($totales)),2)):number_format(0,2); echo $calif; ?>&nbsp;
					<img src="<?php echo base_url(); ?>img/calificacion_<?php echo floatval($calif)>5.9?'pos':'neg'; ?>.png" width="30px"></h3>
					<?php } else{ if(count($data_temp)>0){ end($data_temp); $last=key($data_temp); $last=explode("P",$last)[1]; $last++; }else $last=0; } ?>
					<ol class="fs-fields">
						<?php $data=$controller->get_data("*","preguntas","idCuestionario = '$id_cuestionario' AND date_end IS NULL","id ASC","",""); if($data!==FALSE){ foreach($data AS $e => $key){ ?>
						<li data-input-trigger>
							<label class="fs-field-label fs-anim-upper" data-info="Escoge una de las cuatro opciones señaladas"><?php echo $key["nombre"]; ?></label>
							<select data-id="<?php echo $key["id"]; ?>" class="cs-select cs-skin-boxes fs-anim-lower preguntas_select">
								<option value="0" disabled <?php echo !$is_view?"selected":""; ?>>Escoge una respuesta</option>
								<?php
								if($is_view) $idRespuesta=$controller->get_data("idRespuesta","historial_preguntas","idPregunta='".$key["id"]."' AND idLog='$id_log' AND idUsuario='$user'","","","1")[0]["idRespuesta"]; else $idRespuesta=0;
								if(!$is_view){ if(array_key_exists("P".$key["id"],$data_temp)) $idRespuesta=$data_temp["P".$key["id"]]; }
								$letters=array(0=>"a)",1=>"b)",2=>"c)",3=>"d)"); $data_child=$controller->get_data("id,nombre","respuestas","idPregunta='".$key["id"]."' AND date_end IS NULL","","",""); if($data_child!==FALSE){ foreach($data_child AS $i => $item){ ?>
								<option data-parent="<?php echo $key["id"]; ?>" value="<?php echo $item["id"]; ?>" <?php echo intval($idRespuesta)===intval($item["id"])?"selected data-selected='1'":"data-selected='0'"; ?> data-class="color-<?php echo $colores[$i]; ?>"><?php echo $letters[$i]." ".$item["nombre"]; ?></option>
								<?php }} ?>
							</select>
						</li>
						<?php }} /*
						<li>
							<label class="fs-field-label fs-anim-upper" for="q4">Describe how you imagine your new website</label>
							<textarea class="fs-anim-lower" id="q4" name="q4" placeholder="Describe here"></textarea>
						</li>
						<li>
							<label class="fs-field-label fs-anim-upper" for="q5">What's your budget?</label>
							<input class="fs-mark fs-anim-lower" id="q5" name="q5" type="number" placeholder="1000" step="100" min="100"/>
						</li> */ ?>
					</ol><!-- /fs-fields -->
					<?php if($is_view){ ?>
					<button class="fs-submit regresar_menu" type="button" data-href="<?php echo base_url(); ?>">Cerrar revisión</button>
					<?php }else{ ?>
					<button class="fs-submit" id="submit_button" type="submit">Finalizar cuestionario</button>
					<?php } ?>
				</form><!-- /fs-form -->
			</div><!-- /fs-form-wrap -->

		</div><!-- /container -->
		<?php /*
		if(intval($last)>0){ ?>
		<script>
			$(document).ready(function(){
				for (var i=0; i <= <?php echo intval($last); ?>; i++){
					$(".fs-continue").click();
				}
				var x=1;
				$.each($(".fs-fields").find("li"),function(i,item){
					if($(item).parent().hasClass("fs-fields")){
						$(item).removeClass("fs-current");
						if(x==<?php echo intval($last); ?>)
							$(item).addClass("fs-current");
						x++;
					}
				});
				$(".fs-number-current").html(<?php echo intval($last); ?>);
				$.each($(".fs-nav-dots").find("button"),function(i,item){
					if((i+1) < <?php echo intval($last); ?>){
						$(item).removeClass("fs-dot-current").prop('disabled', false);
					}else if((i+1) == <?php echo intval($last); ?>){
						$(item).addClass("fs-dot-current").prop('disabled', false);
					}else{
						$(item).removeClass("fs-dot-current").prop('disabled', true);
					}
				});
			});
		</script>
		<?php } /* */ ?>
		<?php if($is_view){ ?>
		<script>
			$(document).ready(function(){
				$("#myform").removeClass("fs-form-full").addClass("fs-form-overview").addClass("fs-show");
				$.each($(".fs-fields").find("li"),function(i,item){$(item).removeClass("fs-current");});
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
				var time_ = new Date().getTime() + parseInt($("#actual_time").attr("data-time"))*1000;
				/*
				$('#clock').countdown(time_, {elapse:true}).on('update.countdown', function(event) {
  					var $this = $(this);
  					if(event.elapsed) {
    					//console.log(event);
  					} else {
    					$this.html(event.strftime('Tiempo restante: <span>%H:%M:%S</span>'));
  					}
				}).on('finish.countdown',function(evnt){
					
				});
				/* */
				//*
				//*
				window.onbeforeunload = function() {
  					return "¿Desea salir de la página?";
				}
				/* */
				$("#clock").countdown(time_, function(event){
					$(this).html(event.strftime('Tiempo restante: <span>%H:%M:%S</span>'));
				}).on('finish.countdown', function() {
					window.onbeforeunload = function() {}
					save_quest();
				});
				function save_quest(){
					var id=$("#myform").attr("data-id");
					var data={};
					$.each($("#myform select"),function(i,item){
						var temp={};
						temp["idPregunta"]=$(item).attr("data-id");
						temp["idRespuesta"]=$(item).val();
						data[i]=temp;
					});
					//console.log(data);
					$.post(window.url.base_url+"home/ctrhome/save_quest",{data:data,id:id},function(resp){
						resp=JSON.parse(resp);
						if(resp.success!==false){
							window.location.replace(window.url.base_url);
						}else alert(resp.msg);
					});
				}
				/* */
			});
		</script>
		<?php } ?>
		<script>
			$(document).ready(function(){
				$(".cs-options").append('<i class="fa fa-times close_preguntas" aria-hidden="true"></i>');
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
				$("#myform").on("submit",function(e){
					$("#submit_button").prop('disabled', true);
					e.preventDefault();
					save_quest();
				});
				function save_quest(){
					var id=$("#myform").attr("data-id");
					var data={};
					$.each($("#myform select"),function(i,item){
						var temp={};
						temp["idPregunta"]=$(item).attr("data-id");
						temp["idRespuesta"]=$(item).val();
						data[i]=temp;
					});
					//console.log(data);
					$.post(window.url.base_url+"home/ctrhome/save_quest",{data:data,id:id},function(resp){
						resp=JSON.parse(resp);
						if(resp.success!==false){
							window.onbeforeunload = function() {}
							window.location.replace(window.url.base_url);
						}else{
							alert(resp.msg);
							$("#submit_button").prop('disabled', false);
						}
					});
				}
			});
		</script>
