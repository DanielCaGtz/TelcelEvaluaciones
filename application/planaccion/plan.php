
<!DOCTYPE html>
<html>
<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Telcel | Cuestionarios</title>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link rel="icon" href="https://telcelevaluaciones.softandgo.com/img/icon.png" type="image/png">
		<script type="text/javascript">window.url = {base_url:"/"};</script>
		<link rel="stylesheet" href="https://telcelevaluaciones.softandgo.com/css/bootstrap.css">
		<link rel="stylesheet" href="https://telcelevaluaciones.softandgo.com/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://telcelevaluaciones.softandgo.com/css/ionicons.min.css">
		<link rel="stylesheet" href="https://telcelevaluaciones.softandgo.com/css/AdminLTE.css">
		<link rel="stylesheet" href="https://telcelevaluaciones.softandgo.com/plugins/iCheck/square/blue.css">
		<script type="text/javascript" src="https://telcelevaluaciones.softandgo.com/js/jquery-1.11.3.js"></script>
	<style>
			body{
				background: url(https://telcelevaluaciones.softandgo.com/img/new/fondo-plan-accion.jpg) !important;
				background-size: cover !important;
			}
			.quest_container_1{
	background-size: cover;
	font-weight: bold;
	/*background-image: url(https://telcelevaluaciones.softandgo.com/img/new/cuadro-menu-aventura-mundial-op30.jpg);*/
	background-color: transparent;
	color:#000;
			}
			.quest_container_2{
				background-size: cover;
	font-weight: bold;
	/*background-image: url(https://telcelevaluaciones.softandgo.com/img/new/cuadro-menu-aventura-mundial-op30.jpg);*/
	background-color: transparent;
	color:#000;
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
			h3,h4,h2{
	color: #999;
	text-align: center;
}
		</style>
<?php
include('./Connections/serv.php');
$id=$_REQUEST['id'];

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


$sql="select count(*) as valida from res_plan where id_usr='$id'";
//$result = mysql_query($sql, $serv) or die(mysql_error());
$result= $serv->query($sql);
if (!$result) {
    echo 'No se pudo ejecutar la consulta: ' . mysql_error();
    exit;
}
$fila = $result->fetch_assoc();

$valida=$fila['valida'];




$sql2="select res_1_1,res_1_2,res_1_3,res_2_1,res_2_2,res_2_3,res_3_1,res_3_2,res_3_3,res_3_4,res_4_1,res_4_2,res_4_3 from res_plan where id_usr='$id'";
$rs= $serv->query($sql2);
if (!$rs) {
    echo 'No se pudo ejecutar la consulta: ' . mysql_error();
    exit;
}
$resp = $rs->fetch_assoc();

$res_1_1 = $resp['res_1_1'];
$res_1_2 = $resp['res_1_2'];
$res_1_3 = $resp['res_1_3'];

$res_2_1 = $resp['res_2_1'];
$res_2_2 = $resp['res_2_2'];
$res_2_3 = $resp['res_2_3'];

$res_3_1 = $resp['res_3_1'];
$res_3_2 = $resp['res_3_2'];
$res_3_3 = $resp['res_3_3'];
$res_3_4 = $resp['res_3_4'];

$res_4_1 = $resp['res_4_1'];
$res_4_2 = $resp['res_4_2'];
$res_4_3 = $resp['res_4_3'];


?>
</head>
	<body class="hold-transition login-page">
		<div id="msg_receptor" class="callout" style="display:none;">
        	<h4 id="msg1_callout"></h4>
        	<span id="msg2_callout"></span>
      	</div>
		<div >
        <br><br><br><br>
        <br><br><br><br>
			
			<h3><strong>PLAN DE ACCIÓN</strong></h3>
            <p class="login-box-msg">Identifica las acciones prioritarias a las que te comprometes para elevar tu competencia de enfoque a resultados.</p>
            <p class="login-box-msg"><b>Usuario:</b> <?php echo $nombre?>  ||  <b>Nomina:</b> <?php echo $nomina?> </p>
            

  		 <?php 
		 if ($valida == 0){

		 ?>
             
             <h2> El empleado aun no responde su Plan de acción </h2>
	      <?php
		 }
		 else {
		 ?>
            
            	<form name="form1" action="guardar.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id?>">
                <div class="login-box-body quest_container quest_container_1" data-id="1" style="margin-bottom:30px;">
	      			<div class="row"  >
                    <div class="col-sm-1">
                          <label class="col-sm-1 control-label" style="text-align:center"></label>
                          
                         </div>
	        			<div class="col-sm-3" >
	          			  
                          <p align="center"> <strong>Criterio conductual 1</strong></p>
                          <p style="font-weight:normal">Trabajar para alcanzar los estándares definidos por los niveles superiores, en los tiempos previstos y con los recursos que se le asignan.
                          <br><br><br><br>
                          </p>
				          				
        			     </div>
                         
                         <!--<div class="col-sm-4">
	          			  
                          <p align="center"><strong>Acciones</strong></p>
                          <p>1) Actuar de manera eficiente frente a los obstáculos e imprevistos.</p>
                          <p>2) Reconocer mi responsabilidad por aciertos y errores cometidos.</p>
                          <p>3) Asumir mi compromiso con los objetivos de la organización. </p>
				          				
        			     </div> -->
                         
                         <div class="col-sm-8">
                          <label class="col-sm-5 control-label" style="text-align:center">Acciones</label>
                          
                         </div>
                         
                         
                         <div class="col-sm-8">
	          			  
                         <!-- <p align="center"><strong>Acciones</strong></p>-->
                         
                           <label class="col-sm-6 control-label" style="font-weight:normal">1) Actuar de manera eficiente frente a los obstáculos e imprevistos.</label>
                            
                            
                          
                             <div class="col-sm-2">
                            <input type="date" style=" color:#666666" name="res_1_1" value="<?php echo $res_1_1?>">
                             </div>
                          </div>
                          
                           
                           <div class="col-sm-8">
                           <label class="col-sm-6 control-label" style="font-weight:normal">2) Reconocer mi responsabilidad por aciertos <br> y errores cometidos.</label>
                           <div class="col-sm-2">
                            <input type="date" style=" color:#666666" name="res_1_2" value="<?php echo $res_1_2?>">
                             </div>
                           </div>
                           
                           <div class="col-sm-8">
                           <label class="col-sm-6 control-label" style="font-weight:normal">3) Asumir mi compromiso con los objetivos <br> de la organización.</label>
                           <div class="col-sm-2">
                            <input type="date" style=" color:#666666" name="res_1_3" value="<?php echo $res_1_3?>">
                             </div>		
        			     </div> 
                        
                        
	      			</div>
  </div>              
<!-- Nueva fila -->
<div class="login-box-body quest_container quest_container_2" data-id="1" style="margin-bottom:30px;">
<div class="row"  >
                    <div class="col-sm-1">
                          <label class="col-sm-1 control-label" style="text-align:center"></label>
                          
                         </div>
	        			<div class="col-sm-3" >
	          			  
                          <p align="center"> <strong>Criterio conductual 2</strong></p>
                          <p style="font-weight:normal">Trabajar con objetivos claramente establecidos, realistas y desafiantes considerando los posibles beneficios/rentabilidad del negocio.
                          <br><br><br><br>
                          </p>
				          				
        			     </div>
                         
                         <!--<div class="col-sm-4">
	          			  
                          <p align="center"><strong>Acciones</strong></p>
                          <p>1) Actuar de manera eficiente frente a los obstáculos e imprevistos.</p>
                          <p>2) Reconocer mi responsabilidad por aciertos y errores cometidos.</p>
                          <p>3) Asumir mi compromiso con los objetivos de la organización. </p>
				          				
        			     </div> -->
                         
                         <div class="col-sm-8">
                          <label class="col-sm-5 control-label" style="text-align:center">Acciones</label>
                          
                         </div>
                         
                         
                         <div class="col-sm-8">
	          			  
                         <!-- <p align="center"><strong>Acciones</strong></p>-->
                         
                           <label class="col-sm-6 control-label" style="font-weight:normal">1) Comprometerme con mi equipo y otras áreas para lograr los resultados.</label>
                            
                            
                          
                             <div class="col-sm-2">
                            <input type="date" style=" color:#666666" name="res_2_1" value="<?php echo $res_2_1?>">
                             </div>
                          </div>
                          
                           
                           <div class="col-sm-8">
                           <label class="col-sm-6 control-label" style="font-weight:normal">2) Identificar el impacto de mi contribución con los resultados de la empresa.</label>
                           <div class="col-sm-2">
                            <input type="date" style=" color:#666666" name="res_2_2" value="<?php echo $res_2_2?>">
                             </div>
                           </div>
                           
                           <div class="col-sm-8">
                           <label class="col-sm-6 control-label" style="font-weight:normal">3) Asumir mis tareas y obtener los resultados esperados y en el plazo establecido.</label>
                           <div class="col-sm-2">
                            <input type="date" style=" color:#666666" name="res_2_3" value="<?php echo $res_2_3?>">
                             </div>		
        			     </div> 
                        
                        
	      			</div>                
                  </div>
 
<!-- Nueva fila -->
<div class="login-box-body quest_container quest_container_1" data-id="1" style="margin-bottom:30px;">
<div class="row"  >
                    <div class="col-sm-1">
                          <label class="col-sm-1 control-label" style="text-align:center"></label>
                          
                         </div>
	        			<div class="col-sm-3" >
	          			  
                          <p align="center"> <strong>Criterio conductual 3</strong></p>
                          <p style="font-weight:normal">Fijar objetivos en concordancia con los objetivos estratégicos de la organización para cumplir con las tareas.
                          <br><br><br><br>
                        
                          </p>
				          				
        			     </div>
                         
                         <!--<div class="col-sm-4">
	          			  
                          <p align="center"><strong>Acciones</strong></p>
                          <p>1) Actuar de manera eficiente frente a los obstáculos e imprevistos.</p>
                          <p>2) Reconocer mi responsabilidad por aciertos y errores cometidos.</p>
                          <p>3) Asumir mi compromiso con los objetivos de la organización. </p>
				          				
        			     </div> -->
                         
                         <div class="col-sm-8">
                          <label class="col-sm-5 control-label" style="text-align:center">Acciones</label>
                          
                         </div>
                         
                         
                         <div class="col-sm-8">
	          			  
                         <!-- <p align="center"><strong>Acciones</strong></p>-->
                         
                           <label class="col-sm-6 control-label" style="font-weight:normal">1) Diseñar y utilizar indicadores de gestión para medir y comparar los resultados obtenidos.</label>
                            
                            
                          
                             <div class="col-sm-2">
                            <input type="date" style=" color:#666666" name="res_3_1" value="<?php echo $res_3_1?>">
                             </div>
                          </div>
                          
                           
                           <div class="col-sm-8">
                           <label class="col-sm-6 control-label" style="font-weight:normal">2) Resolver adecuadamente y a tiempo situaciones problemáticas que requieren modificaciones, a fin de poder alcanzar el desempeño (personal y grupal) esperado.</label>
                           <div class="col-sm-2">
                            <input type="date" style=" color:#666666" name="res_3_2" value="<?php echo $res_3_2?>">
                             </div>
                           </div>
                           
                           <div class="col-sm-8">
                           <label class="col-sm-6 control-label" style="font-weight:normal">3) Capacitar, entrenar y dar orientación a quienes me lo solicitan, con el fin de mejorar el nivel de desempeño de mis compañeros de trabajo.</label>
                           <div class="col-sm-2">
                            <input type="date" style=" color:#666666" name="res_3_3" value="<?php echo $res_3_3?>">
                             </div>		
        			     </div> 
                         <div class="col-sm-4">
                          <label class="col-sm-1 control-label" style="text-align:center"></label>
                          
                         </div>
                         <div class="col-sm-8">
                           <label class="col-sm-6 control-label" style="font-weight:normal">4) Trabajar con objetivos claramente establecidos, realistas y desafiantes.</label>
                           <div class="col-sm-2">
                            <input type="date" style=" color:#666666" name="res_3_4" value="<?php echo $res_3_4?>">
                             </div>		
        			     </div> 
                        
	      			</div>                
                  </div>
<!-- Fin fila-->                  

<!-- Nueva fila -->
<div class="login-box-body quest_container quest_container_2" data-id="1" style="margin-bottom:30px;">
<div class="row"  >
                    <div class="col-sm-1">
                          <label class="col-sm-1 control-label" style="text-align:center"></label>
                          
                         </div>
	        			<div class="col-sm-3" >
	          			  
                          <p align="center"> <strong>Criterio conductual 4</strong></p>
                          <p style="font-weight:normal">Siempre va un paso más adelante en el camino de los objetivos fijados con actitud comprometida, preocupado por los resultados globales de la empresa.
                          <br><br><br><br>
                          </p>
				          				
        			     </div>
                         
                         <!--<div class="col-sm-4">
	          			  
                          <p align="center"><strong>Acciones</strong></p>
                          <p>1) Actuar de manera eficiente frente a los obstáculos e imprevistos.</p>
                          <p>2) Reconocer mi responsabilidad por aciertos y errores cometidos.</p>
                          <p>3) Asumir mi compromiso con los objetivos de la organización. </p>
				          				
        			     </div> -->
                         
                         <div class="col-sm-8">
                          <label class="col-sm-5 control-label" style="text-align:center">Acciones</label>
                          
                         </div>
                         
                         
                         <div class="col-sm-8">
	          			  
                         <!-- <p align="center"><strong>Acciones</strong></p>-->
                         
                           <label class="col-sm-6 control-label" style="font-weight:normal">1) Promover el mejoramiento de la calidad.</label>
                            
                            
                          
                             <div class="col-sm-2">
                            <input type="date" style=" color:#666666" name="res_4_1" value="<?php echo $res_4_1?>">
                             </div>
                          </div>
                          
                           
                           <div class="col-sm-8">
                           <label class="col-sm-6 control-label" style="font-weight:normal">2) Impulsar la satisfacción del cliente interno y externo y las ventas.</label>
                           <div class="col-sm-2">
                            <input type="date" style=" color:#666666" name="res_4_2" value="<?php echo $res_4_2?>">
                             </div>
                           </div>
                           
                           <div class="col-sm-8">
                           <label class="col-sm-6 control-label" style="font-weight:normal">3) ctuar de manera proactiva al realizar cambios y mejoras en los métodos de trabajo.</label>
                           <div class="col-sm-2">
                            <input type="date" style=" color:#666666" name="res_4_3" value="<?php echo $res_4_3?>">
                             </div>		
        			     </div> 
                         
                         
                        
	      			</div>                
                  </div>
<!-- Fin fila-->  
      <!-- enviar  -->
            <!-- 
              <div class="box-footer">
              <div class="col-sm-6">
                <!--<button type="reset" class="btn btn-default">Cancelar</button>-
                <button type="submit" class="btn btn-info pull-right">Guardar</button>
              </div>  
              </div>           
                    -->              
	    		</form>
	  		<!--</div> -->
            <?php
		     }
  	        ?>	
		</div>
		<script src="https://telcelevaluaciones.softandgo.com/plugins/jQuery/jQuery-2.2.0.min.js"></script>
		<script src="https://telcelevaluaciones.softandgo.com/js/bootstrap.min.js"></script>
		<script src="https://telcelevaluaciones.softandgo.com/plugins/iCheck/icheck.min.js"></script>
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
