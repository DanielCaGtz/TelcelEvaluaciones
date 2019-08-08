<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
    <meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<title>Telcel | Cuestionario</title>
		<script type="text/javascript">window.url = {base_url:"<?= nombre_ruta_host(); ?>"};</script>
		<link rel="shortcut icon" href="<?= base_url() ?>img/icon.png">
		<link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/new/normalize.css" />
		<link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/new/demo.css" />
		<link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/new/component.css" />
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/component.css" />
		<link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/font-awesome.min.css">
    <script src="<?= base_url() ?>js/jquery-1.11.3.js"></script>
    <script src="<?= base_url() ?>plugins/jquery.countdown-2.2.0/jquery.countdown.js"></script>
    <script src="<?= base_url() ?>js/new/modernizr.custom.js"></script>
    <style>
      .fs-title{text-align: justify;}
      .codrops-icon span{color:white !important;}
      .fs-title{
        background: rgba(255, 255, 255, 0.3);
        position: inherit !important;
        width: 100% !important;
      }
      .aciertos{
        float: right;
        background: rgba(255, 255, 255, 0.3);
        padding: 12px;
        margin-top: 0px;
      }
      .close_preguntas{float: right;font-size: 25px;margin: 10px;position: relative;}
      .titles {
        font-size: 20px;
        line-height: 40px;
      }
      .fa-childs {
        margin: 5px;
      }
      button.fs-submit {
        background-color: #0864ad !important;
        color: #fff !important;
      }
      button.fs-submit:hover {
        background: #a7beed !important;
        color: #333 !important;
      }
    </style>
	</head>
	<body>
    <div id="actual_time" data-time="<?= $actual_time; ?>"></div>
		<div class="container">
      <div class="fs-form-wrap" id="fs-form-wrap">
        <div class="fs-title">
          <h1><?= $nombre_cuestionario; ?></h1>
          <div class="titles">
            <a class="fa fa-arrow-left confirmar_alerta" href="<?= base_url(); ?>"><span class="fa-childs">Regresar al menú principal</span></a><br>
            <a class="fa fa-info-circle" href="#"><span class="fa-childs">Responde a cada una de las preguntas. Recuerda que tienes un tiempo límite para responder el cuestionario.</span></a><br>
            <span id="clock"></span>
          </div>
        </div>
      </div>
			<section>
        <form id="myform" class="ac-custom ac-radio ac-fill" data-id="<?= $id_cuestionario; ?>" autocomplete="off">
          <?php
            $data = $controller->get_data("*", "preguntas", "idCuestionario = '$id_cuestionario' AND date_end IS NULL", "id ASC");
            if ($data !== FALSE) {
              foreach($data AS $e => $key) { ?>
                <h2>
                  <?= ($e + 1) . '.- ' . html_entity_decode($key["nombre"]) ?>
                </h2>
                <ul class="ul_r">
                  <?php
                  # $letters = array(0 => "a)", 1 => "b)", 2 => "c)", 3 => "d)");
                  $data_child = $controller->get_data("id, nombre", "respuestas", "idPregunta = '".$key["id"]."' AND date_end IS NULL");
                  if($data_child !== FALSE) {
                    foreach($data_child AS $i => $item) {
                      if (strlen($item["nombre"]) > 0) {
                        $temp = 0;
                        if (array_key_exists('P'.$key['id'], $data_temp)) $temp = $data_temp['P'.$key['id']];
                        ?>
                        <li class="li_r">
                          <input
                            data-parent="<?= $key["id"] ?>"
                            value="<?= $item["id"] ?>"
                            type="radio"
                            name="r<?= $key['id'] ?>"
                            id="r<?= $item['id'] ?>"
                            class="r"
                            <?=
                              $temp === intval($item['id']) ||
                              (array_key_exists('P'.$key["id"], $data_temp) && $data_temp['P'.$key['id']] == $item['id']) ?
                                "checked data-selected='1'" :
                                "data-selected='0'"
                            ?>
                            >
                          <label for="r<?= $item['id'] ?>"><?= $item["nombre"] ?></label>
                        </li>
                  <?php
                      }
                    }
                  }
                  ?>
                </ul>
              <?php
              }
            }
            ?>
					<button class="fs-submit" id="submit_button" type="submit">Finalizar cuestionario</button>
				</form>
			</section>
		</div><!-- /container -->
    <script src="<?= base_url() ?>js/new/svgcheckbx.js"></script>
    <script>
      $(document).ready(function () {
				var time_ = new Date().getTime() + parseInt($("#actual_time").attr("data-time")) * 1000;
				window.onbeforeunload = function() {
  				return "¿Desea salir de la página?";
				}
				$("#clock").countdown(time_, function(event) {
					$(this).html(event.strftime('Tiempo restante: <span>%H:%M:%S</span>'));
				}).on('finish.countdown', function() {
					window.onbeforeunload = function() {};
					save_quest();
				});
				function save_quest () {
					var id = $("#myform").attr("data-id");
					var data = {};
          window.onbeforeunload = function() {};
					$.each($("#myform .ul_r"), function(i, item) {
						var temp = {};
						temp["idPregunta"] = $(item).find('input[type=radio]:checked').attr("data-parent");
						temp["idRespuesta"] = $(item).find('input[type=radio]:checked').val();
						data[i] = temp;
					});
					// console.log(data);
					$.post(window.url.base_url + "home/ctrhome/save_quest", {data: data, id: id},function (resp) {
						resp = JSON.parse(resp);
						if (resp.success !== false) {
							window.location.replace(window.url.base_url);
						} else {
              alert(resp.msg);
              $("#submit_button").prop('disabled', false);
            }
					});
				}

				$(".regresar_menu").on("click",function () {
					window.location = $(this).attr('data-href');
				});

				$(".r").on("change", function () {
					var id = $(this).val();
					var parent = $(this).attr("data-parent");
					$.post(window.url.base_url + "home/ctrhome/save_pregunta_temp", {id: id, parent: parent}, function (resp) {
						// resp = JSON.parse(resp);
						// console.log(resp);
					});
				});
				$(".confirmar_alerta").on("click", function (e) {
					e.preventDefault();
    			if (confirm("Hacer esto cancelará el envío del cuestionario. ¿Estás de acuerdo?"))
            window.location = $(this).attr('href');
				});
				$("#myform").on("submit", function(e) {
					$("#submit_button").prop('disabled', true);
					e.preventDefault();
					save_quest();
				});
			});
    </script>
	</body>
</html>