<?php

class ctrSettings extends MX_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('login/mdllogin');
		date_default_timezone_set('America/Mexico_City');
		include FILE_ROUTE_FULL."addons/phpexcel/Classes/PHPExcel.php";
		include FILE_ROUTE_FULL."addons/phpexcel/Classes/PHPExcel/Writer/Excel2007.php";
		include FILE_ROUTE_FULL."addons/phpexcel/Classes/PHPExcel/IOFactory.php";
	}

	public function vwedit_preguntas(){
		if ($this->session->userdata("id") && $this->get_permission($this->session->userdata("id"), "edit_preguntas")) {
			$data["controller"] = $this;
			$permisos = $this->get_data("*", "usuarios_permisos", "idUsuario='".$this->session->userdata("id")."'");
			$data["permisos"] = $permisos;
			$data["scripts"] = array('<script src="'.base_url().'js/settings/settings_preguntas.js"></script>');
			print $this->load->view("vwheader_admin", $data, TRUE);
			print $this->load->view("vwaside_admin", $data, TRUE);
			print $this->load->view("settings/vwsettings_preguntas", $data, TRUE);
			print $this->load->view("vwfooter_admin", $data, TRUE);
			print $this->load->view("vwsidebar_admin", $data, TRUE);
		}else redirect(base_url());
	}

	public function get_preguntas_by_cuestionario_id () {
		$idCuestionario = $this->security->xss_clean($this->input->post("id"));
		$data = $this->get_data("id, nombre", "preguntas", "idCuestionario='$idCuestionario' AND date_end IS NULL");
		if ($data !== FALSE) {
			print json_encode(array("success" => TRUE, "result" => $data));
		}
	}

	public function get_respuestas_by_pregunta_id () {
		$idPregunta = $this->security->xss_clean($this->input->post("id"));
		$data = $this->get_data("id, nombre, is_correct", "respuestas", "idPregunta='$idPregunta' AND date_end IS NULL");
		if ($data !== FALSE) {
			print json_encode(array("success" => TRUE, "result" => $data));
		}
	}

	public function save_preguntas_y_respuestas () {
		$preguntas = json_decode($this->input->post("preguntas"));
		$idCuestionario = $this->security->xss_clean($this->input->post("idCuestionatio"));
		foreach ($preguntas AS $e => $key) {
			if (intval($key[0]) > 0) {
				$this->edit_data(array("nombre" => $this->treat_special_text($key[1])), "preguntas", $key[0], "id");
				$idPregunta_temp = $key[0];
			} else {
				$idPregunta_temp = $this->insert_data(array("idCuestionario" => $idCuestionario, "nombre" => $this->treat_special_text($key[1]), "date_start" => date('Y-m-d H:i:s')), "preguntas");
			}

			foreach ($key[2] AS $i => $item) {
				if (intval($item[0]) > 0) {
					$this->edit_data(array("nombre" => $this->treat_special_text($item[1]), "is_correct" => $item[2]), "respuestas", $item[0], "id");
				} else {
					$idRespuesta_temp = $this->insert_data(array("idPregunta" => $idPregunta_temp, "nombre" => $this->treat_special_text($item[1]), "is_correct" => $item[2], "date_start" => date('Y-m-d H:i:s')), "respuestas");
				}
			}
		}
		print json_encode(array("success" => TRUE));
	}

	public function get_self(){
		return $this;
	}
	
	public function insert_data($data,$table){
		return $this->mdllogin->insertData($data,$table);
	}

	public function get_data($select="",$from="",$where="",$order="",$group="",$limit=""){
		return $this->mdllogin->getData($select,$from,$where,$order,$group,$limit);
	}
	
	public function get_data_from_query($query){
		return $this->mdllogin->getDataFromQuery($query);
	}
	
	public function edit_data($data,$table,$id,$idName,$where=";"){
		return $this->mdllogin->editData($data,$table,$id,$idName,$where);
	}
	
	public function delete_data($table,$id,$idName){
		return $this->mdllogin->deleteData($table,$id,$idName);
	}
	
	public function delete_data_multiple_where($table,$where){
		return $this->mdllogin->deleteData_multipleWhere($table,$where);
	}

	private function get_permission($idUser, $permission) {
		$data = $this->get_data($permission, "usuarios", "id='$idUser'");
		if ($data !== FALSE) {
			$data = $data[0];
			if (intval($data[$permission]) > 0) return TRUE;
		}
		return FALSE;
	}

	private function treat_special_text ($text) {
		return addslashes(htmlspecialchars($text));
	}

}

?>