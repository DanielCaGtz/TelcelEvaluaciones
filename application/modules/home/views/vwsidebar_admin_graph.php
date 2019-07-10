
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
	<!-- Create the tabs -->
	<ul class="nav nav-tabs nav-justified control-sidebar-tabs">
	  <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
	  <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
	</ul>
	<!-- Tab panes -->
	<div class="tab-content">
	  <!-- Home tab content -->
	  <div class="tab-pane" id="control-sidebar-home-tab">
		<h3 class="control-sidebar-heading">Recent Activity</h3>
		<ul class="control-sidebar-menu">
		  <li>
			<a href="javascript:void(0)">
			  <i class="menu-icon fa fa-birthday-cake bg-red"></i>

			  <div class="menu-info">
				<h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

				<p>Will be 23 on April 24th</p>
			  </div>
			</a>
		  </li>
		  <li>
			<a href="javascript:void(0)">
			  <i class="menu-icon fa fa-user bg-yellow"></i>

			  <div class="menu-info">
				<h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

				<p>New phone +1(800)555-1234</p>
			  </div>
			</a>
		  </li>
		  <li>
			<a href="javascript:void(0)">
			  <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

			  <div class="menu-info">
				<h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

				<p>nora@example.com</p>
			  </div>
			</a>
		  </li>
		  <li>
			<a href="javascript:void(0)">
			  <i class="menu-icon fa fa-file-code-o bg-green"></i>

			  <div class="menu-info">
				<h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

				<p>Execution time 5 seconds</p>
			  </div>
			</a>
		  </li>
		</ul>
		<!-- /.control-sidebar-menu -->

		<h3 class="control-sidebar-heading">Tasks Progress</h3>
		<ul class="control-sidebar-menu">
		  <li>
			<a href="javascript:void(0)">
			  <h4 class="control-sidebar-subheading">
				Custom Template Design
				<span class="label label-danger pull-right">70%</span>
			  </h4>

			  <div class="progress progress-xxs">
				<div class="progress-bar progress-bar-danger" style="width: 70%"></div>
			  </div>
			</a>
		  </li>
		  <li>
			<a href="javascript:void(0)">
			  <h4 class="control-sidebar-subheading">
				Update Resume
				<span class="label label-success pull-right">95%</span>
			  </h4>

			  <div class="progress progress-xxs">
				<div class="progress-bar progress-bar-success" style="width: 95%"></div>
			  </div>
			</a>
		  </li>
		  <li>
			<a href="javascript:void(0)">
			  <h4 class="control-sidebar-subheading">
				Laravel Integration
				<span class="label label-warning pull-right">50%</span>
			  </h4>

			  <div class="progress progress-xxs">
				<div class="progress-bar progress-bar-warning" style="width: 50%"></div>
			  </div>
			</a>
		  </li>
		  <li>
			<a href="javascript:void(0)">
			  <h4 class="control-sidebar-subheading">
				Back End Framework
				<span class="label label-primary pull-right">68%</span>
			  </h4>

			  <div class="progress progress-xxs">
				<div class="progress-bar progress-bar-primary" style="width: 68%"></div>
			  </div>
			</a>
		  </li>
		</ul>
		<!-- /.control-sidebar-menu -->

	  </div>
	  <!-- /.tab-pane -->
	  <!-- Stats tab content -->
	  <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
	  <!-- /.tab-pane -->
	  <!-- Settings tab content -->
	  <div class="tab-pane" id="control-sidebar-settings-tab">
		<form method="post">
		  <h3 class="control-sidebar-heading">General Settings</h3>

		  <div class="form-group">
			<label class="control-sidebar-subheading">
			  Report panel usage
			  <input type="checkbox" class="pull-right" checked>
			</label>

			<p>
			  Some information about this general settings option
			</p>
		  </div>
		  <!-- /.form-group -->

		  <div class="form-group">
			<label class="control-sidebar-subheading">
			  Allow mail redirect
			  <input type="checkbox" class="pull-right" checked>
			</label>

			<p>
			  Other sets of options are available
			</p>
		  </div>
		  <!-- /.form-group -->

		  <div class="form-group">
			<label class="control-sidebar-subheading">
			  Expose author name in posts
			  <input type="checkbox" class="pull-right" checked>
			</label>

			<p>
			  Allow the user to show his name in blog posts
			</p>
		  </div>
		  <!-- /.form-group -->

		  <h3 class="control-sidebar-heading">Chat Settings</h3>

		  <div class="form-group">
			<label class="control-sidebar-subheading">
			  Show me as online
			  <input type="checkbox" class="pull-right" checked>
			</label>
		  </div>
		  <!-- /.form-group -->

		  <div class="form-group">
			<label class="control-sidebar-subheading">
			  Turn off notifications
			  <input type="checkbox" class="pull-right">
			</label>
		  </div>
		  <!-- /.form-group -->

		  <div class="form-group">
			<label class="control-sidebar-subheading">
			  Delete chat history
			  <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
			</label>
		  </div>
		  <!-- /.form-group -->
		</form>
	  </div>
	  <!-- /.tab-pane -->
	</div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
	   immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
		<script src="<?php echo base_url(); ?>plugins/jQuery/jquery-2.2.3.min.js"></script>
		<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url(); ?>plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url(); ?>plugins/datatables/dataTables.bootstrap.min.js"></script>
		<script src="<?php echo base_url(); ?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
		<script src="<?php echo base_url(); ?>plugins/fastclick/fastclick.js"></script>
		<script src="<?php echo base_url(); ?>dist/js/app.min.js"></script>
		<script src="<?php echo base_url(); ?>dist/js/demo.js"></script>
		<script>
			$(document).ready(function(){
				function open_new_tab(url_){
					var win = window.open(url_, '_blank');
  					win.focus();
				}
				$(".get_grafica_individual, .get_grafica_grupo, .get_grafica_despacho, .get_grafica_grupo_completo").on("click",function(){
					var date_start=$(this).parent().parent().parent().find(".date_start").val();
					var date_end=$(this).parent().parent().parent().find(".date_end").val();
					var primer=$(this).parent().parent().parent().find(".first").val();
					var segundo=$(this).parent().parent().parent().find(".second").val();
					var pre_post=$(this).parent().parent().parent().find("input[name=type_test]:checked").val();
					var quest_type=$(this).parent().parent().parent().find("input[name=type_graph]:checked").val();
					var type=$(this).attr("data-type");
					$.post(window.url.base_url+"home/ctrhome/set_graph_data",{type:type,date_start:date_start,date_end:date_end,primer:primer,segundo:segundo,pre_post:pre_post,quest_type:quest_type},function(resp){
						open_new_tab(window.url.base_url+'graficar');
					});
				});
				$("input[name=type_new_graph]").on("change",function(){
					if(parseInt($(this).parent().find("input[name=type_new_graph]:checked").val())==2)
						$("#despachos_div").show();
					else
						$("#despachos_div").hide();
				});
				$(".get_grafica_general").on("click",function(){
					var type_new_graph=$(this).parent().parent().parent().find("input[name=type_new_graph]:checked").val();
					var quest_type=$(this).parent().parent().parent().find("input[name=type_graph]:checked").val();
					var type_test=$(this).parent().parent().parent().find("input[name=type_test]:checked").val();
					var quests=$(this).parent().parent().parent().find(".quests").val();
					var despachos=$(this).parent().parent().parent().find(".despachos").val();
					$.post(window.url.base_url+"home/ctrgraph/set_graph_data_new",{type_new_graph:type_new_graph, quest_type:quest_type, type_test:type_test, quests:quests, despachos:despachos},function(resp){
						open_new_tab(window.url.base_url+'grafica_general');
					});
				});
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
				/*
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
				}*/
			});
		</script>
	</body>
</html>
