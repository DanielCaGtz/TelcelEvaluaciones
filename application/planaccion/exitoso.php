
<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Telcel | Cuestionarios</title>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link rel="icon" href="https://telcelevaluaciones.softandgo.com/img/icon.png" type="image/png">
		<script type="text/javascript">window.url = {base_url:"/"};</script>
		<link rel="stylesheet" href="../../css/bootstrap.css">
		<link rel="stylesheet" href="../../css/font-awesome.min.css">
		<link rel="stylesheet" href="../../css/ionicons.min.css">
		<link rel="stylesheet" href="../../css/AdminLTE.css">
		<link rel="stylesheet" href="../../plugins/iCheck/square/blue.css">
		<script type="text/javascript" src="../../js/jquery-1.11.3.js"></script>
	<style>
			body{
				background: url(../../img/new/fondos-alta-nuevo.jpg) !important;
				background-size: cover !important;
			}
			.quest_container_1{
	background-size: cover;
	font-weight: bold;
	/*background-image: url(../../img/new/cuadro-menu-aventura-mundial-op30.jpg);*/
	background-color: transparent;
	color:#FFF;
			}
			.quest_container_2{
				background-size: cover;
				background-color: transparent;
	font-weight: bold;
	/*background-image: url(../../img/new/cuadro-menu-aventura-mundial-op30.jpg);*/
	/*background-color: #176FB7;*/
	color:#FFF;
			}
			.quest_container_3{
				background: url(img/new/cuadro-menu-tensiones-op30.jpg);
				background-size: cover;
				color:black;
				font-weight: bold;
			}
			.quest_container_4{
				background: url(img/new/cuadro-menu-protocolo-op30.jpg);
				background-size: cover;
				color:black;
				font-weight: bold;
			}
			h3,h4,h2,p{
	color: #FFF;
	text-align: center;
}
		</style>
<?php
//include('./Connections/serv.php');
$mail=$_REQUEST['mail'];
/*
$sql="select nombre,numero from usuarios where id='$id'";
//$result = mysql_query($sql, $serv) or die(mysql_error());
$result= $serv->query($sql);
if (!$result) {
    echo 'No se pudo ejecutar la consulta: ' . mysql_error();
    exit;
}
$fila = $result->fetch_assoc();

$nombre=$fila['nombre'];
$nomina=$fila['numero'];
*/

?>
</head>
	<body class="hold-transition login-page">
		<div id="msg_receptor" class="callout" style="display:none;">
        	<h4 id="msg1_callout"></h4>
        	<span id="msg2_callout"></span>
      	</div>
		<div >
        <div class="login-logo"><a href="https://telcelevaluaciones.softandgo.com/"><img style="width: 240px;" src="https://telcelevaluaciones.softandgo.com/img/logo_telcel_gray.png"></a></div>
			
			<h3><strong>PLAN DE ACCIÓN</strong></h3>
            <p class="login-box-msg">El plan de acción ha sido guardado y enviado al mail <?php echo $mail?></p>
            
            

  		 
	    		
            
            	
	  		<!--</div> -->
  		
		</div>
		<script src="../../plugins/jQuery/jQuery-2.2.0.min.js"></script>
		<script src="../../js/bootstrap.min.js"></script>
		<script src="../../plugins/iCheck/icheck.min.js"></script>
		<script>
			$(function(){
		    	$('input').iCheck({
					checkboxClass: 'icheckbox_square-blue',
					radioClass: 'iradio_square-blue',
		      		increaseArea: '20%' // optional
		    	});
		  	});
		  	$(document).ready(function(){
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
