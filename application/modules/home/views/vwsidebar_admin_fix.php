
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
<?php if($carga_usuarios){ ?>
	<script>
		$(document).ready(function(){
			$("#mensaje_error_edicion").hide();
			$("#mensaje_success_edicion").hide();
			$("#cancelar_cambios").on("click",function(){
				$("#instructores_gral").val(0);
				$("#grupos_gral").val(0);
				$("#cursos_gral").val(0);
				$.each($("#example1").find(".editable"),function(i,item){
					if($(item).hasClass("active")){
						if(parseInt($(item).attr("data-original"))>0) $(item).find(".active_user").removeClass("label-danger").addClass("label-success").html("Activo");
						else $(item).find(".active_user").removeClass("label-success").addClass("label-danger").html("Inactivo");
					}else{
						var temp=$(item).find("p");
						temp.html(temp.attr("data-original"));
						if(temp.attr("data-idoriginal")!==undefined){
							temp.attr("data-id",temp.attr("data-idoriginal"));
						}
					}
				});
			});
			$("#select_all").on("click",function(){
				$(this).toggleClass("seleccionar");
				if($(this).hasClass("seleccionar")){
					$.each($("#example1").find(".select_user_checkbox"),function(i,item){
						$(item).prop("checked",false);
					});
					$(this).html("Seleccionar todos");
				}else{
					$.each($("#example1").find(".select_user_checkbox"),function(i,item){
						$(item).prop("checked",true);
					});
					$(this).html("Deseleccionar todos");
				}
			});
			$("#instructores_gral").on("change",function(){
				var id=parseInt($(this).val());
				var element=$(this).parent().parent();
				if(id>0){
					$.each(element.find("#grupos_gral option"),function(i,item){
						if(parseInt($(item).attr("data-idInstructor"))!=id && parseInt($(item).attr("data-idInstructor"))>0) $(item).hide();
						else $(item).show();
					});
				}else{
					$.each(element.find("#grupos_gral option"),function(i,item){
						$(item).show();
					});
				}
				$.each($("#example1").find(".select_user_checkbox"),function(i,item){
					if($(item).prop("checked")){
						$(item).parent().parent().find(".instructor p").html($("#instructores_gral option:selected").attr("data-nombre"));
						$(item).parent().parent().find(".instructor p").attr("data-id",id);
					}
				});
			});
			$("#grupos_gral").on("change",function(){
				var id=parseInt($(this).val());
				$.each($("#example1").find(".select_user_checkbox"),function(i,item){
					if($(item).prop("checked")){
						$(item).parent().parent().find(".grupo p").html($("#grupos_gral option:selected").text());
						$(item).parent().parent().find(".grupo p").attr("data-id",id);
					}
				});
			});
			$("#cursos_gral").on("change",function(){
				var id=parseInt($(this).val());
				$.each($("#example1").find(".select_user_checkbox"),function(i,item){
					if($(item).prop("checked")){
						$(item).parent().parent().find(".curso p").html($("#cursos_gral option:selected").text());
						$(item).parent().parent().find(".curso p").attr("data-id",$("#cursos_gral option:selected").attr("data-clave"));
					}
				});
			});
			$("#activar_usuarios").on("click",function(){
				$.each($("#example1").find(".select_user_checkbox"),function(i,item){
					if($(item).prop("checked")){
						$(item).parent().parent().find(".active .active_user").removeClass("label-danger").addClass("label-success").html("Activo");
					}
				});
			});
			$("#desactivar_usuarios").on("click",function(){
				$.each($("#example1").find(".select_user_checkbox"),function(i,item){
					if($(item).prop("checked")){
						$(item).parent().parent().find(".active .active_user").removeClass("label-success").addClass("label-danger").html("Inactivo");
					}
				});
			});
			$("#desactivar_todos_usuarios").on("click",function(){
				if(confirm("¿Realmente desea desactivar a todos los participantes actuales?")){
					$.post(window.url.base_url+"home/ctrhome/bloquear_todos_usuarios",{},function(resp){
						resp=JSON.parse(resp);
						if(resp.success!==false){
							$("#mensaje_error_edicion").hide();
							$("#mensaje_success_edicion").show();
							setTimeout(function(){
								$("#mensaje_error_edicion").hide();
								$("#mensaje_success_edicion").hide();
							}, 4000);
						}else{
							$("#mensaje_error_edicion").show();
							$("#mensaje_success_edicion").hide();
							setTimeout(function(){
								$("#mensaje_error_edicion").hide();
								$("#mensaje_success_edicion").hide();
							}, 4000);
						}
					});
				}
			});
			$("#save_cambios").on("click",function(){
				var users=Array();
				var x=0;
				$.each($("#example1").find(".select_user_checkbox"),function(i,item){
					if($(item).prop("checked")){
						var temp = Array();
						var j=0;
						temp[j++]=$(item).parent().parent().attr("data-id");
						temp[j++]=$(item).parent().parent().find(".nombre p").html();
						temp[j++]=$(item).parent().parent().find(".numero p").html();
						temp[j++]=$(item).parent().parent().find(".instructor p").attr("data-id");
						temp[j++]=$(item).parent().parent().find(".grupo p").attr("data-id");
						temp[j++]=$(item).parent().parent().find(".curso p").attr("data-id");
						temp[j++]=$(item).parent().parent().find(".grupo p").html();
						temp[j++]=$(item).parent().parent().find(".active .active_user").hasClass("label-success") ? 1 : 0;
						temp[j++]=$(item).parent().parent().find(".fecha p").html();
						temp[j++]=$(item).parent().parent().find(".change_status").val();
						users[x++]=temp;
					}
				});
				if(users.length>0){
					$.post(window.url.base_url+"home/ctrhome/guardar_edicion_usuarios",{data:users},function(resp){
						resp=JSON.parse(resp);
						if(resp.success!==false){
							$("#mensaje_error_edicion").hide();
							$("#mensaje_success_edicion").show();
							$.each($("#example1").find(".select_user_checkbox"),function(i,item){
								if($(item).prop("checked")){
									$(item).parent().parent().find(".nombre p").attr("data-original",$(item).parent().parent().find(".nombre p").html());
									$(item).parent().parent().find(".numero p").attr("data-original",$(item).parent().parent().find(".numero p").html());
									$(item).parent().parent().find(".instructor p").attr("data-idoriginal",$(item).parent().parent().find(".instructor p").attr("data-id"));
									$(item).parent().parent().find(".instructor p").attr("data-original",$(item).parent().parent().find(".instructor p").html());
									$(item).parent().parent().find(".grupo p").attr("data-idoriginal",$(item).parent().parent().find(".grupo p").attr("data-id"));
									$(item).parent().parent().find(".grupo p").attr("data-original",$(item).parent().parent().find(".grupo p").html());
									$(item).parent().parent().find(".curso p").attr("data-idoriginal",$(item).parent().parent().find(".curso p").attr("data-id"));
									$(item).parent().parent().find(".curso p").attr("data-original",$(item).parent().parent().find(".curso p").html());
									$(item).parent().parent().find(".active").attr("data-original",$(item).parent().parent().find(".active .active_user").hasClass("label-success") ? 1 : 0);
									$(item).parent().parent().find(".fecha p").attr("data-original",$(item).parent().parent().find(".fecha p").html());
								}
							});
							setTimeout(function(){
								$("#mensaje_error_edicion").hide();
								$("#mensaje_success_edicion").hide();
							}, 4000);
						}else{
							$("#mensaje_error_edicion").show();
							$("#mensaje_success_edicion").hide();
							setTimeout(function(){
								$("#mensaje_error_edicion").hide();
								$("#mensaje_success_edicion").hide();
							}, 4000);
						}
					});
				}
			});
			$("#eliminar_usuario").on("click",function(){
				if(confirm("¿Realmente desea eliminar los usuarios seleccionados?")){
					var temp=Array();
					$.each($("#example1").find(".select_user_checkbox"),function(i,item){
						if($(item).prop("checked")){
							temp[i]=$(item).parent().parent().attr("data-id");
						}
					});
					$.post(window.url.base_url+"home/ctrhome/eliminar_usuarios",{data:temp},function(resp){
						resp=JSON.parse(resp);
						location.reload();
					});
				}
			});
		});
	</script>
<?php } ?>
<!-- page script -->
		<script>
			$(document).ready(function(){
				//$("#mensaje_error").hide();
				//$("#mensaje_success").hide();
				$("#form_container").on("submit",function(e){
					e.preventDefault();
					$(".help-block").show();
					uploadFiles();
				});
				$("#form_container_users").on("submit",function(e){
					e.preventDefault();
					$(".help-block").show();
					uploadFilesUsers();
				});
				$("#form_container_grupos").on("submit",function(e){
					e.preventDefault();
					$(".help-block").show();
					uploadFilesGrupos();
				});
				$("#form_container_instructores").on("submit",function(e){
					e.preventDefault();
					$(".help-block").show();
					uploadFilesInstructores();
				});
				function uploadFilesInstructores(){
					var formData = new FormData(document.getElementById("form_container_instructores"));
				    $("#mensaje_error").hide();
					$("#mensaje_success").hide();
					$("#mensaje_error").find("span").html("");
					$("#mensaje_success").find("span").html("");
				    $.ajax({
				        url: window.url.base_url+'tools/ctrtools/doupload/file-5',
				        type: 'POST',
				        data:  formData,
				        mimeType:"multipart/form-data",
				        contentType: false,
				        cache: false,
				        processData:false,
				        success : function(data){
				            data=JSON.parse(data);
				            if(data.success!==false){
				                $.post(window.url.base_url+"home/ctrhome/upload_files_instructores",{data:data.result},function(result){
				                	result=JSON.parse(result);
				                	$(".help-block").hide();
				                	$.each(result.result,function(i,item){
				                		if(item.type!==false){
				                			$("#mensaje_success").show();
				                			$("#mensaje_success").find("span").append(item.msg+"<br>");
				                		}else{
				                			$("#mensaje_error").show();
				                			$("#mensaje_error").find("span").append(item.msg+"<br>");
				                		}
				                	});
				                });
				            }else{
				            	$("#mensaje_error").find("span").html("");
								$("#mensaje_success").find("span").html("");
				            	$("#mensaje_success").hide();
								$("#mensaje_error").show();
								alert(data.error);
				            }
				        },
				        error: function(data){
				            return false;
				        }
				    });
				}
				function uploadFilesGrupos(){
					var formData = new FormData(document.getElementById("form_container_grupos"));
				    $("#mensaje_error").hide();
					$("#mensaje_success").hide();
					$("#mensaje_error").find("span").html("");
					$("#mensaje_success").find("span").html("");
				    $.ajax({
				        url: window.url.base_url+'tools/ctrtools/doupload/file-5',
				        type: 'POST',
				        data:  formData,
				        mimeType:"multipart/form-data",
				        contentType: false,
				        cache: false,
				        processData:false,
				        success : function(data){
				            data=JSON.parse(data);
				            if(data.success!==false){
				                $.post(window.url.base_url+"home/ctrhome/upload_files_grupos",{data:data.result},function(result){
				                	result=JSON.parse(result);
				                	$(".help-block").hide();
				                	$.each(result.result,function(i,item){
				                		if(item.type!==false){
				                			$("#mensaje_success").show();
				                			$("#mensaje_success").find("span").append(item.msg+"<br>");
				                		}else{
				                			$("#mensaje_error").show();
				                			$("#mensaje_error").find("span").append(item.msg+"<br>");
				                		}
				                	});
				                });
				            }else{
				            	$("#mensaje_error").find("span").html("");
								$("#mensaje_success").find("span").html("");
				            	$("#mensaje_success").hide();
								$("#mensaje_error").show();
								alert(data.error);
				            }
				        },
				        error: function(data){
				            return false;
				        }
				    });
				}
				function uploadFiles(){
				    var formData = new FormData(document.getElementById("form_container"));
				    $("#mensaje_error").hide();
					$("#mensaje_success").hide();
					$("#mensaje_error").find("span").html("");
					$("#mensaje_success").find("span").html("");
				    $.ajax({
				        url: window.url.base_url+'tools/ctrtools/doupload/file-5',
				        type: 'POST',
				        data:  formData,
				        mimeType:"multipart/form-data",
				        contentType: false,
				        cache: false,
				        processData:false,
				        success : function(data){
				            data=JSON.parse(data);
				            if(data.success!==false){
				                $.post(window.url.base_url+"home/ctrhome/upload_files",{data:data.result},function(result){
				                	result=JSON.parse(result);
				                	$(".help-block").hide();
				                	$.each(result.result,function(i,item){
				                		if(item.type!==false){
				                			$("#mensaje_success").show();
				                			$("#mensaje_success").find("span").append(item.msg+"<br>");
				                		}else{
				                			$("#mensaje_error").show();
				                			$("#mensaje_error").find("span").append(item.msg+"<br>");
				                		}
				                	});
				                });
				            }else{
				            	$("#mensaje_error").find("span").html("");
								$("#mensaje_success").find("span").html("");
				            	$("#mensaje_success").hide();
								$("#mensaje_error").show();
								alert(data.error);
				            }
				        },
				        error: function(data){
				            return false;
				        }
				    });
				}
				function uploadFilesUsers(){
					var formData = new FormData(document.getElementById("form_container_users"));
					$("#mensaje_error").hide();
					$("#mensaje_success").hide();
					$("#mensaje_error").find("span").html("");
					$("#mensaje_success").find("span").html("");
					$.ajax({
						url: window.url.base_url+'tools/ctrtools/doupload/file-5',
						type: 'POST',
						data:  formData,
						mimeType:"multipart/form-data",
						contentType: false,
						cache: false,
						processData:false,
						success : function(data){
							data=JSON.parse(data);
							if(data.success!==false){
								$.post(window.url.base_url+"home/ctrhome/upload_files_users",{data:data.result},function(result){
									result=JSON.parse(result);
									$(".help-block").hide();
									$.each(result.result,function(i,item){
				                		if(item.type!==false){
				                			$("#mensaje_success").show();
				                			$("#mensaje_success").find("span").append(item.msg+"<br>");
				                		}else{
				                			$("#mensaje_error").show();
				                			$("#mensaje_error").find("span").append(item.msg+"<br>");
				                		}
				                	});
								});
							}else{
								$("#mensaje_error").find("span").html("");
								$("#mensaje_success").find("span").html("");
								$("#mensaje_success").hide();
								$("#mensaje_error").show();
								alert(data.error);
							}
						},
						error: function(data){
							return false;
						}
					});
				}
			});
  			$(function () {
    			$("#example1").DataTable();
    			$('#example2').DataTable({
      				"paging": true,
      				"lengthChange": false,
      				"searching": false,
      				"ordering": true,
      				"info": true,
      				"autoWidth": false
    			});
  			});
		</script>
	</body>
</html>
