<?php

class ctrTest extends MX_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('login/mdllogin');
		date_default_timezone_set('America/Mexico_City');
	}
	
	public function test(){
		$respuestas=$this->mdllogin->getDataFromQuery("SELECT * FROM preguntas WHERE idCuestionario=2;");
		$data=$this->mdllogin->getDataFromQuery("SELECT (SELECT id from log_historial WHERE idUsuario=ppal.id AND pre_post=0 AND idCuestionario=2) AS idLog, ppal.id FROM `usuarios` ppal where ppal.idGrupo IN (SELECT id from grupos where date_to=DATE(NOW())) AND ppal.id IN (SELECT DISTINCT idUsuario FROM log_historial WHERE pre_post=0 AND id NOT IN (SELECT DISTINCT idLog FROM historial_preguntas))");
		foreach($data AS $e=>$key){
			foreach($respuestas AS $i=>$resp){
				$data_insert=array(
						"idPregunta"	=> $resp["id"],
						"idRespuesta"	=> 0,
						"idUsuario"		=> $key["id"],
						"idLog"			=> $key["idLog"]
				);
				#$this->mdllogin->insertData($data_insert,"historial_preguntas");
			}
		}
	}
	
}

?>