$(document).ready(function(){
	function show_wait(show,title,title2,over){
		$("#wait").fadeOut(800,function(){
			$(this).removeClass("box-danger").removeClass("box-success").removeClass("box-warning").addClass(show);
			$(this).find(".title").html(title);
			$(this).find(".body").html(title2);
			$(this).show();
			$('html, body').animate({scrollTop: $("#wait").offset().top}, 1000);
			if(parseInt(over)>0) $(this).find(".overlay").show(); else $(this).find(".overlay").hide();
			$(this).fadeIn(900);
		});
	}

	function build_pregunta (id = 0, pregunta = '', num = 0) {
		let builder =
			`<div class="box box-warning pregunta col-md-4" data-id="${id}">
				<div class="box-header">
					<h3 class="box-title">Pregunta #${num}</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
					</div>
				</div>
				<div class="box-body">
					<textarea class="form-control pregunta_name">${pregunta}</textarea><br clear="all">
					<button type="button" class="btn btn-default add_respuesta">Agregar respuesta</button>
					<div class="respuestas_container"></div>
				</div>
			</div>`;
		return builder;
	}

	function build_respuesta (id = 0, respuesta = '', is_checked = false, num = 0) {
		const letras = {0: '', 1: 'A)', 2: 'B)', 3: 'C)', 4: 'D)'};
		let builder =
			`<div class="box-body respuesta" data-id="${id}">
				<div class="form-group">
					<label>Respuesta ${letras[num]}:</label>
					<button type="button" class="btn btn-box-tool remove_respuesta"><i class="fa fa-times"></i></button>
					<textarea class="form-control respuesta_name">${respuesta}</textarea>
					<div class="col-sm-10">
						<div class="checkbox">
							<label><input ` + (is_checked ? 'checked' : '') + ` type="checkbox" class="is_correct"> Marcar como respuesta correcta</label>
						</div>
					</div>
				</div>
			</div>`;
		return builder;
	}

	$("#cuestionarios").on("change", function() {
		const id = $(this).val();
		if (id > 0) {
			$.post(window.url.base_url + "home/ctrsettings/get_preguntas_by_cuestionario_id", {id : id}, function (resp) {
				resp = JSON.parse(resp);
				if (resp.success && resp.result) {
					$.each(resp.result, function (i, item) {
						$("#preguntas_container").append(build_pregunta(item.id, item.nombre, (i + 1)));
					});

					$.each($("#preguntas_container").find(".pregunta"), function (i, item) {
						const idPregunta = $(item).attr("data-id");
						if (idPregunta > 0) {
							$.post(window.url.base_url + "home/ctrsettings/get_respuestas_by_pregunta_id", {id : idPregunta}, function (response) {
								response = JSON.parse(response);
								if (response.success && response.result) {
									$.each(response.result, function (e, key) {
										$(item).find(".respuestas_container").append(build_respuesta(key.id, key.nombre, parseInt(key.is_correct, 10) === 1, (e + 1)));
									});
								}
							});
						}
					});
				}
			});
		}
		return false;
	});

	$("#main_content").on("click", ".add_respuesta", function () {
		$(this).parent().find(".respuestas_container").append(build_respuesta());
	});

	$("#main_content").on("click", ".remove_respuesta", function () {
		$(this).parent().parent().remove();
	});

	$("#add_pregunta").on("click", function () {
		$("#preguntas_container").append(build_pregunta());
	});

	$("#form").on("submit", function (e) {
		e.preventDefault();
		if (parseInt($("#cuestionarios").val()) > 0 && confirm("¿Realmente desea guardar las preguntas?")) {
			show_wait("box-warning","Guardando","Por favor espere",1);
			var preguntas = new Array();
			$.each($("#preguntas_container").find(".pregunta"), function(i, item) {
				var temp_pregunta = new Array();
				temp_pregunta[0] = $(item).attr("data-id");
				temp_pregunta[1] = $(item).find(".pregunta_name").val();
				var respuestas = new Array();
				$.each($(item).find(".respuestas_container").find(".respuesta"), function (e, key) {
					var temp_respuesta = new Array();
					temp_respuesta[0] = $(key).attr("data-id");
					temp_respuesta[1] = $(key).find(".respuesta_name").val();
					temp_respuesta[2] = $(key).find(".is_correct").is(":checked") ? 1 : 0;
					respuestas.push(temp_respuesta);
				});
				temp_pregunta[2] = respuestas;
				preguntas.push(temp_pregunta);
			});
			var formData = new FormData(document.getElementById("form"));
			formData.append('preguntas', JSON.stringify(preguntas));
			formData.append('idCuestionatio', $("#cuestionarios").val());
			$.ajax({
				url: window.url.base_url+'home/ctrsettings/save_preguntas_y_respuestas',
				type: 'POST',
				data:  formData,
				mimeType:"multipart/form-data",
				contentType: false,
				cache: false,
				processData:false,
				success : function(resp){
					resp = JSON.parse(resp);
					if (resp.success)
						show_wait("box-success", "Éxito", "Las preguntas se han guardado exitosamente", 0);
					else
						show_wait("box-danger", "ERROR", resp.msg, 0);
				},
				error: function(data) {
					show_wait("box-danger", "ERROR", resp.msg, 0);
					return false;
				}
			});
		}
	})
});
