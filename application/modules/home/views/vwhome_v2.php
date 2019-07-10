<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Telcel | Cuestionarios</title>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link rel="icon" href="<?php echo base_url(); ?>img/icon.png" type="image/png">
		<script type="text/javascript">window.url = {base_url:"<?php echo nombre_ruta_host(); ?>"};</script>
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/ionicons.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/AdminLTE.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>plugins/iCheck/square/blue.css">
		<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.11.3.js"></script>
		<style>
			body{
				background: url(img/new/fondos-alta-nuevo.jpg) !important;
				background-size: cover !important;
			}
			.quest_container_5, .quest_container_6{
				background: url(img/new/new_fondo.jpg);
				background-size: cover;
				color:black;
				font-weight: bold;
			}
			h3,h4,h2{color:#fff;text-align:center;}
		</style>
	</head>
	<body class="hold-transition login-page">
		<div id="msg_receptor" class="callout" style="display:none;">
			<h4 id="msg1_callout"></h4>
			<span id="msg2_callout"></span>
		</div>
		<div class="login-box" id="main_header_box">
			<div class="login-logo"><a href="<?php echo base_url(); ?>"><img style="width: 240px;" src="<?php echo base_url(); ?>img/logo_telcel_gray.png"></a></div>
			<h3>Bienvenido(a) <?php echo $this->session->userdata("nombre"); ?></h3>
			<?php if(intval($this->session->userdata("idPermisos"))===0){ ?>
			<h4>Tu grupo es: <?php echo $this->session->userdata("nombre_grupo"); ?></h4>
			<?php }
			if($permisos!==FALSE){
				if(intval($permisos[0]["idDespacho"])>0) $w=" AND id=(SELECT idCurso FROM despachos WHERE id='".$permisos[0]["idDespacho"]."') AND is_new=1";
				elseif(intval($permisos[0]["idInstructor"])>0) $w=" AND id=(SELECT idCurso FROM despachos WHERE id=(SELECT idDespacho FROM instructores WHERE id='".$permisos[0]["idInstructor"]."')) AND is_new=1";
				else $w=" AND is_new=1";
			}else $w=" AND id=(SELECT idCurso FROM despachos WHERE id=(SELECT idDespacho FROM instructores WHERE id=(SELECT idInstructor FROM grupos WHERE id='".$this->session->userdata("idGrupo")."'))) AND is_new=1";
			$query="SELECT * FROM cuestionarios WHERE date_end IS NULL AND is_new=1 ORDER BY id ASC";
			$data=$controller->get_data_from_query($query);
			if($data!==FALSE){
				foreach($data AS $e => $key){
					//if((intval($key["is_admin"])>0 && ($this->session->userdata("clave")==$controller->get_data("clave","cuestionarios","is_new=1 AND nombre like '%".v2_TEST."%'")[0]["clave"]) || $permisos!==FALSE) || intval($key["is_admin"])===0){
					if(1){
			?>
			<div class="login-box-body quest_container quest_container_<?php echo $key["id"]; ?>" data-id="<?php echo $key["id"]; ?>" style="margin-bottom:30px;">
				<p class="login-box-msg"><?php echo $key["nombre"]; ?></p>
				<form>
					<div class="row">
						<div class="col-xs-4" style="width: 100%;">
						<?php
							//IF IS ADMIN
							if(intval($key["is_admin"])>0){
								if($permisos!==FALSE){
									if(intval($permisos[0]["idDespacho"])>0) 		$consulta="SELECT id, nombre FROM usuarios WHERE id NOT IN (SELECT idUsuario FROM usuarios_permisos) AND id IN (SELECT DISTINCT idAdmin FROM log_historial WHERE idCuestionario='".$key["id"]."') AND idInstructor IN (SELECT id FROM instructores WHERE idDespacho='".$permisos[0]["idDespacho"]."') ORDER BY nombre;";
									elseif(intval($permisos[0]["idInstructor"])>0) 	$consulta="SELECT id, nombre FROM usuarios WHERE id NOT IN (SELECT idUsuario FROM usuarios_permisos) AND id IN (SELECT DISTINCT idAdmin FROM log_historial WHERE idCuestionario='".$key["id"]."') AND idInstructor='".$permisos[0]["idInstructor"]."' ORDER BY nombre;";
									else 											$consulta="SELECT id, nombre FROM usuarios WHERE id NOT IN (SELECT idUsuario FROM usuarios_permisos) AND id IN (SELECT DISTINCT idAdmin FROM log_historial WHERE idCuestionario='".$key["id"]."') ORDER BY nombre;";
									$data_usuarios=$controller->get_data_from_query($consulta);
									if($data_usuarios!==FALSE){
						?>
										<button type="button" class="btn btn-primary btn-block btn-flat view_results_admin" data-id="<?php echo $key["id"]; ?>" disabled>Ver resultados</button><br>
										<select class="form-control usuarios_admin" data-idQuest="<?php echo $key["id"]; ?>">
											<option value="0">Seleccione un usuario</option>
											<?php foreach($data_usuarios AS $u=>$user){ ?>
												<option value="<?php echo $user["id"]; ?>"><?php echo $user['nombre']; ?></option>
											<?php } ?>
										</select>
							<?php 	}
								}else{//END IF permisos
									$data_pre=$controller->get_data_from_query("SELECT id FROM log_historial WHERE idAdmin='".$this->session->userdata("id")."' AND date_end IS NULL");
									if($data_pre===FALSE){
							?>
										<button type="button" class="btn btn-primary btn-block btn-flat start_admin_test" data-id="<?php echo $key["id"]; ?>">Iniciar Test</button><br>
							<?php 	}else{ ?>
										<button type="button" class="btn btn-primary btn-block btn-flat view_results_admin" data-id="<?php echo $key["id"]; ?>">Ver resultados</button>
							<?php 	} ?>
									<select class="form-control usuarios" id="usuarios" data-idQuest="<?php echo $key["id"]; ?>" style="display:none;">
										<option value="<?php echo $this->session->userdata('id'); ?>">User</option>
									</select>
							<?php
								}
							}else{//END IF is_admin
								if($permisos!==FALSE){
									if(intval($permisos[0]["idDespacho"])>0) 		$consulta="SELECT id, nombre FROM usuarios WHERE id NOT IN (SELECT idUsuario FROM usuarios_permisos) AND id IN (SELECT idUsuario FROM log_historial WHERE idCuestionario='".$key["id"]."') AND idInstructor IN (SELECT id FROM instructores WHERE idDespacho='".$permisos[0]["idDespacho"]."') ORDER BY nombre;";
									elseif(intval($permisos[0]["idInstructor"])>0) 	$consulta="SELECT id, nombre FROM usuarios WHERE id NOT IN (SELECT idUsuario FROM usuarios_permisos) AND id IN (SELECT idUsuario FROM log_historial WHERE idCuestionario='".$key["id"]."') AND idInstructor='".$permisos[0]["idInstructor"]."' ORDER BY nombre;";
									else 											$consulta="SELECT id, nombre FROM usuarios WHERE id NOT IN (SELECT idUsuario FROM usuarios_permisos) AND id IN (SELECT idUsuario FROM log_historial WHERE idCuestionario='".$key["id"]."') ORDER BY nombre;";
									$data_usuarios=$controller->get_data_from_query($consulta);
									if($data_usuarios!==FALSE){
							?>
										<button type="button" class="btn btn-primary btn-block btn-flat view_results_pre" data-id="<?php echo $key["id"]; ?>" disabled>Ver resultados PRE</button>
										<button type="button" class="btn btn-primary btn-block btn-flat view_results_post" data-id="<?php echo $key["id"]; ?>" disabled>Ver resultados POST</button><br>
										<select class="form-control usuarios" data-idQuest="<?php echo $key["id"]; ?>">
											<option value="0">Seleccione un usuario</option>
											<?php foreach($data_usuarios AS $u=>$user){ ?>
											<option value="<?php echo $user["id"]; ?>"><?php echo $user['nombre']; ?></option>
											<?php } ?>
										</select>
							<?php 	}
								}else{//END IF permisos

									if(date('Y-m-d')==$this->session->userdata("date_from")){
										$data_pre=$controller->get_data_from_query("SELECT ppal.id, COALESCE((SELECT id FROM historial_preguntas WHERE idLog=ppal.id LIMIT 1),0) AS respuesta FROM log_historial AS ppal WHERE ppal.pre_post=0 AND ppal.idCuestionario='".$key["id"]."' AND ppal.idUsuario='".$this->session->userdata("id")."' AND ppal.date_end IS NULL");
										if($data_pre===FALSE){
							?>
											<button type="button" class="btn btn-primary btn-block btn-flat start_quest" data-id="<?php echo $key["id"]; ?>">Iniciar PRE</button>
							<?php
										}else{
											if(intval($data_pre[0]["respuesta"])==0){
							?>
												<button type="button" class="btn btn-primary btn-block btn-flat start_quest" data-id="<?php echo $key["id"]; ?>">Continuar PRE</button>
							<?php
											}else{
							?>
												<button type="button" class="btn btn-primary btn-block btn-flat view_results_pre" data-id="<?php echo $key["id"]; ?>">Ver resultados PRE</button>
							<?php
											}
										}
									}elseif(date('Y-m-d')==$this->session->userdata("date_to")){
										$data_post=$controller->get_data_from_query("SELECT ppal.id, COALESCE((SELECT id FROM historial_preguntas WHERE idLog=ppal.id LIMIT 1),0) AS respuesta FROM log_historial AS ppal WHERE ppal.pre_post=1 AND ppal.idCuestionario='".$key["id"]."' AND ppal.idUsuario='".$this->session->userdata("id")."' AND ppal.date_end IS NULL");
										if($data_post===FALSE){
							?>
											<button type="button" class="btn btn-primary btn-block btn-flat start_quest" data-id="<?php echo $key["id"]; ?>">Iniciar POST</button>
							<?php
										}else{
											if(intval($data_post[0]["respuesta"])==0){
							?>
												<button type="button" class="btn btn-primary btn-block btn-flat start_quest" data-id="<?php echo $key["id"]; ?>">Continuar POST</button>
							<?php
											}else{
							?>
												<button type="button" class="btn btn-primary btn-block btn-flat view_results_post" data-id="<?php echo $key["id"]; ?>">Ver resultados POST</button>
							<?php			}
										}
									}
								}//END ELSE permisos
							?>
							<select class="form-control usuarios" id="usuarios" style="display:none;">
								<option value="<?php echo $this->session->userdata('id'); ?>"><?php echo $this->session->userdata('nombre'); ?></option>
							</select>
						<?php
							}//END ELSE is_admin
						?>
						</div>
					</div>
				</form>
			</div>
			<?php 		}//END IF is_admin, session
					}//END FOREACH
			}//END IF data
			?>
			<?php if(date('Y-m-d')==$this->session->userdata("date_to")){ if($controller->get_data("id","res_plan","id_usr='".$this->session->userdata("id")."'") !== FALSE){ ?>
				<button type="button" class="btn btn-warning btn-block btn-flat view_plan_accion" data-id="<?php echo $this->session->userdata("id"); ?>">Ver resultados Plan Acción</button><br>
			<?php }else{ ?>
				<button type="button" class="btn btn-warning btn-block btn-flat open_plan_accion" data-id="<?php echo $this->session->userdata("id"); ?>">Contestar Plan Acción</button><br>
			<?php }} ?>
			<?php if($controller->get_data_from_query("SELECT * FROM usuarios_permisos WHERE idUsuario='".$this->session->userdata("id")."'") !== FALSE){ ?>
			<h3><a href="<?php echo base_url(); ?>graficas" style="color:white;text-decoration:underline;">Gráficas y reportes</a><br></h3><br>
			<?php } ?>
			<a href="<?php echo base_url(); ?>signout" style="color:white;">Cerrar sesión</a><br>
			<a href="javascript:;" class="remove_backs" style="color:white;">Remover fondos</a><br>
		</div>
		<script src="<?php echo base_url(); ?>plugins/jQuery/jQuery-2.2.0.min.js"></script>
		<script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
		<script src="<?php echo base_url(); ?>plugins/iCheck/icheck.min.js"></script>
		<script>
			$(function(){
				$('input').iCheck({
					checkboxClass: 'icheckbox_square-blue',
					radioClass: 'iradio_square-blue',
					increaseArea: '20%' // optional
				});
			});
			$(document).ready(function(){
				$("#regenerate_session").on("click",function(){this.location.reload();});
				$(".start_admin_test").on("click",function(){
					var id = $(this).attr("data-id");
					var user = $(this).parent().find(".usuarios").val();
					if(user>0) window.location.replace(window.url.base_url+"start_quest_admin/"+id+"A"+user);
					else alert("Elija un participante para poder realizar el test");
				});
				$("#main_header_box").on("change",".usuarios",function(){
					var id = $(this).val();
					var idQuest = $(this).attr("data-idQuest");
					var elem = $(this);
					if(parseInt(id)>0){
						$.post(window.url.base_url+"home/ctrhome/check_user_quests",{id:id, idQuest:idQuest},function(resp){
							resp=JSON.parse(resp);
							if(parseInt(resp.num)==1){
								elem.parent().find(".view_results_pre").prop("disabled",false);
							}else if(parseInt(resp.num)==2){
								elem.parent().find(".view_results_pre").prop("disabled",false);
								elem.parent().find(".view_results_post").prop("disabled",false);
							}else{
								elem.parent().find(".view_results_pre").prop("disabled",true);
								elem.parent().find(".view_results_post").prop("disabled",true);
							}
						});
					}
				});
				$("#main_header_box").on("change",".usuarios_admin",function(){
					var id = $(this).val();
					var idQuest = $(this).attr("data-idQuest");
					var elem = $(this);
					if(parseInt(id)>0){
						$.post(window.url.base_url+"home/ctrhome/check_user_quests_admin",{id:id, idQuest:idQuest},function(resp){
							resp=JSON.parse(resp);
							if(parseInt(resp.num)==1){
								elem.parent().find(".view_results_admin").prop("disabled",false);
							}else{
								elem.parent().find(".view_results_admin").prop("disabled",true);
							}
						});
					}
				});
				$(".remove_backs").on("click",function(){
					$(".quest_container").css("background","white");
				});
				$(".open_plan_accion").on("click",function(){
		  			var id = $(this).attr("data-id");
		  			if(parseInt(id)>0) window.open(window.url.base_url+"application/planaccion/index.php?id="+id, "_blank");
		  		});
		  		$(".view_plan_accion").on("click",function(){
		  			var id = $(this).attr("data-id");
		  			if(parseInt(id)>0) window.open(window.url.base_url+"application/planaccion/plan.php?id="+id, "_blank");
		  		});
				$(".start_quest").on("click",function(){
					var id = $(this).attr("data-id");
					var user = $(this).parent().find(".usuarios").val();
					if(parseInt(user)>0) window.location.replace(window.url.base_url+"start_quest/"+id+"A"+user);
				});
				$("#main_header_box").on("click",".view_results_admin",function(){
					var id = $(this).attr("data-id");
					var user = $(this).parent().find("select").val();
					if(parseInt(user)>0) window.location.replace(window.url.base_url+"view_results_admin/"+id+"A"+user);
				});
				$("#main_header_box").on("click",".view_results_pre",function(){
					var id = $(this).attr("data-id");
					var user = $(this).parent().find("select").val();
					if(parseInt(user)>0) window.location.replace(window.url.base_url+"view_results_pre/"+id+"A"+user);
				});
				$("#main_header_box").on("click",".view_results_post",function(){
					var id = $(this).attr("data-id");
					var user = $(this).parent().find(".usuarios").val();
					if(parseInt(user)>0) window.location.replace(window.url.base_url+"view_results_post/"+id+"A"+user);
				});
			});
		</script>
	</body>
</html>
