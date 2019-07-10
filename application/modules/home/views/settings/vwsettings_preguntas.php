<style type="text/css">
	.pregunta {
		border: 1px solid #000;
		border-radius: 8px;
	}
	.respuesta {
		border: 1px solid #333;
		border-radius: 8px;
		margin: 15px;
	}
</style>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Configuración <small>Preguntas y respuestas</small></h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="#">Configuración</a></li>
			<li class="active">Preguntas y respuestas</li>
		</ol>
	</section>
	<!-- Main content -->
	<section id="main_content" class="content">
		<!-- /.row -->
		<div class="row">
			<div class="col-md-3">
				<div id="wait" style="display:none;" class="box box-warning box-solid">
					<div class="box-header">
						<h3 class="box-title title">Guardando</h3>
						<div class="box-tools pull-right"><button type="button" class="btn btn-box-tool close_wait"><i class="fa fa-close"></i></button></div>
					</div>
					<div class="box-body body">Por favor espere</div>
					<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Configuración de preguntas y respuestas</h3>
					</div>
					<form action="" method="post" id="form" name="form" role="form" enctype="multipart/form-data">
						<div class="box-body">
							<div class="form-group col-md-4">
								<label>Elegir Cuestionario</label>
								<select id="cuestionarios" class="form-control">
									<option value="">Seleccionar un cuestionario</option>
									<?php foreach ($controller->get_data("id, nombre", "cuestionarios", "date_end IS NULL") as $key => $value) { ?>
									<option value="<?php echo $value["id"]; ?>"><?php echo $value["nombre"]; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div id="preguntas_container"></div>
						<div class="box-footer">
							<button type="button" id="add_pregunta" class="btn btn-default">Agregar pregunta</button>
							<button type="submit" class="btn btn-primary">Enviar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		
		<div class="alert alert-danger alert-dismissible" id="mensaje_error" style="display:none;">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-ban"></i> Favor de revisar los siguientes registros:</h4>
			<span></span>
		  </div>
		  <div class="alert alert-success alert-dismissible" id="mensaje_success" style="display:none;">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-check"></i> Los siguientes registros se insertaron correctamente:</h4>
			<span></span>
		  </div>
	</section>
	</div>
