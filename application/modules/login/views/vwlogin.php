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
		<link rel="shortcut icon" href="<?php echo base_url(); ?>img/icon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url(); ?>img/icons/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url(); ?>img/icons/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url(); ?>img/icons/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?php echo base_url(); ?>img/icons/apple-touch-icon-57-precomposed.png">
		<style>
			body{
				background: url(img/new/fondos-alta-nuevo.jpg) !important;
				background-size: cover !important;
			}
		</style>
	</head>
	<body class="hold-transition login-page">
		<div class="login-box">
			<div class="login-logo"><a href="<?php echo base_url(); ?>"><b style="color:white">Cuestionarios</b></a> <img style="width: 165px;" src="<?php echo base_url(); ?>img/new/globo.png"></div>
	  		<div id="msg_receptor" class="callout" style="display:none;">
	        	<h4 id="msg1_callout"></h4>
	        	<span id="msg2_callout"></span>
	      	</div>
	  		<div class="login-box-body login_container">
	    		<p class="login-box-msg">Iniciar sesión</p>
	    		<form id="guprapHAmeMusTuStadraswef" action="<?php echo nombre_ruta_host(); ?>admin/ctradmin/login" method="post" enctype="multipart/form-data">
	      			<div class="form-group has-feedback">
	      				<label>Número de empleado</label>
	        			<?php $d="email"; ?>
	        			<input type="text" class="form-control" placeholder="Número de empleado" name="<?php echo $d; ?>" id="<?php echo $d; ?>">
	        			<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
	      			</div>
	      			<div class="form-group has-feedback">
	      				<label>Contraseña</label>
	      				<?php $d="pwd"; ?>
	        			<input type="password" class="form-control" placeholder="Contraseña" name="<?php echo $d; ?>" id="<?php echo $d; ?>">
	        			<span class="glyphicon glyphicon-lock form-control-feedback"></span>
	      			</div>
	      			<div class="form-group has-feedback">
	      				<label>Curso perteneciente</label>
	      				<?php $d="clave"; ?>
	        			<select class="form-control" name="<?php echo $d; ?>" id="<?php echo $d; ?>">
	        				<?php $data=$controller->get_data_from_query("SELECT * FROM cuestionarios WHERE is_admin=0 ORDER BY nombre ASC"); if($data!==FALSE){ foreach($data AS $e=>$key){ ?>
	        				<option value="<?php echo $key['clave']; ?>"><?php echo $key['nombre']; ?></option>
	        				<?php }} ?>
	        			</select>
	      			</div>
	      			<div class="row">
	        			<div class="col-xs-8">
	          				<div class="checkbox icheck">
	          					<?php $d="remember"; ?>
	            				<label><input name="<?php echo $d; ?>" id="<?php echo $d; ?>" type="checkbox"> Recordar usuario</label>
	          				</div>
	        			</div>
	        			<div class="col-xs-4">
	          				<button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
	        			</div>
	      			</div>
	    		</form>
	    		<?php /* <a href="#" id="show_forgot_password">Olvidé mi contraseña</a><br>  */ ?>
	    		<a href="#" id="show_signup">Registrarse</a>
	  		</div>
<?php /* */ ?>
	  		<div class="login-box-body signup_container" style="display:none;">
	    		<p class="login-box-msg">Registrarse</p>
	    		<form id="registro_form" method="post" enctype="multipart/form-data">
	    			<div class="form-group has-feedback" style="display:none;">
	        			<?php $d="email"; ?>
	        			<input type="text" class="form-control" autocomplete="off" placeholder="Email" name="<?php echo $d; ?>" id="<?php echo $d; ?>">
	        			<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
	      			</div>
	      			<div class="form-group has-feedback">
	        			<?php $d="numero"; ?>
	        			<input type="text" class="form-control" required autocomplete="off" placeholder="Número de empleado" name="<?php echo $d; ?>" id="<?php echo $d; ?>">
	        			<span class="glyphicon glyphicon-list-alt form-control-feedback"></span>
	      			</div>
	      			<div class="form-group has-feedback">
	      				<?php $d="pwd"; ?>
	        			<input type="password" class="form-control" required autocomplete="off" placeholder="Contraseña" name="<?php echo $d; ?>" id="<?php echo $d; ?>">
	        			<span class="glyphicon glyphicon-lock form-control-feedback"></span>
	      			</div>
	      			<div class="form-group has-feedback">
	        			<?php $d="nombre_1"; ?>
	        			<input type="text" class="form-control" required autocomplete="off" placeholder="Nombre" name="<?php echo $d; ?>" id="<?php echo $d; ?>">
	        			<span class="glyphicon glyphicon-user form-control-feedback"></span>
	      			</div>
	      			<div class="form-group has-feedback">
	        			<?php $d="nombre_2"; ?>
	        			<input type="text" class="form-control" required autocomplete="off" placeholder="Apellido Paterno" name="<?php echo $d; ?>" id="<?php echo $d; ?>">
	        			<span class="glyphicon glyphicon-user form-control-feedback"></span>
	      			</div>
	      			<div class="form-group has-feedback">
	        			<?php $d="nombre_3"; ?>
	        			<input type="text" class="form-control" required autocomplete="off" placeholder="Apellido Materno" name="<?php echo $d; ?>" id="<?php echo $d; ?>">
	        			<span class="glyphicon glyphicon-user form-control-feedback"></span>
	      			</div>
	      			<div class="form-group has-feedback">
	        			<?php $d="antiguedad"; ?>
	        			<input type="text" class="form-control" autocomplete="off" placeholder="Antigüedad" name="<?php echo $d; ?>" id="<?php echo $d; ?>">
	        			<span class="glyphicon glyphicon-user form-control-feedback"></span>
	      			</div>
	      			<div class="form-group has-feedback">
	        			<?php $d="curso"; ?>
	        			<label>Curso</label>
	        			<select class="form-control" name="<?php echo $d; ?>" id="<?php echo $d; ?>" required>
	        				<option value="0">Seleccione una opción</option>
	        				<?php $data=$controller->get_data_from_query("SELECT * FROM cuestionarios WHERE is_admin=0 ORDER BY nombre ASC"); if($data!==FALSE){ foreach($data AS $e=>$key){ ?>
	        				<option value="<?php echo $key['id']; ?>" data-clave="<?php echo $key['clave']; ?>"><?php echo $key['nombre']; ?></option>
	        				<?php }} ?>
	        			</select>
	      			</div>
	      			<div class="form-group has-feedback">
	        			<?php $d="despacho"; ?>
	        			<label>Despacho</label>
	        			<select class="form-control" name="<?php echo $d; ?>" id="<?php echo $d; ?>" required></select>
	      			</div>
	      			<div class="form-group has-feedback">
	        			<?php $d="instructor"; ?>
	        			<label>Instructor</label>
	        			<select class="form-control" name="<?php echo $d; ?>" id="<?php echo $d; ?>" required></select>
	      			</div>
	      			<div class="form-group has-feedback">
	        			<?php $d="grupos"; ?>
	        			<label>Grupo</label>
	        			<select class="form-control" name="<?php echo $d; ?>" id="<?php echo $d; ?>" required></select>
	      			</div>
	      			<div class="row">
	        			<div class="col-xs-8">
	          				<div class="checkbox icheck">
	          					<?php $d="remember"; ?>
	            				<label><input name="<?php echo $d; ?>" id="<?php echo $d; ?>" type="checkbox"> Recordar usuario</label>
	          				</div>
	        			</div>
	        			<div class="col-xs-4">
	          				<button type="submit" class="btn btn-primary btn-block btn-flat">Enviar</button>
	        			</div>
	      			</div>
	    		</form>
	    		<a href="#" class="show_login">Iniciar sesión</a>
	  		</div><?php /* */ ?>

	  		<div class="login-box-body forgot_password_container" style="display:none;">
	    		<p class="login-box-msg">Enviar mail de recuperación</p>
	    		<form id="forgot_password" method="post" enctype="multipart/form-data">
	      			<div class="form-group has-feedback">
	        			<?php $d="email"; ?>
	        			<input type="text" class="form-control" autocomplete="off" placeholder="Email" name="<?php echo $d; ?>" id="<?php echo $d; ?>">
	        			<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
	      			</div>
	      			<div class="row">
	        			<div class="col-xs-4">
	          				<button type="submit" class="btn btn-primary btn-block btn-flat">Enviar</button>
	        			</div>
	      			</div>
	    		</form>
	    		<a href="#" class="show_login">Iniciar sesión</a>
	  		</div>
		</div>
		<script src="<?php echo base_url(); ?>plugins/jQuery/jQuery-2.2.0.min.js"></script>
		<script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
		<script src="<?php echo base_url(); ?>plugins/iCheck/icheck.min.js"></script>
		<script>
			$(function () {
		    	$('input').iCheck({
					checkboxClass: 'icheckbox_square-blue',
					radioClass: 'iradio_square-blue',
		      		increaseArea: '20%' // optional
		    	});
		  	});
		  	$(document).ready(function(){
		  		$(".just_read").on("keydown",function(e){return false;});
		  		$("#curso").on("change",function(){
		        	if(parseInt($(this).val())>0){
		        		//$("#clave").val($("#curso").find(":selected").attr("data-clave"));
		        		$.post(window.url.base_url+"home/ctrhome/get_despachos",{id:$(this).val()},function(resp){
							resp=JSON.parse(resp);
							$("#despacho option").remove();
							$("#despacho").append("<option selected value='0'>Seleccione una opción</option>");
							if(resp.success!==false)
								$.each(resp.result,function(i,item){
									$("#despacho").append("<option value='"+item.id+"'>"+item.nombre+"</option>");
								});
						});
		        	}
		        });
		        $("#despacho").on("change",function(){
		        	if(parseInt($(this).val())>0){
		        		$.post(window.url.base_url+"home/ctrhome/get_instructores",{id:$(this).val()},function(resp){
							resp=JSON.parse(resp);
							$("#instructor option").remove();
							$("#instructor").append("<option selected value='0'>Seleccione una opción</option>");
							if(resp.success!==false)
								$.each(resp.result,function(i,item){
									$("#instructor").append("<option value='"+item.id+"'>"+item.nombre+"</option>");
								});
						});
		        	}
		        });
		        $("#instructor").on("change",function(){
		        	if(parseInt($(this).val())>0){
		        		$.post(window.url.base_url+"home/ctrhome/get_grupos",{id:$(this).val()},function(resp){
							resp=JSON.parse(resp);
							$("#grupos option").remove();
							//$("#grupos").append("<option selected value='0'>Seleccione una opción</option>");
							if(resp.success!==false)
								$.each(resp.result,function(i,item){
									$("#grupos").append("<option value='"+item.id+"'>"+item.nombre+"</option>");
								});
						});
		        	}
		        });
		  		$("#show_signup").on("click",function(){
		  			$(".login_container").hide();
		  			$(".signup_container").show();
		  			$(".forgot_password_container").hide();
		  		});
		  		$(".show_login").on("click",function(){
		  			$(".signup_container").hide();
		  			$(".login_container").show();
		  			$(".forgot_password_container").hide();
		  		});
		  		$("#show_forgot_password").on("click",function(){
		  			$(".signup_container").hide();
		  			$(".login_container").hide();
		  			$(".forgot_password_container").show();
		  		});
				$("#guprapHAmeMusTuStadraswef").on("submit",function(evt){
					evt.preventDefault();
					$.post(window.url.base_url+"login/ctrlogin/login",{data:$(this).serialize()},function(resp){
						resp=JSON.parse(resp);
						$("#msg_receptor").fadeOut(800,function(){
							$("#msg_receptor").removeClass("callout-danger").removeClass("callout-success").removeClass("callout-warning").addClass("callout-"+resp.type_msg);
							$("#msg1_callout").html(resp.title);
							$(this).html(resp.msg);			
							$(this).show();
							$(this).fadeIn(700);
						});
						if(resp.success!==false){
							setTimeout(function(){
								location.reload();
							},2000);
						}
					});
				});
				$("#registro_form").on("submit",function(evt){
					evt.preventDefault();
					//*
					$.post(window.url.base_url+"login/ctrlogin/signup",{data:$(this).serialize(),clave:$("#curso").find(":selected").attr("data-clave")},function(resp){
						resp=JSON.parse(resp);
						$("#msg_receptor").fadeOut(800,function(){
							$("#msg_receptor").removeClass("callout-danger").removeClass("callout-success").removeClass("callout-warning").addClass("callout-"+resp.type_msg);
							$("#msg1_callout").html(resp.title);
							$(this).html(resp.msg);			
							$(this).show();
							$(this).fadeIn(700);
						});
						if(resp.success!==false){
							setTimeout(function(){
								location.reload();
							},2000);
						}
					});
					/* */
				});
				/*
				$("#forgot_password").on("submit",function(evt){
					evt.preventDefault();
					$.post(window.url.base_url+"login/ctrlogin/forgot_password",{data:$(this).serialize()},function(resp){
						resp=JSON.parse(resp);
						$("#msg_receptor").fadeOut(1400,function(){
							$("#msg_receptor").removeClass("callout-danger").removeClass("callout-success").removeClass("callout-warning").addClass("callout-"+resp.type_msg);
							$("#msg1_callout").html(resp.title);
							$(this).html(resp.msg);			
							$(this).show();
							$(this).fadeIn(1600);
						});
						if(resp.success!==false){
							setTimeout(function(){
								location.reload();
							},2000);
						}
					});
				});
				*/
		  	});
		</script>
	</body>
</html>