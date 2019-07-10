	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
	  		<h1>Carga de archivos <small>grupos</small></h1>
	  		<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="#">Carga de archivos</a></li>
				<li class="active">Grupos</li>
	  		</ol>
		</section>
		<!-- Main content -->
		<section class="content">
	  		<!-- /.row -->
	  		<div class="row">
				<div class="col-md-12">
					<div class="box box-primary">
						<div class="box-header with-border">
			  				<h3 class="box-title">Carga de grupos</h3>
						</div>
						<form action="" method="post" id="form_container_grupos" name="form_container" role="form" enctype="multipart/form-data">
			  				<div class="box-body">
								<div class="form-group">
				  					<label for="exampleInputFile">Subir archivo</label>
				  					<input type="file" name="file-5[]" id="file-5" class="inputfile inputfile-4" data-multiple-caption="{count} archivos seleccionados" multiple />
				  					<p class="help-block" style="display:none;"><img src="<?php echo base_url(); ?>img/loader.GIF"></p>
								</div>
			  				</div>
			  				<div class="box-footer">
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
