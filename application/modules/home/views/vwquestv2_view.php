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
      button.fs-submit {
        background-color: #0864ad !important;
        color: #fff !important;
      }
      button.fs-submit:hover {
        background: #a7beed !important;
        color: #333 !important;
      }
      .ac-custom input, .ac-custom label {
        cursor: default;
      }
    </style>
	</head>
	<body>
    <div id="actual_time" data-time="<?= $actual_time; ?>"></div>
		<div class="container">
			<section>
        <form id="myform" class="ac-custom ac-radio ac-fill" data-id="<?= $id_cuestionario; ?>" autocomplete="off">
          <?php
            $aciertos = $controller->get_data_from_query("SELECT COUNT(*) AS num FROM historial_preguntas WHERE idLog='$id_log' AND idRespuesta IN (SELECT id FROM respuestas WHERE is_correct=1);");
            if ($controller !== FALSE) {
              $aciertos = $aciertos[0];
              $aciertos = $aciertos["num"];
            } else $aciertos = 0;
            $totales = $controller->get_data_from_query("SELECT COUNT(*) AS num FROM historial_preguntas WHERE idLog='$id_log';");
            if ($totales !== FALSE) {
              $totales = $totales[0];
              $totales = $totales["num"];
            } else $totales = 1;
          ?>
					<h3 class="aciertos">
            ACIERTOS: <?= $aciertos ?> DE <?= $totales ?>
          </h3><br clear="all">
					<h3 class="aciertos">
            CALIFICACIÓN: <?php $calif = $aciertos > 0 ?
              (number_format(floatval(($aciertos * 10) / ($totales)), 2)) :
              number_format(0, 2);
              echo $calif;
            ?>&nbsp;
            <img src="<?= base_url() ?>img/calificacion_<?= floatval($calif) > 5.9 ? 'pos' : 'neg'; ?>.png" width="30px">
          </h3><br clear="all">
            <?php
            $data = $controller->get_data("*", "preguntas", "idCuestionario = '$id_cuestionario' AND date_end IS NULL", "id ASC");
            if ($data !== FALSE) {
              foreach($data AS $e => $key) { ?>
                <h2>
                  <?= html_entity_decode($key["nombre"]) ?>
                </h2>
                <ul class="ul_r">
                  <?php
                  $idRespuesta = $controller->get_data("idRespuesta", "historial_preguntas", "idPregunta='".$key["id"]."' AND idLog='$id_log' AND idUsuario='$user'","","","1");
                  if ($idRespuesta !== FALSE) {
                    $idRespuesta = $idRespuesta[0];
                    $idRespuesta = $idRespuesta["idRespuesta"];
                  } else $idRespuesta = 0;
                  $data_child = $controller->get_data("id, nombre", "respuestas", "idPregunta = '".$key["id"]."' AND date_end IS NULL");
                  if($data_child !== FALSE) {
                    foreach($data_child AS $i => $item) {
                      if (strlen($item["nombre"]) > 0) {
                        ?>
                        <li class="li_r">
                          <input
                            data-parent="<?= $key["id"] ?>"
                            value="<?= $item["id"] ?>"
                            type="radio"
                            name="r<?= $key['id'] ?>"
                            id="r<?= $item['id'] ?>"
                            class="r"
                            disabled
                            <?= intval($idRespuesta) === intval($item["id"]) ? "checked data-selected='1'" : "data-selected='0'" ?>
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
					<button class="fs-submit regresar_menu" type="button" data-href="<?= base_url() ?>">Cerrar revisión</button>
				</form>
			</section>
		</div><!-- /container -->
    <script src="<?= base_url() ?>js/new/svgcheckbx.js"></script>
    <script>
      $(document).ready(function () {
				$(".regresar_menu").on("click",function () {
					window.location = $(this).attr('data-href');
				});
			});
    </script>
	</body>
</html>